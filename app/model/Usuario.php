<?php 
#Nome do arquivo: Usuario.php
#Objetivo: classe Model para Usuario

require_once(__DIR__ . "/enum/UsuarioPapel.php");

class Usuario implements JsonSerializable {

    private $id;
    private $endereco;
    private $contato;
    private $matilha;
    private $nome;
    private $senha;
    private $cpf;
    private $papeis;
    private $status;

    //Campos provisórios
    private $idEndereco;
    private $idContato;
    private $idMatilha;
    private $tarefaEnviada;


    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return
        [
            'idUsuario' => $this->id,
            'nome' => $this->nome,
            'papel' => $this->papeis,
            'status' => $this->status,
            'idMatilha' => $this->idMatilha,
            'matilha' => $this->matilha,
            'endereco' => $this->endereco,
            'contato' => $this->contato

        ];
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getContato()
    {
        return $this->contato;
    }

    public function setContato($contato)
    {
        $this->contato = $contato;

        return $this;
    }

    public function getMatilha()
    {
        return $this->matilha;
    }

    public function setMatilha($matilha)
    {
        $this->matilha = $matilha;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }
    
    /**
     * Get the value of papeis
     */ 
    public function getPapeis()
    {
        return $this->papeis;
    }

    /**
     * Set the value of papeis
     *
     * @return  self
     */ 
    public function setPapeis($papeis)
    {
        $this->papeis = $papeis;

        return $this;
    }
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getPapeisAsArray(){
        if($this->papeis)
            return explode(UsuarioPapel::$SEPARADOR, $this->papeis);
        
        return array();
    }

    public function setPapeisAsArray($array){
        if($array){
            $this->papeis = implode(UsuarioPapel::$SEPARADOR, $array);
        }
        else
            $this->papeis = NULL;
    }  
    public function getPapeisStr(){
        
            return str_replace(UsuarioPapel::$SEPARADOR,", ", $this->papeis);
    }

    /**
     * Get the value of idEndereco
     */ 
    public function getIdEndereco()
    {
        return $this->idEndereco;
    }

    /**
     * Set the value of idEndereco
     *
     * @return  self
     */ 
    public function setIdEndereco($idEndereco)
    {
        $this->idEndereco = $idEndereco;

        return $this;
    }

    /**
     * Get the value of idContato
     */ 
    public function getIdContato()
    {
        return $this->idContato;
    }

    /**
     * Set the value of idContato
     *
     * @return  self
     */ 
    public function setIdContato($idContato)
    {
        $this->idContato = $idContato;

        return $this;
    }

    /**
     * Get the value of idMatilha
     */ 
    public function getIdMatilha()
    {
        return $this->idMatilha;
    }

    /**
     * Set the value of idMatilha
     *
     * @return  self
     */ 
    public function setIdMatilha($idMatilha)
    {
        $this->idMatilha = $idMatilha;

        return $this;
    }

    /**
     * Get the value of tarefaEnviada
     */ 
    public function getTarefaEnviada()
    {
        return $this->tarefaEnviada;
    }

    /**
     * Set the value of tarefaEnviada
     *
     * @return  self
     */ 
    public function setTarefaEnviada($tarefaEnviada)
    {
        $this->tarefaEnviada = $tarefaEnviada;

        return $this;
    }
}