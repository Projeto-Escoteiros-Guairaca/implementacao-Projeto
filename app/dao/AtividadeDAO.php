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

    public function listUndoneOrDone($status){

        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_atividades a WHERE a.status = ? ORDER BY a.id_atividade";
        $stm = $conn->prepare($sql);    
        $stm->execute([$status]);
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
            $atividade->setImagem($reg['imagem_atividade']);

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

        $sql = "INSERT INTO tb_atividades (nome_atividade, descricao, imagem_atividade)" .
               " VALUES (:nome_atividade, :descricao, :imagem)";
        $stm = $conn->prepare($sql);
        
        $stm->bindValue("nome_atividade", $atividade->getNomeAtividade());
        $stm->bindValue("descricao", $atividade->getDescricao());
        $stm->bindValue("imagem", $atividade->getImagem());

        $stm->execute();

    }

    //Método para atualizar um atividade
    public function update(Atividade $atividade) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_atividades SET nome_atividade = :nome_atividade, descricao = :descricao, imagem_atividade = :imagem" .
               " WHERE id_atividade = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $atividade->getIdAtividade());
        $stm->bindValue("nome_atividade", $atividade->getNomeAtividade());
        $stm->bindValue("descricao", $atividade->getDescricao());
        $stm->bindValue("imagem", $atividade->getImagem());

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

    public function deleteImage($id = 0, Atividade $atividade = null) {
        if($atividade != null) {
            $img_del = $atividade->getImagem();
            if (file_exists($img_del)) {
                unlink($img_del);
            }
        }
        else {
        $atividade = $this->findById($id);
        $img_del = $atividade->getImagem();
        if (file_exists($img_del)) {
            unlink($img_del);
        }
    }
    }

}
