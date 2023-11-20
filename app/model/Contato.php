<?php

class Contato implements JsonSerializable {

    private $idContato;
    private $telefone;
    private $celular;
    private $email;

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return
        [
            'idContato' => $this->idContato,
            'telefone' => $this->telefone,
            'celular' => $this->celular,
            'email' => $this->email
        ];
    }
    

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of celular
     */ 
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set the value of celular
     *
     * @return  self
     */ 
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

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
}