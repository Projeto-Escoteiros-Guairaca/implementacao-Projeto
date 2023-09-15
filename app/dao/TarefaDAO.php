<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Tarefa.php");
include_once(__DIR__ . "/../model/Atividade.php");

class TarefaDAO {

    public function list(){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_tarefas t ORDER BY t.id_tarefa";
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
            $tarefa->setNometarefa($reg['nome']);
            $tarefa->setDescricaoTarefa($reg['descricao']);
            $tarefa->setId_atividade($reg['id_atividade']);

            array_push($tarefas, $tarefa);

        }
        return $tarefas;
    }

    public function listByIdAtiv($id_atividade){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_tarefas t WHERE t.id_atividade = ?"; 
        $stm = $conn->prepare($sql);    
        $stm->execute([$id_atividade]);
        $result = $stm->fetchAll();

        return $this->mapTarefas($result);
    }

    public function insert(Tarefa $tarefa){
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_tarefas (id_atividade, nome, descricao)" .
                    " VALUES (:id_atividade, :nome, :descricao)";
        $stm = $conn->prepare($sql);

        $stm->bindValue("id_atividade", $tarefa->getAtividade()->getIdAtividade());
        $stm->bindValue("nome", $tarefa->getNomeTarefa());
        $stm->bindValue("descricao", $tarefa->getDescricaoTarefa());
        $stm->execute();

    }
    public function update($tarefa){

    }

    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_tarefas u" .
               " WHERE u.id_tarefa = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $atividades = $this->mapTarefas($result);

        if(count($atividades) == 1)
            return $atividades[0];
        elseif(count($atividades) == 0)
            return null;

        die("atividadeDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }

}