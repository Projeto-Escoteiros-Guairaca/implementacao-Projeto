<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../model/Matilha.php");


class UsuarioDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u " .
        "INNER JOIN tb_enderecos e ON u.id_endereco = e.id_endereco " .
        "INNER JOIN tb_contatos c ON u.id_contato = c.id_contato ORDER BY u.id_usuario";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapFullUsuarios($result);
       
    }
    
    public function findUsuariosById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios e" .
               " WHERE e.id_usuario = ? ORDER BY e.id_usuario";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
       $usuario = $this->mapUsuarios($result);
       if(count($usuario) == 1)
       return $usuario[0];
        elseif(count($usuario) == 0)
       return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    public function changeMatilha($id, $idMatilha) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_usuarios SET id_matilha = :idmatilha WHERE id_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->bindValue("idmatilha", $idMatilha);
        $stm->execute();
    }
    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.id_usuario = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }


    //Método para buscar um usuário por seu login e senha
    public function findByEmailSenha(string $gmail, string $senha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u " .
        "INNER JOIN tb_contatos c ON u.id_contato = c.id_contato" .
               " WHERE c.email = ? AND u.senha = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$gmail, $senha]);
        $result = $stm->fetchAll();
        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByEmailSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    public function mapUsuarioAndMatilha($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id_usuario']);
            $usuario->setNome($reg['nome']);
            $usuario->setCpf($reg['cpf']);
            $usuario->setSenha($reg['senha']);
            $usuario->setPapeis($reg['papeis']);
            $usuario->setStatus($reg['status_usuario']);
            //Seta os campos provisórios
            $usuario->setIdEndereco($reg['id_endereco']);
            $usuario->setIdContato($reg['id_contato']);
            $usuario->setIdMatilha($reg['id_matilha']);

            $matilha = new Matilha();
            $matilha->setIdMatilha($reg['id_matilha']);
            $matilha->setIdAlcateia($reg['id_alcateia']);

            $usuario->setMatilha($matilha);
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_usuarios (id_endereco, id_contato, nome, cpf, senha)" .
               " VALUES (:id_endereco, :id_contato, :nome, :cpf, :senha)";
        $stm = $conn->prepare($sql);
        
        $stm->bindValue("id_endereco", $usuario->getEndereco()->getIdEndereco());
        $stm->bindValue("id_contato", $usuario->getContato()->getIdContato());
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("senha", $usuario->getSenha());
        $stm->execute();

    }

    public function listUsuariosByIdMatilha(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u " .
        "INNER JOIN tb_enderecos e ON u.id_endereco = e.id_endereco " .
        "INNER JOIN tb_contatos c ON u.id_contato = c.id_contato".
               " WHERE u.id_matilha = ? ORDER BY u.id_usuario";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
       return $this->mapFullUsuarios($result);
    }
    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_usuarios SET nome = :nome, cpf = :cpf," . 
               " senha = :senha, papeis = :papeis" .   
               " WHERE id_usuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("senha", $usuario->getSenha());
        $stm->bindValue("papeis", $usuario->getPapeis());
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_usuarios WHERE id_usuario = :id";
         
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }
    public function updateToInativo(){
        $conn = Connection::getConn();
        $sql = "UPDATE tb_usuarios SET status_usuario = 'INATIVO' WHERE id_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $_GET['id']);
        $stm->execute();
    }
    public function updateToAtivo(){
        $conn = Connection::getConn();
        $sql = "UPDATE tb_usuarios SET status_usuario = 'ATIVO' WHERE id_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $_GET['id']);
        $stm->execute();
    }

    public function changePapel($id, $papelUsu){
        trim($papelUsu);
        $conn = Connection::getConn();
        $sql = "UPDATE tb_usuarios SET papeis = :papelUsu WHERE id_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("papelUsu", $papelUsu);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function findUsuariosByIdMatilha(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.id_matilha = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        return $usuarios;
    }
    public function findPrimo(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.id_matilha = ? and u.papeis = 'USUARIO' ";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);
               
        foreach($usuarios as $us):  
            $contato = $this->findContatosByIdUsuarios($us->getIdContato());
            $us->setContatoEmail($contato->getEmail());
            $us->setContatoCelular($contato->getCelular());

        endforeach;

            
        return $usuarios;
    }

    public function findContatosByIdUsuarios(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_contatos c" .
               " WHERE c.id_contato = ?"; 
            
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $matilhas = $this->mapContatos($result);
        
        return $matilhas;
    }
     
    public function mapContatos($result) {
        foreach ($result as $reg) {
            $contato = new Contato();
            $contato->setIdContato($reg['id_contato']);
            $contato->setEmail($reg['email']);
            $contato->setCelular($reg['celular']);
        }
        
        return $contato;
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id_usuario']);
            $usuario->setNome($reg['nome']);
            $usuario->setCpf($reg['cpf']);
            $usuario->setSenha($reg['senha']);
            $usuario->setPapeis($reg['papeis']);
            $usuario->setStatus($reg['status_usuario']);

            //Seta os campos provisórios
            $usuario->setIdEndereco($reg['id_endereco']);
            $usuario->setIdContato($reg['id_contato']);
            $usuario->setIdMatilha($reg['id_matilha']);
            
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

   
    private function mapFullUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id_usuario']);
            $usuario->setNome($reg['nome']);
            $usuario->setCpf($reg['cpf']);
            $usuario->setSenha($reg['senha']);
            $usuario->setPapeis($reg['papeis']);
            $usuario->setStatus($reg['status_usuario']);

            $endereco = new Endereco();
            $endereco->setBairro($reg['bairro']);
            $endereco->setCep($reg['cep']);
            $endereco->setPais($reg['pais']);
            $endereco->setCidade($reg['cidade']);
            $endereco->setLogradouro($reg['logradouro']);
            $endereco->setNumeroEndereco($reg['numero_endereco']);
            $usuario->setEndereco($endereco);
            
            $contato = new Contato();
            $contato->setEmail($reg['email']);
            $contato->setCelular($reg['celular']);
            $contato->setTelefone($reg['telefone']);
            $usuario->setContato($contato);
            //Seta os campos provisórios
            $usuario->setIdMatilha($reg['id_matilha']);

            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    public function findByPapel($papel){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u WHERE u.papeis = ? ORDER BY u.nome";
        $stm = $conn->prepare($sql);
        $stm->execute([$papel]);
        $result = $stm->fetchAll();
        return $this->mapUsuarios($result);
    }
    
    public function findItByName(string $word) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM `tb_usuarios` u ".
        "INNER JOIN tb_enderecos e ON u.id_endereco = e.id_endereco " .
        "INNER JOIN tb_contatos c ON u.id_contato = c.id_contato WHERE u.nome LIKE '%".$word."%' ORDER BY u.id_usuario";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapFullUsuarios($result);
    }

    public function findItByNameAndMatilha(string $word, int $idMatilha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM `tb_usuarios` u ".
        "INNER JOIN tb_enderecos e ON u.id_endereco = e.id_endereco " .
        "INNER JOIN tb_contatos c ON u.id_contato = c.id_contato WHERE u.nome LIKE '%".$word."%' AND u.id_matilha = ".$idMatilha." ORDER BY u.id_usuario";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapFullUsuarios($result);   
    }
    public function usuarioSended($id) {
            $conn = Connection::getConn();

            $sql = " SELECT * FROM  tb_usuarios u INNER JOIN tb_tarefas_usuarios tu ON tu.id_tarefa = u.id_usuario ".
            "INNER JOIN tb_tarefas t ON t.id_tarefa = tu.id_tarefa WHERE u.id_usuario = ?";
            $stm = $conn->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
            if($result == null) {
                return false;
            }
            else {
                
                return true;
            }

    }
}