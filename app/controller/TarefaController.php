<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../service/TarefaService.php");
require_once(__DIR__ . "/../model/Tarefa.php");
require_once(__DIR__ . "/../dao/TarefaDAO.php");

require_once(__DIR__ . "/../model/Atividade.php");
require_once(__DIR__ . "/../dao/AtividadeDAO.php");

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
class TarefaController extends Controller {

    private $tarefaDao;
    private $atividadeDao;
    private $usuarioDao;

    private $tarefaService;
    
    function __construct(){
        if($_GET['action'] == "save" or $_GET['action'] == "edit") {
            $_SESSION['callAccessToken'] = false;
        }

        if(isset($_GET["idAtividade"])) {
            $_SESSION["activeAtividade"] = $_GET["idAtividade"];
        }
        
        if($_SESSION['callAccessToken'] == true) {
            $_SESSION['controller'] = "Tarefa";
            $this->loadController("Acesso");
            return;
        }
        $_SESSION['callAccessToken'] = true;
        
        $this->usuarioDao = new UsuarioDAO();
        $this->atividadeDao = new AtividadeDAO();
        $this->tarefaDao = new TarefaDAO();
        $this->tarefaService = new TarefaService();

        $this->setActionDefault("listTarefas", true);
        $this->handleAction();
    }

    public function listTarefas(string $msgErro = "", string $msgSucesso = ""){

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

    public function openTarefa() {
        if( isset($_GET['id'])) {
            $_SESSION['activeTarefa'] = $_GET['id'];
        }

        if($_SESSION[SESSAO_USUARIO_PAPEIS][0] == "LOBINHO") {    

            $tarefa = $this->findById();
            $usuarioEnviou = $this->tarefaDao->getTarefaSendByUsuario($_SESSION[SESSAO_USUARIO_ID], $_SESSION['activeTarefa']);
            $dados['envioUsuario'] = $usuarioEnviou;
            $dados["tarefa"] = $tarefa;

            $this->loadView("pages/tarefa/lobinhoOnly/openTarefaLobinho.php", $dados, "", "", true);
        }
        else {
            $tarefa = $this->findById();
            $dados["tarefa"] = $tarefa;

            $this->loadView("pages/tarefa/chefeOnly/openTarefaChefe.php", $dados, "", "", true);

        }
    }

    public function listUsuarios() {
        $usuarios = $this->usuarioDao->findUsuariosByIdMatilha($_GET['idMatilha']);
        $tarefa = $this->findById();

        foreach ($usuarios as $usu):
            $newUsuario = $this->tarefaDao->getTarefaSendByUsuario($usu->getId(), $_SESSION['activeTarefa']);
            if($newUsuario != NULL) {
                $usu->setTarefaEnviada(true);
            }
            else {
                $usu->setTarefaEnviada(false);
            }
        endforeach;
        $dados['tarefa'] = $tarefa;
        $dados['usuarios'] = $usuarios;
        $this->loadView("pages/tarefa/chefeOnly/listTarefasUsuario.php", $dados, "", "", true);

    }

    public function openTarefaOfEspecificUsuario() {

        $tarefa = $this->findById();
        $usuarioEnviou = $this->tarefaDao->getTarefaSendByUsuario($_GET['idUsuario'], $_SESSION['activeTarefa']);
        $dados['envioUsuario'] = $usuarioEnviou;
        $dados["tarefa"] = $tarefa;

        $this->loadView("pages/tarefa/chefeOnly/openTarefaUsuario.php", $dados, "", "", true);

    }

    public function create(){
        $dados["id_atividade"] = $_GET['idAtividade'];
        $this->loadView("pages/tarefa/chefeOnly/formTarefa.php", $dados, "", "", true);
    }

    public function save(){
        
        if(empty($_POST)) {
            $this->create();
            return;
        }

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
                
                $this->listTarefas("", $msg);
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
        $this->listTarefas("", "Tarefa salva com sucesso", true);
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

    //! public function openTarefa(string $msgErro = "", string $msgSucesso = "") {
    //!     if( isset($_GET['id'])) {
    //!         $_SESSION['activeTarefa'] = $_GET['id'];
    //!     }
    //!     $usuariosMatilha = $this->usuarioDao->findUsuariosByIdMatilha($_SESSION[SESSAO_USUARIO_ID_MATILHA]);
    //!     $tarefa = $this->findById();

    //!     foreach ($usuariosMatilha as $us):
    //!         $usuarioEnviou = $this->usuarioDao->usuarioSended($us->getId());
    //!         $us->setTarefaEnviada($usuarioEnviou);
    //!     endforeach;

    //!     $dados["tarefa"] = $tarefa;
    //!     $dados["lista"] = $usuariosMatilha;

    //!     if($_SESSION[SESSAO_USUARIO_PAPEIS][0] == "LOBINHO") {
    //!         $this->loadView("pages/tarefa/lobinhoOnly/openTarefaLobinho.php", $dados, $msgErro, $msgSucesso, true);
    //!     }
    //!     else {
    //!         $this->loadView("pages/tarefa/chefeOnly/listTarefasUsuario.php", $dados, $msgErro, $msgSucesso, true);
    //!     }
        
    //! }

    //! public function openTarefaUsuario(string $msgErro = "", string $msgSucesso = "") {
    //!     $idTarefa = $_GET['id'];
    //!     $tarefaUsuario = $this->tarefaDao->getTarefaUsuario($idTarefa);

    //!     $dados["tarefa"] = $tarefaUsuario;
    //!     $this->loadView("pages/tarefa/chefeOnly/openTarefaUsuario.php", $dados, $msgErro, $msgSucesso, true);
    //! }

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