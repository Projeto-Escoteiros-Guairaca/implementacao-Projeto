<?php
    
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Matilha.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Contato.php");


class MatilhaDao{

    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_matilhas a ".
         " ORDER BY a.id_matilha";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapMatilha($result);
    }

    public function listByIdAlcateia($id){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_matilhas m ".
         "WHERE m.id_alcateia = ? ORDER BY m.id_alcateia";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        return $this->mapMatilha($result);
    }

    public function FullList(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_matilhas a ".
         "INNER JOIN tb_usuarios u ON a.id_usuario_chefe = u.id_usuario ORDER BY a.id_matilha";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapFullMatilha($result);
    }
   
    public function findById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_matilhas a" .
               " WHERE a.id_matilha = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $matilhas = $this->mapMatilha($result);

        if(count($matilhas) == 1)
            return $matilhas[0];
        elseif(count($matilhas) == 0)
            return null;

        die("MatilhaDAO.findById()" . 
            " - Erro: mais de uma matilha encontrada.");
    }

    public function mapMatilha($result){
        $matilhas = array();
        foreach ($result as $reg) {
            $matilha = new Matilha();
            $matilha->setIdMatilha($reg['id_matilha']);
            $matilha->setNomeMatilha($reg['nome_matilha']);
            $matilha->setIdChefe($reg['id_usuario_chefe']);
            $matilha->setIdPrimo($reg['id_usuario_primo']);
            $matilha->setIdAlcateia($reg['id_alcateia']);

            array_push($matilhas, $matilha);

        }
        return $matilhas;
    }
    
    public function mapFullMatilha($result){
        $matilhas = array();
        foreach ($result as $reg) {
            $matilha = new Matilha();
            $matilha->setIdMatilha($reg['0']);
            $matilha->setNomeMatilha($reg['nome_matilha']);

            $usuario = new Usuario();
            $usuario->setNome($reg['nome']);
            $matilha->setUsuarioChefe($usuario);

            $matilha->setIdChefe($reg['4']);
            $matilha->setIdPrimo($reg['2']);


            array_push($matilhas, $matilha);

        }
        return $matilhas;
    }
    public function insert(Matilha $matilha){
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_matilhas (nome_matilha, id_usuario_chefe)" .
               " VALUES (:nome, :id_chefe)" ;

        $stm = $conn->prepare($sql);
        $stm->bindValue(':nome', $matilha->getNomeMatilha());
        $stm->bindValue(':id_chefe', $matilha->getIdChefe());
        $stm->execute();
    }

    public function update(Matilha $matilha) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_matilhas SET nome_matilha = :nome, id_usuario_chefe = :id_chefe, id_usuario_primo = :id_primo" . 
               " WHERE id_matilha = :id";
           
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $matilha->getNomeMatilha());
        $stm->bindValue("id", $matilha->getIdMatilha());
        $stm->bindValue(':id_chefe', $matilha->getIdChefe());
        $stm->bindValue(':id_primo', $matilha->getIdPrimo());
        $stm->execute();
    }
    
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_matilhas WHERE id_matilha = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }
    public function changeChefe($id, $idUsuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_matilhas SET id_usuario_chefe = :idUsuario WHERE id_matilha = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->bindValue("idUsuario", $idUsuario);
        $stm->execute();
    }
}