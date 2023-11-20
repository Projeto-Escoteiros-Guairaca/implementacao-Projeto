<?php

class Frequencia {
    
    private $idFrequencia; 
    private $frequencia;
    
    private $usuario; 
    private $idUsuario;

    private $encontro;
    private $idEncontro;


    /**
     * Get the value of idFrequencia
     */ 
    public function getIdFrequencia()
    {
        return $this->idFrequencia;
    }

    /**
     * Set the value of idFrequencia
     *
     * @return  self
     */ 
    public function setIdFrequencia($idFrequencia)
    {
        $this->idFrequencia = $idFrequencia;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of encontro
     */ 
    public function getEncontro()
    {
        return $this->encontro;
    }

    /**
     * Set the value of encontro
     *
     * @return  self
     */ 
    public function setEncontro($encontro)
    {
        $this->encontro = $encontro;

        return $this;
    }

    /**
     * Get the value of idEncontro
     */ 
    public function getIdEncontro()
    {
        return $this->idEncontro;
    }

    /**
     * Set the value of idEncontro
     *
     * @return  self
     */ 
    public function setIdEncontro($idEncontro)
    {
        $this->idEncontro = $idEncontro;

        return $this;
    }

    /**
     * Get the value of frequencia
     */ 
    public function getFrequencia()
    {
        return $this->frequencia;
    }

    /**
     * Set the value of frequencia
     *
     * @return  self
     */ 
    public function setFrequencia($frequencia)
    {
        $this->frequencia = $frequencia;

        return $this;
    }
}