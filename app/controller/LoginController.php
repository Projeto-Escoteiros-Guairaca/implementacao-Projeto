<?php 
#Classe controller para a Logar do sistema
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../service/LoginService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Matilha.php");

class LoginController extends Controller {

    private LoginService $loginService;
    private UsuarioDAO $usuarioDao;
    private MatilhaDAO $matilhaDao;

    public function __construct() {

        $this->loginService = new LoginService();
        $this->usuarioDao = new UsuarioDAO();
        $this->matilhaDao = new MatilhaDAO();

        $this->setActionDefault('login',true);
        $this->handleAction();
    }

    //* envia à pagina login
    protected function login() {
        $this->loadView("pages/login/login.php", [], "", "", true);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logon() {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        //Validar os campos
        $erros = $this->loginService->validarCampos($email, $senha);
        if(empty($erros)) {
            //Valida o login a partir do banco de dados
            $usuario = $this->usuarioDao->findByEmailSenha($email, $senha);
            if($usuario) {
                    $this->salvarUsuarioSessao($usuario);
                    
                header("location: " . HOME_PAGE);
                exit;
            
            }
             else {
                $erros = ["Login ou senha informados são inválidos!"];
            }
        }

        //Se há erros, volta para o formulário            
        $msg = implode("<br>", $erros);
        $dados["email"] = $email;
        $dados["senha"] = $senha;

        $this->loadView("pages/login/login.php", $dados, $msg, "", true);
    }
    private function salvarUsuarioSessao(Usuario $usuario) {
        //Habilitar o recurso de sessão no PHP nesta página

        //Setar usuário na sessão do PHP
        $_SESSION[SESSAO_USUARIO_ID]   = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_ID_MATILHA] = $usuario->getIdMatilha();
        $_SESSION[SESSAO_USUARIO_NOME] = $usuario->getNome();
        $_SESSION[SESSAO_USUARIO_PAPEIS] = $usuario->getPapeisAsArray();
        if($usuario->getIdMatilha() == null or $usuario->getPapeisAsArray() == "ADMINISTRADOR") {
            $this->loadController("Acesso");
            die;
        }
        else {
            $matilha = $this->matilhaDao->findById($usuario->getIdMatilha());
            $_SESSION[SESSAO_USUARIO_ID_ALCATEIA] = $matilha->getIdAlcateia();
        }
        
    }

    //* função feita para desconectar a sessão ativa
    protected function logout() {
        $this->removerUsuarioSessao();

        $this->loadView("pages/home/index.php", [], "", "", true);
    }
    private function removerUsuarioSessao() {
        //Habilitar o recurso de sessão no PHP nesta página
        //Destroi a sessão 
        session_destroy();
    }
}


#Criar objeto da classe
$loginCont = new LoginController();
