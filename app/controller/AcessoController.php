<?php
#Nome do arquivo: AcessoController.php
#Objetivo: classe controller para controlar acesso às 
        //funcionalidades de sistema de acordo com os papeis do usuário

require_once(__DIR__ . "/Controller.php");

class AcessoController extends Controller {

    const administradorActions = [
        "list","listUsuariosByAlcateia", "findUsuarioByIdAlcateia", "profile", 
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
        // $fullUrl = strstr("$_SERVER[REQUEST_URI]", "?");
        $url = strstr("$_SERVER[REQUEST_URI]", "action");
        
        $_SESSION['callAccessToken'] =  false;

        if(isset($_GET['action'])) {
            $_SESSION['ACTION'] = $_GET['action'];
        }
        if($url != false) {
            $_SESSION['URL'] = "?" .$url;
        }
    

       if(in_array("LOBINHO", $_SESSION[SESSAO_USUARIO_PAPEIS])) { $papelMethod = "lobinho"; }
        else if(in_array("CHEFE", $_SESSION[SESSAO_USUARIO_PAPEIS])) { $papelMethod = "chefe"; }
        else { $papelMethod = "admin"; }

        
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
            return;
        }
    }  
    
    public function lobinho() {
        $this->check(AcessoController::lobinhoActions);
    }
    public function chefe() {
        $this->check(AcessoController::chefeActions);
    }
    public function admin() {
        $this->check(AcessoController::administradorActions);
    }
    
    public function check($actions) {

        if(isset($_GET['action'])) {
            if(in_array($_GET['action'], $actions)) {
                $this->loadController($_GET['controller'], $_SESSION['URL']);
            }
        }
        else if(isset($_SESSION['ACTION'])) {

            if(in_array($_SESSION['ACTION'], $actions)) {
                $this->loadController($_SESSION['controller'], $_SESSION['URL']);
            }
        }
        else {
            $this->loadController($_SESSION['controller']);
        }
    }
}
$AcessoCont = new AcessoController();