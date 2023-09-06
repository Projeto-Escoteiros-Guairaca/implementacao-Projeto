<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../model/Alcateia.php");


class UsuarioDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u ORDER BY u.nome";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapUsuarios($result);
       
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

    public function changeAlcateia($id, $idAlcateia) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_usuarios SET id_alcateia = :idalcateia WHERE id_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->bindValue("idalcateia", $idAlcateia);
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
    public function findByLoginSenha(string $login, string $senha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.login = ? AND u.senha = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$login, $senha]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByLoginSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_usuarios (id_endereco, id_contato, nome, cpf, login, senha)" .
               " VALUES (:id_endereco, :id_contato, :nome, :cpf, :login, :senha)";
        $stm = $conn->prepare($sql);
        
        $stm->bindValue("id_endereco", $usuario->getEndereco()->getId_endereco());
        $stm->bindValue("id_contato", $usuario->getContato()->getId_contato());
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("login", $usuario->getLogin());
        $stm->bindValue("senha", $usuario->getSenha());
        $stm->execute();

    }

    public function findUsuariosByIdAcateia(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios e" .
               " WHERE e.id_alcateia = ? ORDER BY e.id_usuario";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
       return $this->mapUsuarios($result);
    }
    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_usuarios SET nome = :nome, cpf = :cpf, login = :login," . 
               " senha = :senha, papeis = :papeis" .   
               " WHERE id_usuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("login", $usuario->getLogin());
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

    public function findUsuariosByIdAlcateia(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.id_alcateia = ?";
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
    public function findPrimo(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios u" .
               " WHERE u.id_alcateia = ? and u.papeis = 'USUARIO' ";
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

        $alcateias = $this->mapContatos($result);
        
        return $alcateias;
    }
     
    public function mapContatos($result) {
        foreach ($result as $reg) {
            $contato = new Contato();
            $contato->setId_contato($reg['id_contato']);
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
            $usuario->setLogin($reg['login']);
            $usuario->setSenha($reg['senha']);
            $usuario->setPapeis($reg['papeis']);
            $usuario->setStatus($reg['status_usuario']);

            //Seta os campos provisórios
            $usuario->setIdEndereco($reg['id_endereco']);
            $usuario->setIdContato($reg['id_contato']);
            $usuario->setIdAlcateia($reg['id_alcateia']);

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

        $sql = "SELECT * FROM `tb_usuarios` u WHERE u.nome LIKE '%".$word."%' ";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapUsuarios($result);
    }
}