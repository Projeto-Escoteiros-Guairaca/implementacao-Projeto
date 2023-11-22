<?php 
#Classe controller para a Logar do sistema
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/LoginService.php");
require_once(__DIR__ . "/../model/Usuario.php");

class LoginController extends Controller {

    private LoginService $loginService;
    private UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->loginService = new LoginService();
        $this->usuarioDao = new UsuarioDAO();
        $this->setActionDefault('login',true);
        $this->handleAction();
    }

    protected function login() {
        $this->loadView("pages/login/login.php", [], "", "", true);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logon() {
        $login = isset($_POST['login']) ? trim($_POST['login']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        //Validar os campos
        $erros = $this->loginService->validarCampos($login, $senha);
        if(empty($erros)) {
            //Valida o login a partir do banco de dados
            $usuario = $this->usuarioDao->findByLoginSenha($login, $senha);
            if($usuario) {
                //Se encontrou o usuário, salva a sessão e redireciona para a HOME do sistema
                $this->salvarUsuarioSessao($usuario);

                header("location: " . HOME_PAGE);
                exit;
            } else {
                $erros = ["Login ou senha informados são inválidos!"];
            }
        }

        //Se há erros, volta para o formulário            
        $msg = implode("<br>", $erros);
        $dados["login"] = $login;
        $dados["senha"] = $senha;

        $this->loadView("pages/login/login.php", $dados, $msg, "", true);
    }

     /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logout() {
        $this->removerUsuarioSessao();

        $this->loadView("pages/home/index.php", [], "", "", true);
    }

    private function salvarUsuarioSessao(Usuario $usuario) {
        //Habilitar o recurso de sessão no PHP nesta página

        //Setar usuário na sessão do PHP
        $_SESSION[SESSAO_USUARIO_ID]   = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_ID_MATILHA] = $usuario->getIdMatilha();
        $_SESSION[SESSAO_USUARIO_NOME] = $usuario->getNome();
        $_SESSION[SESSAO_USUARIO_PAPEIS] = $usuario->getPapeisAsArray();
        $_SESSION[SESSAO_USUARIO_ID_ALCATEIA] = $usuario->getMatilha()->getIdAlcateia();
    }

    private function removerUsuarioSessao() {
        //Habilitar o recurso de sessão no PHP nesta página
        //Destroi a sessão 
        session_destroy();
    }
}


#Criar objeto da classe
$loginCont = new LoginController();
