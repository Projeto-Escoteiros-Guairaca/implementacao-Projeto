<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/AtividadeDAO.php");
require_once(__DIR__ . "/../model/Atividade.php");
require_once(__DIR__ . "/../service/AtividadeService.php");


class AtividadeController extends Controller {
    
    private AtividadeDAO $atividadeDao;
    private AtividadeService $atividadeService;


    function __construct() {
        $administradorChefeActions = ["list", "create", "edit", "delete", "save", "update"];
        $lobinhoActions = ["list"];
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
        $this->atividadeService = new AtividadeService();

        $this->setActionDefault("list", true);
        $this->handleAction();
    }

    public function list(string $msgErro = "", string $msgSucesso = ""){
        $atividades = $this->atividadeDao->list();
        $dados["lista"] = $atividades;
        $this->loadView("pages/atividade/listAllAtividades.php", $dados, $msgErro, $msgSucesso, true);
    }
    
    public function create(){
        $dados["id_atividade"] = 0;
        $this->loadView("pages/atividade/formAtividade.php", $dados,"","", true);
    }

    protected function save() {

        $imagem = $_FILES['imagem'];
        
        $dados["id_atividade"] = isset($_POST['id_atividade']) ? $_POST['id_atividade'] : 0;
        $nomeAtividade = isset($_POST['nomeAtividade']) ? trim($_POST['nomeAtividade']) : "";
        $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : "";
        
        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $nome_imagem = md5(uniqid($imagem['name'])).".".$extensao;
        $caminho_imagem = "../view/img/imgAtividades/" . $nome_imagem;
        move_uploaded_file($imagem["tmp_name"], $caminho_imagem);


        $atividade = new Atividade();
        $atividade->setNomeAtividade($nomeAtividade);
        $atividade->setDescricao($descricao);

        if($dados['id_atividade'] == 0) {
            $atividade->setImagem($caminho_imagem);
        }
        elseif($imagem['name'] != '') {
            $atividade->setImagem($caminho_imagem);
        }
        else {
            $atividade->setImagem($_POST['imagem_atividade']);
        }
        //Validar os dados
        $erros = $this->atividadeService->validarDados($atividade);
        
        if($dados['id_atividade'] > 0 && $imagem['name'] != '') {
            $this->atividadeDao->deleteImage($dados['id_atividade']);
        }


        if(empty($erros)) {
            //Persiste o objeto
            try {
                if($dados["id_atividade"] == 0){ //Inserindo
                    
                    $this->atividadeService->insert($atividade);
                }
                else {//Alterando
                    $atividade->setIdAtividade($dados["id_atividade"]);
                    $this->atividadeService->update($atividade);
                }
                // - Enviar mensagem de sucesso
                $msg = "Atividade salva com sucesso.";
                $this->list("", $msg);
                
                exit;
            } catch (PDOException $e) {
                $erros = ["[Erro ao salvar a atividade na base de dados.]"];
            }
        }

        //Se há erros, volta para o formulário
        
        //TODO - Transformar o array de erros em string
        $dados["atividade"] = $atividade;
        $dados["nomeAtividade"] = $atividade->getNomeAtividade();
        $dados["descricao"] = $atividade->getDescricao();

        $msgsErro = implode("<br>", $erros);
        $this->loadView("pages/atividade/formAtividade.php", $dados, $msgsErro, "", "", true);
    }

    protected function edit() {
        $atividade = $this->findAtividadeById();

        if($atividade){

            $dados["id_atividade"] = $atividade->getIdAtividade();
            $dados["atividade"] = $atividade;        
            $this->loadView("pages/atividade/formAtividade.php", $dados, "", "", true);
        } else {
            $this->list("Atividade não encontrada.");
        }
    }

    protected function findAtividadeById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $dados["id_atividade"] = $id;

        $atividade = $this->atividadeDao->findById($id);
        return $atividade;
    }

    protected function delete(){
        $atividade = $this->findAtividadeById();
             if($atividade){
            $this->atividadeDao->deleteById($atividade->getIdAtividade());
            
            $this->list("","Atividade excluída com sucesso.");
        } else {
            $this->list("Atividade não encontrada.");
        }
    }
}

$ativCont = new AtividadeController();
