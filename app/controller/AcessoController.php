<?php
#Nome do arquivo: AcessoController.php
#Objetivo: classe controller para controlar acesso às 
        //funcionalidades de sistema de acordo com os papeis do usuário
require_once(__DIR__ . "/Controller.php");

class AcessoController extends Controller {

    const administradorActions = [
        "listFrequencias", "listUsuarios", "listAtividades", "listTarefas", "listEncontros","listAlcateias",
        "listMatilhas", "listUsuariosByMatilha", "findUsuarioByIdMatilha", "profile", 
        "create", "createTarefaAtiv", "saveEndereco", "saveContato", "saveUsuario",
        "edit", "delete", "save", "update", "findIt", "changeMatilha", "updateToInativo", "updateToAtivo",
        "findUsuarioById", "changePapel", "findChefeAndPrimo", "listMatilhas", "findMatilhaById", "filter",
        "findEncontroById", "findUsuariosByIdMatilha", "listByUsuario","createFrequencias", 
        "findUsuariosById",
        "findFrequenciasByIdEncontro", "findEncontroByIdEncontro",
        "updateToFalse", "updateToTrue", "findFrequenciaById", "listByIdAtiv", "createTarefaAtiv",
        "openTarefa", "openTarefaUsuario", "home", "openTarefaOfEspecificUsuario"
    ];

    const lobinhoActions = [
        "profile", "initialLobinhoPage", "listByIdAtiv", "openTarefa",
         "list", "listAtividades", "listTarefas", "home", "addTarefa"
    ];  

    const chefeActions = [
        "createFrequencias", "listFrequencias", "listUsuarios", "listMatilhas", "listAtividades", "listTarefas", "listEncontros", "listUsuariosByMatilha",
        "create", "createTarefaAtiv",  "home", "initialChefePage", "edit", "delete", "save", "update", "findIt",
        "findUsuariosByIdAcateia", "findMatilhaById", "findIt", "openTarefa", "listUsuarios", 
        "openTarefaOfEspecificUsuario", "validateTarefa", "addTarefa", "addArquivo", "updateEntrega",
        "saveTarefa", "findById", "profile", "listByUsuario", 
        "findUsuariosByIdMatilha", "findUsuariosById",
        "findFrequenciasByIdEncontro", "findEncontroByIdEncontro", "updateToFalse", 
        "updateToTrue", "findFrequenciaById"
    ];
    
    const noSessionActions = [
        "create", "home"
    ];

    //* te envia à pagina de erro se o usuario não tem matilha; se não, continua o processo normal.
    public function __construct() {  
  
        if(isset($_SESSION[SESSAO_USUARIO_ID_MATILHA])) {
            if($_SESSION[SESSAO_USUARIO_ID_MATILHA] != null) {
                $this->setSessionVariables();
                return;
            }
            $this->noMatilha();
        }else if(isset($_SESSION[SESSAO_USUARIO_ID])) {
            $this->noMatilha();
        }
        else {
            $this->setSessionVariables();
        }
    }

    //* te leva para a página de erro por falta de matilhas
    public function noMatilha() {
        $this->loadView("pages/Errors/noMatilha.php", [], "", "");
        $_SESSION['controller'] = "Acesso";
        $_SESSION['ACTION'][$_SESSION['controller']] = 'noMatilha';
    }

    //* seta a URL e a ação escolhida numa variavel sessao com o nome do controller chamado
    public function setSessionVariables() {
        $url = strstr("$_SERVER[REQUEST_URI]", "action");
    
        $_SESSION['callAccessToken'] = false;

       
        if(isset($_GET['action'])) {
            $_SESSION['ACTION'][$_GET['controller']] = $_GET['action'];
            
        }
        if($url != false) {
            $_SESSION['URL'][$_GET['controller']] = "?" .$url;
        }
        
       
        $this->callRespectiveFunction();
    }  

    //* Chama a função correspente ao papel do usuário
    public function callRespectiveFunction() {
        if(isset($_SESSION[SESSAO_USUARIO_PAPEIS][0])) { $papelMethod = $_SESSION[SESSAO_USUARIO_PAPEIS][0]; }
        else { $papelMethod = "noSessionActive"; }
            

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

    //* dependendo do papel do usuário, enviará as ações disponiveis para a sessão atual
    public function LOBINHO() {
        $this->checkAndCallController(AcessoController::lobinhoActions);
    }
    public function CHEFE() {
        $this->checkAndCallController(AcessoController::chefeActions);
    }
    public function ADMINISTRADOR() {
        $this->checkAndCallController(AcessoController::administradorActions);
    }
    public function noSessionActive() {
        $this->checkAndCallController(AcessoController::noSessionActions);
    }

    //* trabalhará com o array recebido para verificar se a ação recebida faz parte desse array;
    //* se for, envia ao controller correspondente com a ação correspondente.
    //* Se não, envia à página de Acesso Negado.
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