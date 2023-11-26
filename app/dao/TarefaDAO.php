<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Tarefa.php");
include_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Arquivo.php");
require_once(__DIR__ . "/../model/EntregaTarefaUsuario.php");
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
            $tarefa->setNometarefa($reg['nome_tarefa']);
            $tarefa->setIdAtividade($reg['id_atividade']);
            $tarefa->setDescricaoTarefa($reg['descricao_tarefa']);
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

        $sql = "INSERT INTO tb_tarefas (id_atividade, nome_tarefa, descricao_tarefa)" .
                    " VALUES (:id_atividade, :nome, :descricao)";
        $stm = $conn->prepare($sql);

        $stm->bindValue("id_atividade", $tarefa->getAtividade()->getIdAtividade());
        $stm->bindValue("nome", $tarefa->getNomeTarefa());
        $stm->bindValue("descricao", $tarefa->getDescricaoTarefa());
        $stm->execute();

    }
    public function update($tarefa){

    }

    public function getTarefaSendByUsuario($idUsuario, $idTarefa) {
        $conn = Connection::getConn();

        $sql = " SELECT * FROM tb_usuarios u INNER JOIN tb_tarefas_usuarios tu ON tu.id_tarefa = u.id_usuario ".
        "INNER JOIN tb_tarefas t ON t.id_tarefa = tu.id_tarefa ".
        "INNER JOIN tb_arquivos a ON a.id_arquivo = tu.id_arquivo"
         ." WHERE tu.id_usuario = :idUsuario AND tu.id_tarefa = :idTarefa";
        $stm = $conn->prepare($sql);
        $stm->bindValue("idUsuario", $idUsuario);
        $stm->bindValue("idTarefa", $idTarefa);
        $stm->execute();
        $result = $stm->fetchAll();
        $tarefa_usuario = $this->mapTarefaUsuario($result);

        if(count($tarefa_usuario) == 1)
            return $tarefa_usuario[0];
        elseif(count($tarefa_usuario) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");

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

    public function validateTarefa($avaliacao = 0, $idEntrega) {
        $conn = Connection::getConn();
        $sql = "UPDATE tb_tarefas_usuarios SET status_tarefa_usuario = :avaliacao WHERE id_tarefa_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idEntrega);
        $stm->bindValue("avaliacao", $avaliacao);

        $stm->execute();
    }
    public function changeDataEntrega($data, $idEntrega) {
        $conn = Connection::getConn();
        $sql = "UPDATE tb_tarefas_usuarios SET data_tarefa_usuario = :data WHERE id_tarefa_usuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idEntrega);
        $stm->bindValue("data", $data);

        $stm->execute();
    }

    public function updateEntrega(Arquivo $arquivo) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_arquivos a SET a.nome_arquivo = :nome, a.caminho = :caminho, a.texto = :texto" . 
               " WHERE id_arquivo = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $arquivo->getNomeArquivo());
        $stm->bindValue("caminho", $arquivo->getCaminhoArquivo());
        $stm->bindValue("id", $arquivo->getIdArquivo());
        $stm->bindValue("texto", $arquivo->getTexto());
        $stm->execute();
    }
    public function findArquivoById($idArquivo) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_arquivos u" .
               " WHERE u.id_arquivo = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idArquivo]);
        $result = $stm->fetchAll();

        $arquivos = $this->mapArquivos($result);

        if(count($arquivos) == 1)
            return $arquivos[0];
        elseif(count($arquivos) == 0)
            return null;

        die("atividadeDAO.findById()" . 
            " - Erro: mais de um arquivo encontrado.");
    }

    public function mapArquivos($result) {
        $arquivos = array();
        foreach ($result as $reg) {
            $arquivo = new Arquivo();

            $arquivo->setNomeArquivo($reg['nome_arquivo']);
            $arquivo->setIdArquivo($reg['id_arquivo']);
            $arquivo->setCaminhoArquivo($reg['caminho']);
            $arquivo->setTexto($reg['texto']);


            array_push($arquivos, $arquivo);
        }
        return $arquivos;
    }
    public function deleteImage($id = 0, Arquivo $arquivo = null) {
        if($arquivo != null) {
            $img_del = $arquivo->getCaminhoArquivo();
            if (file_exists($img_del)) {
                unlink($img_del);
            }
        }
        else {
        $arquivo = $this->findArquivoById($id);
        $img_del = $arquivo->getCaminhoArquivo();
        if (file_exists($img_del)) {
            unlink($img_del);
        }
        }
    }

    public function mapTarefaUsuario($result){
        $entregas = array();
        foreach ($result as $reg) {
            $entrega = new EntregaTarefaUsuario();
            $usuario = new Usuario();
            $tarefa = new Tarefa();
            $arquivo = new Arquivo();

            $entrega->setIdEntrega($reg['id_tarefa_usuario']);
            $entrega->setDataEntrega($reg['data_tarefa_usuario']);
            $entrega->setStatusEntrega($reg['status_tarefa_usuario']);

            $tarefa->setIdtarefa($reg['id_tarefa']);
            $tarefa->setNometarefa($reg['nome_tarefa']);
            $tarefa->setDescricaoTarefa($reg['3']);
            $tarefa->setIdAtividade($reg['id_atividade']);

            $usuario->setNome($reg['nome']);
            $usuario->setId($reg['id_usuario']);
            
            $arquivo->setNomeArquivo($reg['21']);
            $arquivo->setIdArquivo($reg['id_arquivo']);
            $arquivo->setCaminhoArquivo($reg['caminho']);
            $arquivo->setTexto($reg['texto']);

            $entrega->setUsuario($usuario);
            $entrega->setArquivo($arquivo);
            $entrega->setTarefa($tarefa);

            array_push($entregas, $entrega);

        }
        return $entregas;
    }

    public function addArquivo(Arquivo $arquivo) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_arquivos (texto, caminho, nome_arquivo)" .
                    " VALUES (:texto, :caminho, :nome)";
        $stm = $conn->prepare($sql);

        $stm->bindValue("texto", $arquivo->getTexto());
        $stm->bindValue("caminho", $arquivo->getCaminhoArquivo());
        $stm->bindValue("nome", $arquivo->getNomeArquivo());
        $stm->execute();
        $arquivo->setIdArquivo($conn->lastInsertId());

    }
    public function addTarefaUsuario(EntregaTarefaUsuario $tarefaUsuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO tb_tarefas_usuarios (id_usuario, id_tarefa, id_arquivo, data_tarefa_usuario)" .
                    " VALUES (:id_usuario, :id_tarefa, :id_arquivo, :data)";
        $stm = $conn->prepare($sql);

        $stm->bindValue("id_usuario", $tarefaUsuario->getIdUsuario());
        $stm->bindValue("data", $tarefaUsuario->getDataEntrega());
        $stm->bindValue("id_tarefa", $tarefaUsuario->getIdTarefa());
        $stm->bindValue("id_arquivo", $tarefaUsuario->getIdArquivo());

        $stm->execute();
    }
}