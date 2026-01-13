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

        $this->setActionDefault('login', true);
        $this->handleAction();
    }

    protected function login() {
        $this->loadView("pages/login/login.php", [], "", "", true);
    }

    protected function logon() {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        // 1. Validar os campos
        $erros = $this->loginService->validarCampos($email, $senha);

        if(empty($erros)) {
            // 2. Valida o login a partir do banco de dados
            $usuario = $this->usuarioDao->findByEmailSenha($email, $senha);
            
            // REMOVIDO: print_r($usuario); (Isso quebraria o header location)

            if($usuario) {
                // 3. Salva na sessão
                $this->salvarUsuarioSessao($usuario);
                
                // 4. Lógica de Redirecionamento movida para cá para ficar mais limpo
                $papeis = $usuario->getPapeisAsArray(); // Assume que retorna array
                
                // Se for Admin ou não tiver matilha, vai para uma area, senão vai para a Home
                if ($usuario->getIdMatilha() == null || in_array("ADMINISTRADOR", $papeis)) {
                     // Nota: Se o loadController já carrega view e sai, ok. 
                     // Mas o ideal em MVC é redirecionar via header.
                     $this->loadController("Acesso"); 
                     exit; 
                } else {
                    header("location: " . HOME_PAGE);
                    exit;
                }
            } else {
                $erros[] = "Login ou senha informados são inválidos!";
            }
        }

        // Se há erros, volta para o formulário            
        $msg = implode("<br>", $erros);
        $dados["email"] = $email;
        // Não devolvemos a senha por segurança
        $dados["senha"] = ""; 

        $this->loadView("pages/login/login.php", $dados, $msg, "", true);
    }

    private function salvarUsuarioSessao(Usuario $usuario) {
        // Certifique-se que session_start() foi chamado no index.php ou no construtor do Pai
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[SESSAO_USUARIO_ID]           = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_ID_MATILHA]   = $usuario->getIdMatilha();
        $_SESSION[SESSAO_USUARIO_NOME]         = $usuario->getNome();
        $_SESSION[SESSAO_USUARIO_PAPEIS]       = $usuario->getPapeisAsArray();
        
        // Verifica se existe ID de matilha antes de buscar no banco
        if($usuario->getIdMatilha()) {
            $matilha = $this->matilhaDao->findById($usuario->getIdMatilha());
            
            // Verificação de segurança para não quebrar se a matilha não for encontrada
            if ($matilha) {
                $_SESSION[SESSAO_USUARIO_ID_ALCATEIA] = $matilha->getIdAlcateia();
            } else {
                $_SESSION[SESSAO_USUARIO_ID_ALCATEIA] = null; // Ou trate o erro
            }
        }
    }

    protected function logout() {
        $this->removerUsuarioSessao();
        // Redireciona para home ou login após logout
        $this->loadView("pages/home/index.php", [], "", "", true);
    }

    private function removerUsuarioSessao() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        // Boa prática: limpar o array da sessão também
        $_SESSION = array();
    }
}
$loginCont = new LoginController();