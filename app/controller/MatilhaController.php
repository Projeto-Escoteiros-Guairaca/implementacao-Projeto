<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Matilha.php");
require_once(__DIR__ . "/../model/Alcateia.php");

require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../service/MatilhaService.php");

    
class MatilhaController extends Controller{

    private AlcateiaDAO $alcateiaDao;
    private UsuarioDAO $usuarioDao;
    private MatilhaDAO $matilhaDao;
    private MatilhaService $matilhaService;


    public function __construct(){

        if(isset($_GET['action'])) {
            if(isset($_GET['isForm'])) {
                $_SESSION['callAccessToken'] = false;
            }
        }

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

        $this->alcateiaDao = new AlcateiaDAO();
        $this->usuarioDao = new UsuarioDAO();
        $this->matilhaDao = new MatilhaDAO();
        $this->matilhaService = new MatilhaService();
        $this->setActionDefault("listMatilhas", true);
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
    
    public function listMatilhas(string $msgErro = "", string $msgSucesso = "") {  
        if(isset($_GET['idAlcateia']) && isset($_GET['nomeAlcateia'])) {
            $_SESSION['activeAlcateiaId'] = $_GET['idAlcateia'];
            $_SESSION['activeAlcateiaNome'] = $_GET['nomeAlcateia'];
        }
        
        if(isset($_SESSION[SESSAO_USUARIO_ID_ALCATEIA])) {
            $alcateia = $this->alcateiaDao->findById($_SESSION[SESSAO_USUARIO_ID_ALCATEIA]);
            $_SESSION['activeAlcateiaId'] = $alcateia->getIdAlcateia();
            $_SESSION['activeAlcateiaNome'] = $alcateia->getNomeAlcateia();
        }
        
        if($_SESSION['chefeMatilha'] != "" or isset($_GET['idMatilha'])) {
            $_GET['id'] = $_SESSION['chefeMatilha'];

            if(isset($_GET['idMatilha'])) {
                $_GET['id'] = $_GET['idMatilha'];
            }

            $usuarios = $this->usuarioDao->findUsuariosByIdMatilha($_GET['id']);
            $matilha = $this->findMatilhaById();
            
            if($matilha->getIdChefe() != null) {
                $matilha->setUsuarioChefe($this->usuarioDao->findById($matilha->getIdChefe()));
            }
            
            if($matilha->getIdPrimo() != null) {
                $matilha->setUsuarioPrimo($this->usuarioDao->findById($matilha->getIdPrimo()));
            }

            $dados['alcateia'][0] = $_SESSION['activeAlcateiaId'];
            $dados['alcateia'][1] = $_SESSION['activeAlcateiaNome'];
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
        if(isset($_GET['idAlcateia'])) {
            $matilhas = $this->matilhaDao->listByIdAlcateia($_GET['idAlcateia']);
            $dados['alcateia'][0] = $_GET['idAlcateia'];
            $dados['alcateia'][1] = $_GET['nomeAlcateia'];
        }
        else if(isset($_SESSION['activeAlcateiaId'])) {
            $matilhas = $this->matilhaDao->listByIdAlcateia($_SESSION['activeAlcateiaId']);
            $dados['alcateia'][0] = $_SESSION['activeAlcateiaId'];
            $dados['alcateia'][1] = $_SESSION['activeAlcateiaNome'];
        }

        if(isset($_GET['sendMatilhas'])) {
            echo json_encode($matilhas);
            return;
        }

        $dados["lista"] = $matilhas;
        $this->loadView("pages/matilha/chefeOnly/listMatilhas.php", $dados, $msgErro, $msgSucesso, true);    
    }

    public function create(){
        $dados["id_matilha"] = 0;
        $this->loadView("pages/matilha/chefeOnly/formMatilha.php", $dados,"","", true);
    }
    
    protected function edit() {
        $matilha = $this->findMatilhaById();

        if($matilha){

            $dados["id_matilha"] = $matilha->getIdMatilha();
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
        $alcateia = $_SESSION['activeAlcateiaId'];

        $matilha = new Matilha();
        $matilha->setNomeMatilha($nomeMatilha);
        $matilha->setIdChefe($chefeMatilha);
        $matilha->setIdPrimo($primoMatilha);
        $matilha->setIdAlcateia($alcateia);

        $erros = $this->matilhaService->validarDados($matilha);

        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id_matilha"] == 0){ //Inserindo
                    $this->matilhaService->insert($matilha);

                }
                else {//Alterando

                    $matilha->setIdMatilha($dados["id_matilha"]);
                    $this->matilhaService->update($matilha);
                }

                // - Enviar mensagem de sucesso
                $msg = "Matilha salva com sucesso.";

                $dados['alcateia'][0] = $_SESSION['activeAlcateiaId'];
                $dados['alcateia'][1] = $_SESSION['activeAlcateiaNome'];
                $this->listMatilhas("", $msg);
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
            $this->matilhaDao->deleteById($matilha->getIdMatilha());
            
            $this->list("","Matilha excluída com sucesso.");
        } else {
            $this->list("Matilha não encontrada.");
        }
    }

    protected function definePrimo() {
        $this->matilhaDao->definePrimo($_GET['idMatilha'], $_GET["id"]);
        $this->listMatilhas();

    }
} 

$alcCont = new MatilhaController();