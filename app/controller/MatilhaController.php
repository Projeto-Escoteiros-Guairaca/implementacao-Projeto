<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Matilha.php");
require_once(__DIR__ . "/../model/Alcateia.php");

require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../service/MatilhaService.php");

    
class MatilhaController extends Controller{

    private UsuarioDAO $usuarioDao;
    private MatilhaDAO $matilhaDao;
    private MatilhaService $matilhaService;


    public function __construct(){

        if(isset($_GET['action'])) {
            if($_GET['action'] == "save" or $_GET['action'] == "edit") {
                $_SESSION['callAccessToken'] = false;
            }
        }

        if(! isset($_GET['isAjax'])) {
            if(isset($_SESSION['callAccessToken'])) {
                if($_SESSION['callAccessToken'] == true) {
                    $_SESSION['controller'] = "Matilha";
        
                    $this->loadController("Acesso");
                    return;
                }
                $_SESSION['callAccessToken'] = true;
            }
            else {
                $this->loadController('Login', '?action=login');
                die;
            }
           
        }
        
        $this->usuarioDao = new UsuarioDAO();
        $this->matilhaDao = new MatilhaDAO();
        $this->matilhaService = new MatilhaService();
        $this->setActionDefault("listMatilha", true);
        $this->handleAction();
    }

    public function findChefeAndPrimo() {
        $chefeAndPrimo = [];
        $matilha = $this->matilhaDao->findById($_GET['idMatilha']);
        $chefe = $this->usuarioDao->findById($matilha->getIdChefe());   
        array_push($chefeAndPrimo, $chefe);

        if($matilha->getIdPrimo() > 0) {
            $primo = $this->usuarioDao->findById($matilha->getIdPrimo());
            array_push($chefeAndPrimo, $primo);
        }
        echo json_encode($chefeAndPrimo);
        die;
    }
    
    public function listMatilha(string $msgErro = "", string $msgSucesso = "") {
        $_SESSION['activeAlcateiaId'] = $_GET['idAlcateia'];
        $_SESSION['activeAlcateiaNome'] = $_GET['nomeAlcateia'];
        
        if($_SESSION['chefeMatilha'] != "" or isset($_GET['idMatilha'])) {
            $_GET['id'] = $_SESSION['chefeMatilha'];

            if(isset($_GET['idMatilha'])) {
                $_GET['id'] = $_GET['idMatilha'];
            }

            $usuarios = $this->usuarioDao->findUsuariosByIdAcateia($_GET['id']);
            $matilha = $this->findMatilhaById();
            
            if($matilha->getIdChefe() != null) {
                $matilha->setUsuarioChefe($this->usuarioDao->findById($matilha->getIdChefe()));
            }
            
            if($matilha->getIdPrimo() != null) {
                $matilha->setUsuarioChefe($this->usuarioDao->findById($matilha->getIdPrimo()));
            }

            $dados['alcateia'][0] = $_GET['idAlcateia'];
            $dados['alcateia'][1] = $_GET['nomeAlcateia'];
            $dados["usuarios"] = $usuarios;
            $dados["matilha"] = $matilha;
            $this->loadView("pages/matilha/chefeOnly/matilha.php", $dados, $msgErro, $msgSucesso, true);
        }
        else if($_SESSION["chefeMatilha"] == "SemMatilha") {
            $this->loadView("pages/Errors/accessDenied.php", [], $msgErro, $msgSucesso, true);    
        }
        else {
            $this->list();
        }
    }
    public function list(string $msgErro = "", string $msgSucesso = ""){
        $matilhas = $this->matilhaDao->listByIdAlcateia($_GET['idAlcateia']);

        if(isset($_GET['sendMatilhas'])) {
            echo json_encode($matilhas);
            return;
        }
        $dados['alcateia'][0] = $_GET['idAlcateia'];
        $dados['alcateia'][1] = $_GET['nomeAlcateia'];
        $dados["lista"] = $matilhas;
        $this->loadView("pages/matilha/chefeOnly/listMatilha.php", $dados, $msgErro, $msgSucesso, true);    
    }

    public function create(){
        $dados["id_matilha"] = 0;
        $this->loadView("pages/matilha/chefeOnly/formMatilha.php", $dados,"","", true);
    }
    
    protected function edit() {
        $matilha = $this->findMatilhaById();

        if($matilha){

            $dados["id_matilha"] = $matilha->getId_matilha();
            $dados["matilha"] = $matilha;        
            $this->loadView("pages/matilha/chefeOnly/formMatilha.php", $dados, "", "", true);
        } else {
            $this->list("Matilha não encontrada.");
        }

    }

    protected function findMatilhaById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $dados["id_matilha"] = $id;

        $matilha = $this->matilhaDao->findById($id);
        return $matilha;
    }

    public function save(){
        if(empty($_POST)) {
            $this->create();
            return;
        }
        $dados["id_matilha"] = isset($_POST['id_matilha']) ? $_POST['id_matilha'] : 0;
        $nomeMatilha = isset($_POST['nomeMatilha']) ? trim($_POST['nomeMatilha']) : NULL;
        $chefeMatilha = isset($_POST['chefeMatilha']) ? trim($_POST['chefeMatilha']) : NULL;
        $primoMatilha = isset($_POST['primoMatilha']) ? trim($_POST['primoMatilha']) : NULL;

        $matilha = new Matilha();
        $matilha->setNome($nomeMatilha);
        $matilha->setIdChefe($chefeMatilha);
        $matilha->setIdPrimo($primoMatilha);

        $erros = $this->matilhaService->validarDados($matilha);

        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id_matilha"] == 0){ //Inserindo
                    $this->matilhaService->insert($matilha);

                }
                else {//Alterando

                    $matilha->setId_matilha($dados["id_matilha"]);
                    $this->matilhaService->update($matilha);
                }

                // - Enviar mensagem de sucesso
                $msg = "Matilha salva com sucesso.";
                $this->list("", $msg);
                $_SESSION['URL'][$_SESSION['controller']] = "?controller=Matilha&action=listMatilhas";

                exit;
            } catch (PDOException $e) {
                $erros = ["[Erro ao salvar a matilha na base de dados.]"];
            }
        }
       
        $dados["nomeMatilha"] = $nomeMatilha;
        $dados["primoMatilha"] = $primoMatilha;
        $dados["chefeMatilha"] = $chefeMatilha;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("pages/matilha/chefeOnly/formMatilha.php", $dados, $msgsErro, "", true);
 
    }
    
    protected function delete(){
        $matilha = $this->findMatilhaById();
             if($matilha){
            $this->matilhaDao->deleteById($matilha->getId_matilha());
            
            $this->list("","Matilha excluída com sucesso.");
        } else {
            $this->list("Matilha não encontrada.");
        }
    }
} 

$alcCont = new MatilhaController();