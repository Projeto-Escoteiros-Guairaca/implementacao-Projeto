<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../service/TarefaService.php");
require_once(__DIR__ . "/../model/Arquivo.php");
require_once(__DIR__ . "/../model/EntregaTarefaUsuario.php");

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
        if(isset($_GET['action'])) {
            if(isset($_GET['isForm'])) {
                $_SESSION['callAccessToken'] = false;
            }
        }
        

        if(isset($_GET["idAtividade"])) {
            $_SESSION["activeAtividade"] = $_GET["idAtividade"];
        }
        
        if(isset($_SESSION['callAccessToken'])) {
            if($_SESSION['callAccessToken'] == true) {
                $_SESSION['controller'] = "Tarefa";
    
                $this->loadController("Acesso");
                return;
            }
            $_SESSION['callAccessToken'] = true;
        }
        else {
            $this->loadController('Login', '?action=login');
            die;
        }
        
        $this->usuarioDao = new UsuarioDAO();
        $this->atividadeDao = new AtividadeDAO();
        $this->tarefaDao = new TarefaDAO();
        $this->tarefaService = new TarefaService();

        $this->setActionDefault("listTarefas", true);
        $this->handleAction();
    }

    public function listTarefas(string $msgErro = "", string $msgSucesso = ""){
        $tarefaComplete = array();
        // if(isset($_GET["idAtividade"])) {
        //     $_SESSION["activeAtividade"] = $_GET["idAtividade"];
        // }
        
        $atividade = $this->atividadeDao->findById($_SESSION["activeAtividade"]);

        if(isset($_SESSION["activeAtividade"])) {
            $tarefas = $this->tarefaDao->listByIdAtiv($_SESSION["activeAtividade"]);
            foreach($tarefas as $tar):
                $tarefaUsuario = $this->tarefaDao->getTarefaSendByUsuario($_SESSION[SESSAO_USUARIO_ID], $tar->getIdTarefa());


                if($tarefaUsuario == null) {
                    $tarefaUsuario = new EntregaTarefaUsuario();
                    $tarefaUsuario->setTarefa($tar);
                }
                array_push($tarefaComplete, $tarefaUsuario);

            endforeach;
        }
        else {
            $tarefaComplete = $this->tarefaDao->list();
        }

        $dados["atividade"] = $atividade;
        $dados["lista"] = $tarefaComplete;
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

    public function validateTarefa() {
        $avaliacao = isset($_POST['avaliacao']) ? $_POST['avaliacao'] : "";
        $idEntrega = $_GET['idEnvio'];
   
        $this->tarefaDao->validateTarefa($avaliacao, $idEntrega);
        $this->openTarefaOfEspecificUsuario();
    }

    public function addTarefa() {
        $arquivo = $this->addArquivo();

        $tarefaUsuario = new EntregaTarefaUsuario();
        $tarefaUsuario->setDataEntrega(date('Y-m-d'));
        $tarefaUsuario->setIdUsuario($_SESSION[SESSAO_USUARIO_ID]);
        $tarefaUsuario->setIdTarefa($_SESSION['activeTarefa']);
        $tarefaUsuario->setIdArquivo($arquivo->getIdArquivo());
        
        $this->tarefaDao->addTarefaUsuario($tarefaUsuario);
        $this->openTarefa();
    }
    public function addArquivo() {
        $texto = isset($_POST['texto']) ? $_POST['texto'] : "";
        if(isset($_FILES['imagem'])) {
            $imagem = $_FILES['imagem'];
        }
        else {
            $imagem['type'] = 'Texto';
        }
        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);

        if(strpos($imagem['type'], "image") !== false) {
            $nome = "Imagem";
        }
        else if(strpos($imagem['type'], "video") !== false) {
            $nome = "Video";
        }
        else {
            $nome = "Texto";
        }
     
        $nome_imagem = md5(uniqid($imagem['name'])).".".$extensao;
        $caminho_imagem = "../view/img/imgTarefas/" . $nome_imagem;
        move_uploaded_file($imagem["tmp_name"], $caminho_imagem);


        $arquivo = new Arquivo();
        $arquivo->setTexto($texto);
        $arquivo->setCaminhoArquivo($caminho_imagem);
        $arquivo->setNomeArquivo($nome);
        $this->tarefaDao->addArquivo($arquivo);
        return $arquivo;
    }

    public function updateEntrega() {
        $idEntrega = $_GET['idEntrega'];
        $this->tarefaDao->validateTarefa(0, $idEntrega);
    $this->tarefaDao->changeDataEntrega(date('Y-m-d'), $idEntrega);        
        $idArquivo = $_POST['idArquivo'];
        $this->tarefaDao->deleteImage($idArquivo);

        $texto = isset($_POST['texto']) ? $_POST['texto'] : "";
        if(isset($_FILES['imagem'])) {
            $imagem = $_FILES['imagem'];
        }
        else {
            $imagem['type'] = 'Texto';
        }

        
        if(strpos($imagem['type'], "image") !== false) {
            $nome = "Imagem";
        }
        else if(strpos($imagem['type'], "video") !== false) {
            $nome = "Video";
        }
        else {
            $nome = "Texto";
        }

        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $nome_imagem = md5(uniqid($imagem['name'])).".".$extensao;
        $caminho_imagem = "../view/img/imgTarefas/" . $nome_imagem;
        move_uploaded_file($imagem["tmp_name"], $caminho_imagem);

        $arquivo = new Arquivo();
        $arquivo->setIdArquivo($idArquivo);
        $arquivo->setTexto($texto);
        $arquivo->setCaminhoArquivo($caminho_imagem);
        $arquivo->setNomeArquivo($nome);

        $this->tarefaDao->updateEntrega($arquivo);
        $this->openTarefa();

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
                $_SESSION['URL'][$_SESSION['controller']] = "?controller=Tarefa&action=listTarefas";

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