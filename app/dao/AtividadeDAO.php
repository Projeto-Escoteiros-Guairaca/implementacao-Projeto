<?php
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Atividade.php");


class AtividadeDAO {

    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_atividades a ORDER BY a.id_atividade";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapAtividade($result);
    }
    
    public function mapAtividade($result){
        $Atividades = array();
        foreach ($result as $reg) {
            $atividade = new Atividade();
            $atividade->setIdAtividade($reg['id_atividade']);
            $atividade->setNomeAtividade($reg['nome_atividade']);
            $atividade->setDescricao($reg['descricao']);

            array_push($Atividades, $atividade);

        }
        return $Atividades;
    }
}