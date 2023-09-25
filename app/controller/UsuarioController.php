<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");

require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/EnderecoDAO.php");
require_once(__DIR__ . "/../dao/ContatoDAO.php");

require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");

require_once(__DIR__ . "/../model/Alcateia.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Endereco.php");
require_once(__DIR__ . "/../model/Contato.php");
require_once(__DIR__ . "/../model/enum/UsuarioPapel.php");

class UsuarioController extends Controller {

    private AlcateiaDAO $alcateiaDao;
    private UsuarioDAO $usuarioDao;
    private EnderecoDAO $enderecoDao;
    private ContatoDAO $contatoDao;
    private UsuarioService $usuarioService;

    public function __construct() {
        
            $isRegistering = false;
            $papelNecessario = array();
            $accessVerified = true;
           
            if(isset($_GET['action'])) {
                if($_GET['action'] == "create" or $_GET['action'] == "save") {
                    $isRegistering = true;
                }
                else {
                    $papelNecessario[0] = "ADMINISTRADOR";
                    $accessVerified = $this->verifyAccess($papelNecessario);
                }
            }
            else {
                $papelNecessario[0] = "ADMINISTRADOR";
                $accessVerified = $this->verifyAccess($papelNecessario);
            }
           
            if(! $accessVerified and $isRegistering == false) {
                return;
            }
        $this->alcateiaDao = new AlcateiaDAO();
        $this->usuarioDao = new UsuarioDAO();
        $this->enderecoDao = new EnderecoDAO();
        $this->contatoDao = new ContatoDAO();
        $this->usuarioService = new UsuarioService();

        $this->setActionDefault("list", true);
        $this->handleAction();
    }

    protected function profile(string $msgErro = "", string $msgSucesso = ""){

        $usuario = $this->findUsuarioById();

        if($usuario){
            $endereco = $this->enderecoDao->findById($usuario-> getIdEndereco());
            $usuario->setEndereco($endereco);
            $contato = $this->contatoDao->findById($usuario->getIdContato());
            $usuario->setContato($contato);

            $dados["id_endereco"] = $endereco -> getId_endereco();
            $dados["id_contato"] = $contato -> getId_contato();
            $dados["id"] = $usuario->getId();
            $dados["papeis"] = UsuarioPapel::getAllAsArray();
            $usuario->setSenha("");
            $dados["usuario"] = $usuario;        
            $this->loadView("pages/usuario/profile.php", $dados, $msgErro, $msgSucesso, false);
        } else {
            $this->list("Usuário não encontrado.");
        }

    }

    /* Método para chamar a view com a listagem dos Usuarios */
    protected function list(string $msgErro = "", string $msgSucesso = "") {
      
        $usuarios = $this->usuarioDao->list();
        $alcateias = $this->alcateiaDao->list();

        foreach($usuarios as $usu) {
            if($usu->getIdAlcateia()) {
                foreach($alcateias as $alc) {
                    if($usu->getIdAlcateia() == $alc->getId_alcateia()) {
                        $usu->setAlcateia($alc);
                    }

                }
            }
        }
        $dados["lista"] = $usuarios;
        $this->loadView("pages/usuario/list.php", $dados,$msgErro, $msgSucesso, true);
    }

    public function listUsuariosByAlcateia(string $msgErro = "", string $msgSucesso = "") {
        $usuarios = $this->findUsuarioByIdAlcateia();
        $dados["lista"] = $usuarios['usuarios'];
        $dados["alcateia"] = $usuarios['nome_alcateia'];

        $this->loadView("pages/usuario/listUsuariosByAlcateia.php", $dados,$msgErro, $msgSucesso, false);
    }
    protected function findUsuarioByIdAlcateia(){
        $id = 0;
        if(isset($_GET['idAlcateia']))
            $id = $_GET['idAlcateia'];

        $alcateia = $this->alcateiaDao->findById($id); 
        $usuario = $this->usuarioDao->findUsuariosByIdAlcateia($id);
        
        $dados['nome_alcateia'] = $alcateia;
        $dados['usuarios'] = $usuario;
        return $dados;
    }

    protected function create() {
        $dados["id"] = 0;
        $dados['id_contato'] = 0;
        $dados['id_endereco'] = 0;

        $dados["papeis"] = UsuarioPapel::getAllAsArray();
        $this->loadView("pages/usuario/form.php", $dados, "", "", true);
    }

    protected function edit() {
        $usuario = $this->findUsuarioById();

        if($usuario){
            $endereco = $this->enderecoDao->findById($usuario-> getIdEndereco());
            $usuario->setEndereco($endereco);
            $contato = $this->contatoDao->findById($usuario->getIdContato());
            $usuario->setContato($contato);

            $dados["id_endereco"] = $endereco -> getId_endereco();
            $dados["id_contato"] = $contato -> getId_contato();
            $dados["id"] = $usuario->getId();
            $dados["papeis"] = UsuarioPapel::getAllAsArray();
            $usuario->setSenha("");
            $dados["usuario"] = $usuario;        

            $this->loadView("pages/usuario/form.php", $dados, "", "", true);
        } else {
            $this->list("Usuário não enconpages/ado.");
        }

    }
    
    protected function save() {
        
        $dados["id_endereco"] = isset($_POST['id_endereco']) ? $_POST['id_endereco'] : 0;
        $dados["id_contato"] = isset($_POST['id_contato']) ? $_POST['id_contato'] : 0;
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $confSenha = isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : "";
        
        $endereco = $this->saveEndereco();
        $contato = $this->saveContato();
        $usuario = $this->saveUsuario($endereco, $contato);
        //Validar os dados
        $errorUsuario = $this->usuarioService->validarUsuario($usuario, $confSenha);
        $errorContato = $this->usuarioService->validarContato($contato);
        $errorEndereco = $this->usuarioService->validarEndereco($endereco);
        $erros = array_merge($errorUsuario, $errorContato, $errorEndereco);

        if(empty($erros)) {
            //Persiste o objeto
            try {
                if($dados["id"] == 0){ //Inserindo
                    $this->usuarioService->insertEnd($endereco);
                    $this->usuarioService->insertCont($contato);
                    $this->usuarioService->insertUsu($usuario);
                }
                else {//Alterando
                    $usuario->setId($dados["id"]);
                    $this->usuarioService->updateUsu($usuario);
                    $endereco->setId_endereco($dados["id_endereco"]);
                    $this->usuarioService->updateEnd($endereco);
                    $contato->setId_contato($dados["id_contato"]);
                    $this->usuarioService->updateCont($contato);
                }
                // - Enviar mensagem de sucesso
                if($dados["id"] > 0) {
                    $_GET['id'] = $dados["id"];
                    $this->profile();
                }
                else {
                    $this->LoadController('Login', '?action=login', true);
                }
                exit;
            } catch (PDOException $e) {
                $erros = ["[Erro ao salvar o usuário na base de dados.]"];
            }
        }

        //Se há erros, volta para o formulário
        
        //TODO - Transformar o array de erros em string
        $dados["usuario"] = $usuario;
        $dados["nome"] = $usuario->getNome();
        $dados["cpf"] = $usuario->getCpf();
        $dados["login"] = $usuario->getLogin();
        $dados["senha"] = $usuario->getSenha();
        $dados["confSenha"] = $confSenha;
        $dados["papeis"] = UsuarioPapel::getAllAsArray();
        $dados["endereco"] = $endereco;
        $dados["contato"] = $contato;
        $dados["cep"] = $endereco->getCep();
        $dados["logradouro"] = $endereco->getLogradouro();
        $dados["numeroEndereco"] = $endereco->getNumeroEndereco();
        $dados["bairro"] = $endereco->getBairro();
        $dados["cidade"] = $endereco->getCidade();
        $dados["pais"] = $endereco->getPais();
        $dados["telefone"] = $contato->getTelefone();
        $dados["celular"] = $contato->getCelular();
        $dados["email"] = $contato->getEmail();

        $msgsErro = implode("<br>", $erros);
        $this->loadView("pages/usuario/form.php", $dados, $msgsErro, "", "", true);
    }
    protected function saveEndereco() {
          // Captura dados endereço
          $cep = isset($_POST['cep']) ? trim($_POST['cep']) : NULL;
          $logradouro = isset($_POST['logradouro']) ? trim($_POST['logradouro']) : "";
          $numero = isset($_POST['numeroEndereco']) ? trim($_POST['numeroEndereco']) : "";
          $bairro = isset($_POST['bairro']) ? trim($_POST['bairro']) : "";
          $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : "";
          $pais = isset($_POST['pais']) ? trim($_POST['pais']) : "";
          // Cria objeto endereço
          $endereco = new Endereco();
          $endereco->setCep($cep);
          $endereco->setLogradouro($logradouro);
          $endereco->setNumeroEndereco($numero);
          $endereco->setBairro($bairro);
          $endereco->setCidade($cidade);
          $endereco->setPais($pais);
    return $endereco;
    }
    protected function saveContato() {
         // Captura dados contato
         $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : "";
         $celular = isset($_POST['celular']) ? trim($_POST['celular']) : "";
         $email = isset($_POST['email']) ? trim($_POST['email']) : ""; 
         // Cria objeto contato
         $contato = new Contato();
         $contato->setTelefone($telefone);
         $contato->setCelular($celular);
         $contato->setEmail($email);
    return $contato;
    }
    protected function saveUsuario(Endereco $endereco, Contato $contato) {
         //Captura os dados do usuário
         $id_endereco["id_endereco"] = isset($_POST['id_endereco']) ? $_POST['id_endereco'] : 0;
         $id_contato["id_contato"] = isset($_POST['id_contato']) ? $_POST['id_contato'] : 0;
         $nome = isset($_POST['nome']) ? trim($_POST['nome']) : "";
         $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : "";
         $login = isset($_POST['login']) ? trim($_POST['login']) : "";
         $senha = isset($_POST['senha']) ? trim($_POST['senha']) : "";
         //Captura os papeis do usuário
        
          //Cria objeto Usuario
          $usuario = new Usuario();
          $usuario->setNome($nome);
          $usuario->setEndereco($endereco);
          $usuario->setContato($contato);
          $usuario->setCpf($cpf);
          $usuario->setLogin($login);
          $usuario->setSenha($senha);
    return $usuario;
    }
    
    protected function findIt() {
        $arrayUsuarios = $this->usuarioDao->findItByName($_GET["word"]);
        $alcateias = $this->alcateiaDao->list();

        foreach($arrayUsuarios as $usu) {
            if($usu->getIdAlcateia()) {
                foreach($alcateias as $alc) {
                    if($usu->getIdAlcateia() == $alc->getId_alcateia()) {
                        $usu->setAlcateia($alc);
                    }
                }
            }
        }
        echo json_encode($arrayUsuarios);

        return;
    }

    protected function changeAlcateia(){
        $id = $_GET["id"];
        $idAlcateia = $_GET["idAlcateia"];
        $this->usuarioDao->changeAlcateia($id, $idAlcateia);
        $alcateia = $this->alcateiaDao->findById($idAlcateia);
        return;
        
    }

    protected function updateToInativo(){
        $usuario = $this->findUsuarioById();
        if($usuario){
            $this->usuarioDao->updateToInativo($usuario->getId());
            echo "INATIVO";
            return;
        }
    }
    protected function updateToAtivo(){
        $usuario = $this->findUsuarioById();
        if($usuario){
            $this->usuarioDao->updateToAtivo($usuario->getId());
            echo "ATIVO";
            return;
        }
    }

    protected function findUsuarioById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $dados["id"] = $id;

        $usuario = $this->usuarioDao->findById($id);
        return $usuario;
    }

    protected function changePapel(){
        $papelUsu = $_GET['newPapel'];

        $usuario = $this->findUsuarioById();
        if($usuario){
            $this->usuarioDao->changePapel($usuario->getId(), $papelUsu);
            echo $papelUsu;
            return;
        }
    }
   
   
}
#Criar objeto da classe
$usuCont = new UsuarioController();
