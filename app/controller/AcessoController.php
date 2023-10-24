<?php
#Nome do arquivo: AcessoController.php
#Objetivo: classe controller para controlar acesso às 
        //funcionalidades de sistema de acordo com os papeis do usuário
require_once(__DIR__ . "/Controller.php");

class AcessoController extends Controller {

    const administradorActions = [
        "listFrequencias", "listUsuarios", "listAtividades", "listTarefas", "listEncontros", 
        "listAlcateias", "listMatilhas", "listUsuariosByAlcateia", "findUsuarioByIdAlcateia", "profile", 
        "create", "createTarefaAtiv", "saveEndereco", "saveContato", "saveUsuario",
        "edit", "delete", "save", "update", "findIt", "changeAlcateia", "updateToInativo", "updateToAtivo",
        "findUsuarioById", "changePapel", "findChefeAndPrimo", "listAlcateia", "findAlcateiaById", "filter",
        "findEncontroById", "findUsuariosByIdAlcateia", "listByUsuario","createFrequencias", 
        "findUsuariosById",
        "findFrequenciasByIdEncontro", "findEncontroByIdEncontro",
        "updateToFalse", "updateToTrue", "findFrequenciaById", "listByIdAtiv", "createTarefaAtiv",
        "openTarefa", "openTarefaUsuario"
    ];

    const lobinhoActions = [
        "profile", "initialLobinhoPage", "listByIdAtiv", "openTarefa",
         "list", "listAtividades", "listTarefas"
    ];  

    const chefeActions = [
        
    ];

    public function __construct() {  
        $this->setSessionVariables();
    }

    public function setSessionVariables() {
        $url = strstr("$_SERVER[REQUEST_URI]", "action");
        $_SESSION['callAccessToken'] =  false;
       
        if(isset($_GET['action'])) {
            $_SESSION['ACTION'][$_GET['controller']] = $_GET['action'];
            
        }
        if($url != false) {
            $_SESSION['URL'][$_GET['controller']] = "?" .$url;
        }
        
       
        $this->callRespectiveFunction();
    }  

    public function callRespectiveFunction() {
        $papelMethod = $_SESSION[SESSAO_USUARIO_PAPEIS][0];

        if(isset($_GET['controller'])) {
        
            $_SESSION['controller'] = $_GET['controller'];
            $method = $papelMethod;
            $this->$method();
        }
        else if(isset($_SESSION['controller'])) {

            $method = $papelMethod;
            $this->$method();
        }
        else {
            $this->loadView("pages/Errors/accessDenied.php", [], "", "");
        }
    }

    public function LOBINHO() {
        $this->checkAndCallController(AcessoController::lobinhoActions);
    }
    public function CHEFE() {
        $this->checkAndCallController(AcessoController::chefeActions);
    }
    public function ADMINISTRADOR() {
        $this->checkAndCallController(AcessoController::administradorActions);
    }
    
    public function checkAndCallController($actions) {

        if(isset($_GET['action'])) {
            if(in_array($_GET['action'], $actions)) {
                $this->loadController($_GET['controller'], $_SESSION['URL'][$_GET['controller']]);
            }
            else {
                $this->loadView("pages/Errors/accessDenied.php", [], "", "");
            }
        }

        else if(isset($_SESSION['ACTION'][$_SESSION['controller']])) {

            if(in_array($_SESSION['ACTION'][$_SESSION['controller']], $actions)) {
                $this->loadController($_SESSION['controller'], $_SESSION['URL'][$_SESSION['controller']]);
            }
            else {
                $this->loadView("pages/Errors/accessDenied.php", [], "", "");
            }
        }

        else {
            $this->loadView("pages/Errors/accessDenied.php", [], "", "");
        }
    }
}
$AcessoCont = new AcessoController();