<?php

class Alcateia {

    private $idAlcateia;
    private $nome;


    /**
     * Get the value of idAlcateia
     */ 
    public function getIdAlcateia()
    {
        return $this->idAlcateia;
    }

    /**
     * Set the value of idAlcateia
     *
     * @return  self
     */ 
    public function setIdAlcateia($idAlcateia)
    {
        $this->idAlcateia = $idAlcateia;

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
}