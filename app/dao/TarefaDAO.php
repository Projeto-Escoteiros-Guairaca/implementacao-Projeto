<?php

class TarefaDAO {

    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_tarefas a ORDER BY a.id_tarefa";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapTarefas($result);
    }

    public function mapTarefas($result){
        $tarefas = array();
        foreach ($result as $reg) {
            $tarefa = new Tarefa();
            $tarefa->setIdtarefa($reg['id_tarefa']);
            $tarefa->setNometarefa($reg['nome_tarefa']);
            $tarefa->setDescricaoTarefa($reg['descricao']);

            array_push($tarefas, $tarefa);

        }
        return $tarefas;
    }

}