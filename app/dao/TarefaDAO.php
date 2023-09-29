<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Tarefa.php");
include_once(__DIR__ . "/../model/Usuario.php");

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

    public function getTarefaUsuario($id) {

        $conn = Connection::getConn();

        $sql = " SELECT * FROM  tb_tarefas t INNER JOIN tb_tarefas_usuarios tu ON tu.id_tarefa = t.id_tarefa ".
        "INNER JOIN tb_usuarios u ON u.id_usuario = tu.id_usuario WHERE t.id_tarefa = ?";

        $stm = $conn->prepare($sql);
        
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        $tarefa_usuario = $this->mapTarefaUsuario($result);

        if(count($tarefa_usuario) == 1)
            return $tarefa_usuario[0];
        elseif(count($tarefa_usuario) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
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

    public function mapTarefaUsuario($result){
        $tarefas = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $tarefa = new Tarefa();

            $tarefa->setIdtarefa($reg['id_tarefa']);
            $tarefa->setNometarefa($reg['2']);
            $tarefa->setDescricaoTarefa($reg['3']);
            $tarefa->setId_atividade($reg['id_atividade']);

            $tarefa->setStatusEntrega($reg['status']);
            $tarefa->setDescricaoEntrega($reg['descricao']);
            $tarefa->setDataEntrega($reg['data']);
            $usuario->setNome($reg['nome']);
            $usuario->setId($reg['id_usuario']);
            
            $tarefa->setUsuario($usuario);
            array_push($tarefas, $tarefa);

        }
        return $tarefas;
    }

}