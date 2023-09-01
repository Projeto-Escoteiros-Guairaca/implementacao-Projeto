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
   
    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_atividades u" .
               " WHERE u.id_atividade = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $atividades = $this->mapAtividade($result);

        if(count($atividades) == 1)
            return $atividades[0];
        elseif(count($atividades) == 0)
            return null;

        die("atividadeDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }


    //Método para inserir um atividade
    public function insert(Atividade $atividade) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_atividades (nome_atividade, descricao)" .
               " VALUES (:nome_atividade, :descricao)";
        $stm = $conn->prepare($sql);
        
        $stm->bindValue("nome_atividade", $atividade->getNomeAtividade());
        $stm->bindValue("descricao", $atividade->getDescricao());
        $stm->execute();

    }

    //Método para atualizar um atividade
    public function update(Atividade $atividade) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_atividades SET nome = :nome, cpf = :cpf, login = :login," . 
               " senha = :senha, papeis = :papeis" .   
               " WHERE id_atividade = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $atividade->getNomeAtividade());
        $stm->bindValue("cpf", $atividade->getDescricao());
        $stm->execute();
    }

    //Método para excluir um atividade pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_atividades WHERE id_atividade = :id";
         
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

}
