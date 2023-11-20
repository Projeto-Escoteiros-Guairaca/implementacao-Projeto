<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Contato.php");

class ContatoDAO{
    //Método para listar os contatos a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_contatos c ORDER BY c.email";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapContatos($result);
    }

    //Método para buscar um contato por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_contatos c" .
               " WHERE c.id_contato = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $contatos = $this->mapContatos($result);

        if(count($contatos) == 1)
            return $contatos[0];
        elseif(count($contatos) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um contato encontrado.");
    }

    private function mapContatos($result) {
        $contatos = array();
        foreach ($result as $reg) {
            $contato = new Contato();
            $contato->setIdContato($reg['id_contato']);
            $contato->setTelefone($reg['telefone']);
            $contato->setCelular($reg['celular']);
            $contato->setEmail($reg['email']);
            array_push($contatos, $contato);
        }

        return $contatos;
    }

    //Método para inserir um Contato na base de dados
    public function insert(Contato $contato) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_contatos (telefone, celular, email)" .
               " VALUES (:telefone, :celular, :email)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("telefone", $contato->getTelefone());
        $stm->bindValue("celular", $contato->getCelular());
        $stm->bindValue("email", $contato->getEmail());
        $stm->execute();

        $contato->setIdContato($conn->lastInsertId());

    }

    public function update(Contato $contato) {

        
        $conn = Connection::getConn();

        $sql = "UPDATE tb_contatos SET telefone = :telefone, celular = :celular, email = :email" .   
               " WHERE id_contato = :id_contato";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("telefone", $contato->getTelefone());
        $stm->bindValue("celular", $contato->getCelular());
        $stm->bindValue("email", $contato->getEmail());
        $stm->bindValue("id_contato", $contato->getIdContato());
        $stm->execute();

        
    }

    //Método para excluir um Contatos pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_contatos WHERE id_contato = :id_contato";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_contato", $id);
        $stm->execute();
    }
}