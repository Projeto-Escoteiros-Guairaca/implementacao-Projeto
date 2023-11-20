<?php 

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Encontro.php");


class EncontroDao {
     public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e ORDER BY e.data";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        $encontros = $this->mapEncontro($result);

        foreach($encontros as $enc):
            $matilha = new Matilha();
            $matilha = $this->listMatilhas($enc->getIdMatilha());
            $enc->setMatilha($matilha[0]);
        endforeach;
        
        return $encontros;
    }

    public function filterByMatilha(int $idMatilha) {
  $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e" . 
        " WHERE e.id_matilha = ? ORDER BY e.data";
        $stm = $conn->prepare($sql);    
        $stm->execute([$idMatilha]);
        $result = $stm->fetchAll();
        $encontros = $this->mapEncontro($result);

        foreach($encontros as $enc):
            $matilha = new Matilha();
            $matilha = $this->listMatilhas($enc->getId_matilha());
            $enc->setMatilha($matilha[0]);
        endforeach;
        
        return $encontros;
    }
    public function filterByData(string $desde, string $ate) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e" . 
        " WHERE e.data BETWEEN ? AND ? ORDER BY e.data";
        $stm = $conn->prepare($sql);
        $stm->execute([$desde, $ate]);
        $result = $stm->fetchAll();
        $encontros = $this->mapEncontro($result);

        foreach($encontros as $enc):
            $matilha = new Matilha();
            $matilha = $this->listMatilhas($enc->getId_matilha());
            $enc->setMatilha($matilha[0]);
        endforeach;
        
        return $encontros;
    }
    public function filterByBoth(string $desde, string $ate, int $idMatilha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e" . 
        " WHERE e.id_matilha = ? AND e.data BETWEEN ? AND ? ORDER BY e.data";
        $stm = $conn->prepare($sql);
        $stm->execute([$idMatilha, $desde, $ate]);
        $result = $stm->fetchAll();
        $encontros = $this->mapEncontro($result);

        foreach($encontros as $enc):
            $matilha = new Matilha();
            $matilha = $this->listMatilhas($enc->getId_matilha());
            $enc->setMatilha($matilha[0]);
        endforeach;
        
        return $encontros;
    }

    public function listMatilhas(int $id){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_matilhas a".
                " WHERE a.id_matilha = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        
        return $this->mapMatilha($result);
    }
    public function mapMatilha($result){
        $matilhas = array();
        foreach ($result as $reg) {
            $matilha = new Matilha();
            $matilha->setIdMatilha($reg['id_matilha']);
            $matilha->setNomeMatilha($reg['nome_matilha']);
            array_push($matilhas, $matilha);
        }

        return $matilhas;
    }

    public function getEncontroByFrequencia($id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e" .
               " WHERE e.id_encontro = ? ORDER BY e.id_encontro DESC ";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        
        $encontros = $this->mapEncontro($result);

        if(count($encontros) == 1)
            return $encontros[0];
        elseif(count($encontros) == 0)
            return null;

        die("encontroDAO.findById()" . 
            " - Erro: mais de uma encontro encontrado.");
    }

    public function findById(int $id){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_encontros e" .
               " WHERE e.id_encontro = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $encontros = $this->mapEncontro($result);

        if(count($encontros) == 1)
            return $encontros[0];
        elseif(count($encontros) == 0)
            return null;

        die("encontroDAO.findById()" . 
            " - Erro: mais de uma encontro encontrado.");
    }

    public function mapEncontro($result){
        $encontros = array();
        foreach ($result as $reg) {
            $encontro = new Encontro();
            $encontro->setIdEncontro($reg['id_encontro']);
            $encontro->setDataEncontro($reg['data']);
            $encontro->setDescricaoEncontro($reg['descricao_encontro']);
            $encontro->setIdMatilha($reg['id_matilha']);
            


            array_push($encontros, $encontro);
        }

        return $encontros;
    }

    
    public function insert(encontro $encontro){
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_encontros (id_matilha, data, descricao_encontro)" .
               " VALUES (:id_matilha, :data, :descricao)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_matilha', $encontro->getMatilha()->getIdMatilha());
        $stm->bindValue(':data', $encontro->getDataEncontro());
        $stm->bindValue(':descricao', $encontro->getDescricaoEncontro());
        $stm->execute();
    }

    public function update(encontro $encontro) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_encontros SET id_matilha = :id_matilha , data = :data , descricao_encontro = :descricao" . 
               " WHERE id_encontro = :id";
           
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_matilha", $encontro->getMatilha()->getId_matilha());
        $stm->bindValue("data", $encontro->getDataEncontro());
        $stm->bindValue("descricao", $encontro->getDescricaoEncontro());
        $stm->bindValue("id", $encontro->getIdEncontro());
        $stm->execute();
    }
    
}