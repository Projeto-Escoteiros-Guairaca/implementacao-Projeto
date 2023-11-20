<?php
include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Endereco.php");

class EnderecoDAO{
    //Método para listar os endereços a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_enderecos e ORDER BY e.logradouro";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapEnderecos($result);
    }
    //Método para buscar um endereço por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM tb_enderecos e" .
               " WHERE e.id_endereco = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        $enderecos = $this->mapEnderecos($result);

        if(count($enderecos) == 1)
            return $enderecos[0];
        elseif(count($enderecos) == 0)
            return null;

        die("EnderecoDAO.findById()" . 
            " - Erro: mais de um endereco encontrado.");
    }

    private function mapEnderecos($result) {
        $enderecos = array();
        foreach ($result as $reg) {
            $endereco = new Endereco();
            $endereco->setIdEndereco($reg['id_endereco']);
            $endereco->setCep($reg['cep']);
            $endereco->setLogradouro($reg['logradouro']);
            $endereco->setNumeroEndereco($reg['numero_endereco']);
            $endereco->setBairro($reg['bairro']);
            $endereco->setCidade($reg['cidade']);
            $endereco->setPais($reg['pais']);
            array_push($enderecos, $endereco);
        }

        return $enderecos;
    }

    //Método para inserir um Endereço
    public function insert(Endereco $endereco) {
        $conn = Connection::getConn();
        $sql = "INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais)" .
               " VALUES (:cep, :logradouro, :numero_endereco, :bairro, :cidade, :pais)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("cep", $endereco->getcep());
        $stm->bindValue("logradouro", $endereco->getLogradouro());
        $stm->bindValue("numero_endereco", $endereco->getNumeroEndereco());
        $stm->bindValue("bairro", $endereco->getBairro());
        $stm->bindValue("cidade", $endereco->getCidade());
        $stm->bindValue("pais", $endereco->getPais());
        $stm->execute();

        $endereco->setIdEndereco($conn->lastInsertId());

    }
    //Método para atualizar um Endereço
    public function update(Endereco $endereco) {
        $conn = Connection::getConn();

        $sql = "UPDATE tb_enderecos SET cep = :cep, logradouro = :logradouro, numero_endereco = :numero_endereco," . 
               " bairro = :bairro, cidade = :cidade, pais = :pais" .   
               " WHERE id_endereco = :id_endereco";
        
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("cep", $endereco->getCep());
        $stm->bindValue("logradouro", $endereco->getLogradouro());
        $stm->bindValue("numero_endereco", $endereco->getNumeroEndereco());
        $stm->bindValue("bairro", $endereco->getBairro());
        $stm->bindValue("cidade", $endereco->getCidade());
        $stm->bindValue("pais", $endereco->getPais());
        $stm->bindValue("id_endereco", $endereco->getIdEndereco());
        $stm->execute();
        
    }
    //Método para excluir um Endereco pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM tb_enderecos WHERE id_endereco = :id_endereco";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_endereco", $id);
        $stm->execute();
    }
}