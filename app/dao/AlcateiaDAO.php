<?php
    
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/Alcateia.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Contato.php");


class AlcateiaDao{

    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_alcateias a ORDER BY a.id_alcateia";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapAlcateia($result);
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
    public function mapUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id_usuario']);
            $usuario->setNome($reg['nome']);
            $usuario->setIdContato($reg['id_contato']);

            array_push($usuarios, $usuario);
        }

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
    

    public function findById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_alcateias a" .
               " WHERE a.id_alcateia = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $alcateias = $this->mapAlcateia($result);

        if(count($alcateias) == 1)
            return $alcateias[0];
        elseif(count($alcateias) == 0)
            return null;

        die("AlcateiaDAO.findById()" . 
            " - Erro: mais de uma alcateia encontrada.");
    }

    public function mapAlcateia($result){
        $alcateias = array();
        foreach ($result as $reg) {
            $alcateia = new Alcateia();
            $alcateia->setId_alcateia($reg['id_alcateia']);
            $alcateia->setNome($reg['nome']);
            array_push($alcateias, $alcateia);
        }

        return $alcateias;
    }

    public function insert(Alcateia $alcateia){
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_alcateias (nome)" .
               " VALUES (:nome)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue(':nome', $alcateia->getNome());
        $stm->execute();
    }

    public function update(Alcateia $alcateia) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_alcateias SET nome = :nome" . 
               " WHERE id_alcateia = :id";
           
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $alcateia->getNome());
        $stm->bindValue("id", $alcateia->getId_alcateia());
        $stm->execute();
    }
    
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_alcateias WHERE id_alcateia = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }
}