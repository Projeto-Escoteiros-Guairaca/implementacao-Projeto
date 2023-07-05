<?php

include_once(__DIR__ . "/../connection/Connection.php");
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

    public function findUsuariosByIdAcateia(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_usuarios e" .
               " WHERE e.id_alcateia = ? ORDER BY e.id_usuario";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
       return $this->mapUsuarios($result);
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
    
    public function findEncontroByIdEncontro(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros f" .
               " WHERE f.id_encontro = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        
       return $this->mapEncontro($result);
    }
    private function mapEncontro($result){
        $encontros = array();
        foreach ($result as $reg) {
            $encontro = new Encontro();
            $encontro->setData($reg['data']);
            array_push($encontros, $encontro);
        }
        return $encontros;
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
