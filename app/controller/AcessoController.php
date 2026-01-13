<?php
#Nome do arquivo: AcessoController.php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php"); // Importante: Incluir o DAO!

class AcessoController extends Controller {

    // Adicionei "login" e "logoff" nas ações permitidas sem sessão
    const noSessionActions = [
        "create", "home", "login", "logoff" 
    ];

    // ... (Mantenha as outras constantes: administradorActions, lobinhoActions, etc, como estavam) ...
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
        "openTarefa", "openTarefaUsuario", "home", "openTarefaOfEspecificUsuario", "logoff"
    ];

    const lobinhoActions = [
        "profile", "initialLobinhoPage", "listByIdAtiv", "openTarefa",
         "list", "listAtividades", "listTarefas", "home", "addTarefa", "logoff"
    ];  

    const chefeActions = [
        "createFrequencias", "listFrequencias", "listUsuarios", "listMatilhas", "listAtividades", "listTarefas", "listEncontros", "listUsuariosByMatilha",
        "create", "createTarefaAtiv",  "home", "initialChefePage", "edit", "delete", "save", "update", "findIt",
        "findUsuariosByIdAcateia", "findMatilhaById", "findIt", "openTarefa", "listUsuarios", 
        "openTarefaOfEspecificUsuario", "validateTarefa", "addTarefa", "addArquivo", "updateEntrega",
        "saveTarefa", "findById", "profile", "listByUsuario", 
        "findUsuariosByIdMatilha", "findUsuariosById",
        "findFrequenciasByIdEncontro", "findEncontroByIdEncontro", "updateToFalse", 
        "updateToTrue", "findFrequenciaById", "logoff"
    ];

    public function __construct() {  
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Se a ação for login ou logoff, permitimos passar direto sem verificar matilha
        if(isset($_GET['action']) && ($_GET['action'] == 'login' || $_GET['action'] == 'logoff')) {
            $this->setSessionVariables();
            return;
        }
  
        if(isset($_SESSION[SESSAO_USUARIO_ID_MATILHA])) {
            if($_SESSION[SESSAO_USUARIO_ID_MATILHA] != null) {
                $this->setSessionVariables();
                return;
            }
            $this->noMatilha();
        } else if(isset($_SESSION[SESSAO_USUARIO_ID])) {
            $this->noMatilha();
        }
        else {
            $this->setSessionVariables();
        }
    }

    // --- NOVA FUNÇÃO DE LOGIN ---
    public function login() {
        // Verifica se veio do formulário (POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? ''; // Certifique-se que o name no HTML é 'email'
            $senha = $_POST['senha'] ?? ''; // Certifique-se que o name no HTML é 'senha'

            $usuarioDAO = new UsuarioDAO();
            
            // Chama aquele método corrigido que fizemos (com o JOIN correto)
            $usuario = $usuarioDAO->findByEmailSenha($email, $senha);

            if ($usuario) {
                // Login Sucesso: Salvar na sessão
                $_SESSION[SESSAO_USUARIO_ID] = $usuario->getId();
                $_SESSION[SESSAO_USUARIO_NOME] = $usuario->getNome();
                // Assumindo que getPapeis retorna string, se for array, ajuste aqui
                $papeis = explode(',', $usuario->getPapeis()); 
                $_SESSION[SESSAO_USUARIO_PAPEIS] = $papeis; 
                $_SESSION[SESSAO_USUARIO_ID_MATILHA] = $usuario->getIdMatilha();

                // Redirecionar para a home correta
                $this->home(); 
            } else {
                // Login Inválido
                $dados = ['msg' => 'Email ou Senha inválidos!'];
                // Carrega a view de login novamente com erro
                // AJUSTE O CAMINHO ABAIXO para onde fica seu arquivo de login HTML/PHP
                $this->loadView("pages/login.php", $dados, "Login inválido", "", false);
            }
        } else {
            // Se não for POST, apenas mostra a tela de login
            $this->loadView("pages/login.php", [], "", "", false);
        }
    }

    public function logoff() {
        session_destroy();
        header("Location: index.php"); // Ou para onde for sua página inicial
        exit;
    }

    public function home() {
        // Lógica simples para redirecionar para a dashboard correta baseada no papel
        if(isset($_SESSION[SESSAO_USUARIO_PAPEIS])) {
            $papeis = $_SESSION[SESSAO_USUARIO_PAPEIS];
            if(in_array("ADMINISTRADOR", $papeis)) {
                // Carregar view de admin ou redirecionar
                // Exemplo: $this->loadView("pages/Admin/home.php", []);
                echo "Bem vindo Admin"; 
            } else {
                echo "Bem vindo Usuario";
            }
        } else {
            // Se não tá logado, manda pro login
            $this->login();
        }
    }

    // ... MANTENHA AS OUTRAS FUNÇÕES (noMatilha, setSessionVariables, etc) IGUAIS AO QUE MANDEI ANTES ...
    
    // ATENÇÃO: Copie as funções setSessionVariables, callRespectiveFunction, checkAndCallController 
    // e as funções de papel (LOBINHO, CHEFE, etc) da minha resposta anterior.
    
    // Vou reimprimir apenas a LOBINHO/CHEFE/ADMIN para garantir que chamem o checkAndCallController corretamente:
    public function LOBINHO() { $this->checkAndCallController(self::lobinhoActions); }
    public function CHEFE() { $this->checkAndCallController(self::chefeActions); }
    public function ADMINISTRADOR() { $this->checkAndCallController(self::administradorActions); }
    public function noSessionActive() { $this->checkAndCallController(self::noSessionActions); }
    
     public function noMatilha() {
        $this->loadView("pages/Errors/noMatilha.php", [], "", "");
        $_SESSION['controller'] = "Acesso";
        $_SESSION['ACTION'][$_SESSION['controller']] = 'noMatilha';
    }

    public function setSessionVariables() {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $url = strstr($uri, "action");
        $_SESSION['callAccessToken'] = false;
        if(isset($_GET['action'])) {
            $_SESSION['ACTION'][$_GET['controller']] = $_GET['action'];
        }
        if($url != false) {
            $_SESSION['URL'][$_GET['controller']] = "?" .$url;
        }
        $this->callRespectiveFunction();
    }  

    public function callRespectiveFunction() {
        if(isset($_SESSION[SESSAO_USUARIO_PAPEIS]) && is_array($_SESSION[SESSAO_USUARIO_PAPEIS]) && isset($_SESSION[SESSAO_USUARIO_PAPEIS][0])) { 
            $papelMethod = $_SESSION[SESSAO_USUARIO_PAPEIS][0]; 
        } else { 
            $papelMethod = "noSessionActive"; 
        }
        if(isset($_GET['controller'])) {
            $_SESSION['controller'] = $_GET['controller'];
            $method = $papelMethod;
            if(method_exists($this, $method)){ $this->$method(); } else { $this->noSessionActive(); }
        } else if(isset($_SESSION['controller'])) {
            $method = $papelMethod;
            if(method_exists($this, $method)){ $this->$method(); } else { $this->noSessionActive(); }
        } else {
            $this->loadView("pages/Errors/accessDenied.php", [], "", "");
        }
    }
    
    public function checkAndCallController($actions) {
        if(isset($_GET['action'])) {
            if(in_array($_GET['action'], $actions)) {
                $this->loadController($_GET['controller'], $_SESSION['URL'][$_GET['controller']] ?? "");
            } else { $this->loadView("pages/Errors/accessDenied.php", [], "", ""); }
        } else if(isset($_SESSION['controller']) && isset($_SESSION['ACTION'][$_SESSION['controller']])) {
            if(in_array($_SESSION['ACTION'][$_SESSION['controller']], $actions)) {
                $this->loadController($_SESSION['controller'], $_SESSION['URL'][$_SESSION['controller']] ?? "");
            } else { $this->loadView("pages/Errors/accessDenied.php", [], "", ""); }
        } else {
            $this->loadView("pages/Errors/accessDenied.php", [], "", "");
        }
    }
}
$AcessoCont = new AcessoController();