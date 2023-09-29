<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../service/TarefaService.php");
require_once(__DIR__ . "/../model/Tarefa.php");
require_once(__DIR__ . "/../dao/TarefaDAO.php");
require_once(__DIR__ . "/../model/Atividade.php");
require_once(__DIR__ . "/../dao/AtividadeDAO.php");


class TarefaController extends Controller {

    private $tarefaDao;
    private $atividadeDao;

    private $tarefaService;
    
    function __construct(){
        $administradorChefeActions = [
            "list", "listByIdAtiv", "create", "createTarefaAtiv", 
        "edit", "delete", "save", "update", "openTarefa", "openTarefaUsuario"
        ];
        $lobinhoActions = ["list","listByIdAtiv", "openTarefa"];
        $papelNecessario = array();

        if(isset($_GET['action'])) {
            if(in_array($_GET['action'], $administradorChefeActions)) {
                $papelNecessario[] = "ADMINISTRADOR";
            }
            if(in_array($_GET['action'], $lobinhoActions)) {
                $papelNecessario[] = "LOBINHO";
            }
        }
        else {
            $papelNecessario[] = "ADMINISTRADOR";
            $papelNecessario[] = "LOBINHO";
       }

        $accessVerified = $this->verifyAccess($papelNecessario);        
        if(! $accessVerified) {
            return;
        }
        
        $this->atividadeDao = new AtividadeDAO();
        $this->tarefaDao = new TarefaDAO();
        $this->tarefaService = new TarefaService();

        $this->setActionDefault("list", true);
        $this->handleAction();
    }

    public function list(string $msgErro = "", string $msgSucesso = ""){

        if(isset($_GET["idAtividade"])) {
            $_SESSION["activeAtividade"] = $_GET["idAtividade"];
        }
        
        $atividade = $this->atividadeDao->findById($_SESSION["activeAtividade"]);

        if(isset($_SESSION["activeAtividade"])) {
            $tarefas = $this->tarefaDao->listByIdAtiv($_SESSION["activeAtividade"]);
        }
        else {
            $tarefas = $this->tarefaDao->list();
        }

        $dados["atividade"] = $atividade;
        $dados["lista"] = $tarefas;
        $this->loadView("pages/tarefa/listTarefa.php", $dados, $msgErro, $msgSucesso, true);
    }

    public function createTarefaAtiv(){
        $dados["id_atividade"] = $_GET['idAtividade'];
        $this->loadView("pages/tarefa/formTarefa.php", $dados, "", "", true);
    }

    public function save(){

        $dados["id_tarefa"] = isset($_POST['id_tarefa']) ? $_POST['id_tarefa'] : 0;
        $tarefa = $this->saveTarefa();

        $erros = $this->tarefaService->validarDados($tarefa);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id_tarefa"] == 0){ //Inserindo
                    $this->tarefaService->insert($tarefa);
                }
                else {//Alterando

                    $tarefa->setIdTarefa($dados["id_tarefa"]);
                    $this->tarefaService->update($tarefa);
                }

                // - Enviar mensagem de sucesso
                $msg = "tarefa salva com sucesso.";
                
                $this->list("", $msg);
                exit;
            } 
            catch (PDOException $e) {
                $erros = ["[Erro ao salvar a encontro na base de dados.]"];
            }
        }
       
        /*$dados["nomeTarefa"] = $nomeTarefa;
        $dados["descricaoTarefa"] = $descricaoTarefa;
        $dados["id_atividade"] = $idAtividade;*/

        $dados["lista"] = $tarefa;


        $msgsErro = implode("<br>", $erros);
        $this->list("", "Tarefa salva com sucesso", true);
    }

    public function saveTarefa() {
        $nomeTarefa = isset($_POST['nomeTarefa']) ? trim($_POST['nomeTarefa']) : "";
        $descricaoTarefa = isset($_POST['descricaoTarefa']) ? trim($_POST['descricaoTarefa']) : "";
        $idAtividade = isset($_POST['id_atividade']) ? trim($_POST['id_atividade']) : "";

        $tarefa = new Tarefa();
        $tarefa->setNomeTarefa($nomeTarefa);
        $tarefa->setDescricaoTarefa($descricaoTarefa);
        $atividade = new Atividade();
        $atividade->setIdAtividade($idAtividade);
        $tarefa->setAtividade($atividade);

        return $tarefa;
    }

    public function openTarefa(string $msgErro = "", string $msgSucesso = "") {
        if( isset($_GET['id'])) {
            $_SESSION['activeTarefa'] = $_GET['id'];
        }
        $tarefa = $this->findById();
        $dados["tarefa"] = $tarefa;
        $this->loadView("pages/tarefa/openTarefa.php", $dados, $msgErro, $msgSucesso, false);
    }

    public function openTarefaUsuario(string $msgErro = "", string $msgSucesso = "") {
        $idTarefa = $_GET['id'];
        $tarefaUsuario = $this->tarefaDao->getTarefaUsuario($idTarefa);

        $dados["tarefa"] = $tarefaUsuario;
        $this->loadView("pages/tarefa/openTarefaUsuario.php", $dados, $msgErro, $msgSucesso, false);
    }

    protected function findById(){
        $id = 0;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        else {
            if( isset($_SESSION['activeTarefa'])) {
                $id = $_SESSION['activeTarefa'];
            }
        }
        
        
        $tarefa = $this->tarefaDao->findById($id);
        return $tarefa;
    }
}

$TarefCont = new TarefaController();