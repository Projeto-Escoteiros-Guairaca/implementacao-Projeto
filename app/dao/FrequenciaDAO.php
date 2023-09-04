<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Frequencia.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../model/Encontro.php");


class FrequenciaDAO {

    public function create(array $frequencia) {
        $conn = Connection::getConn();

        foreach($frequencia as $freq) {

        $sql = "INSERT INTO tb_frequencias (id_usuario, id_encontro)" .
        " VALUES (:id_usuario, :id_encontro)";
 
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_usuario', $freq->getUsuario()->getId());
        $stm->bindValue(':id_encontro', $freq->getId_encontro());
        $stm->execute();
        }
    }
    
    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_frequencias e ORDER BY e.id_encontro";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapFrequencia($result);
    }

    public function listFrequenciasByIdUsuario($id) {
        
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_frequencias e WHERE e.id_usuario = ? ORDER BY e.id_encontro DESC";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        
        return $this->mapFrequencia($result);
        
    }
   

    public function findFrequenciaByIdEncontro(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_frequencias f" .
               " WHERE f.id_encontro = ? ORDER BY f.id_usuario";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        
       return $this->mapFrequencia($result);
    }
    private function mapFrequencia($result){
        $frequencias = array();
        foreach ($result as $reg) {
            $frequencia = new frequencia();
            $frequencia->setId_usuario($reg['id_usuario']);
            $frequencia->setId_frequencia($reg['id_frequencia']);
            $frequencia->setId_encontro($reg['id_encontro']);
            $frequencia->setFrequencia($reg['frequencia']);


            array_push($frequencias, $frequencia);
        }
        return $frequencias;
    }
   public function updateToFalse(){
        $conn = Connection::getConn();
        $sql = "UPDATE tb_frequencias SET frequencia = 0 WHERE id_frequencia = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $_GET['id']);
        $stm->execute();

        
}
    public function updateToTrue(){
        $conn = Connection::getConn();
        $sql = "UPDATE tb_frequencias SET frequencia = 1 WHERE id_frequencia = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $_GET['id']);
        $stm->execute();
}
  //Método para buscar um usuário por seu ID
    public function findById(int $id) {
    $conn = Connection::getConn();

    $sql = "SELECT * FROM tb_frequencias u" .
           " WHERE u.id_frequencia = ?";
    $stm = $conn->prepare($sql);    
    $stm->execute([$id]);
    $result = $stm->fetchAll();

    $frequencias = $this->mapFrequencia($result);
    if(count($frequencias) == 1)
        return $frequencias[0];
    elseif(count($frequencias) == 0)
        return null;

    die("UsuarioDAO.findById()" . 
        " - Erro: mais de um usuário encontrado.");
}
}
