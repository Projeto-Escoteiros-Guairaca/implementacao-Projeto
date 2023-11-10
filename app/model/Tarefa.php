<?php

class Tarefa {
    private $idTarefa;
    private $atividade;
    private $nomeTarefa;
    private $descricaoTarefa;

    private $statusEntrega;
    private $dataEntrega;
    private $descricaoEntrega;
    private $Usuario;
    //campos provisórios

    private $id_atividade;
    private $idUsuario;


    /**
     * Get the value of idTarefa
     */ 
    public function getIdTarefa()
    {
        return $this->idTarefa;
    }

    /**
     * Set the value of idTarefa
     *
     * @return  self
     */ 
    public function setIdTarefa($idTarefa)
    {
        $this->idTarefa = $idTarefa;

        return $this;
    }

    /**
     * Get the value of atividade
     */ 
    public function getAtividade()
    {
        return $this->atividade;
    }

    /**
     * Set the value of atividade
     *
     * @return  self
     */ 
    public function setAtividade($atividade)
    {
        $this->atividade = $atividade;

        return $this;
    }

    /**
     * Get the value of nomeTarefa
     */ 
    public function getNomeTarefa()
    {
        return $this->nomeTarefa;
    }

    /**
     * Set the value of nomeTarefa
     *
     * @return  self
     */ 
    public function setNomeTarefa($nomeTarefa)
    {
        $this->nomeTarefa = $nomeTarefa;

        return $this;
    }

    /**
     * Get the value of descricaoTarefa
     */ 
    public function getDescricaoTarefa()
    {
        return $this->descricaoTarefa;
    }

    /**
     * Set the value of descricaoTarefa
     *
     * @return  self
     */ 
    public function setDescricaoTarefa($descricaoTarefa)
    {
        $this->descricaoTarefa = $descricaoTarefa;

        return $this;
    }

    /**
     * Get the value of id_atividade
     */ 
    public function getId_atividade()
    {
        return $this->id_atividade;
    }

    /**
     * Set the value of id_atividade
     *
     * @return  self
     */ 
    public function setId_atividade($id_atividade)
    {
        $this->id_atividade = $id_atividade;

        return $this;
    }

    /**
     * Get the value of dataEntrega
     */ 
    public function getDataEntrega()
    {
        return $this->dataEntrega;
    }

    /**
     * Set the value of dataEntrega
     *
     * @return  self
     */ 
    public function setDataEntrega($dataEntrega)
    {
        $this->dataEntrega = $dataEntrega;

        return $this;
    }

    /**
     * Get the value of descricaoEntrega
     */ 
    public function getDescricaoEntrega()
    {
        return $this->descricaoEntrega;
    }

    /**
     * Set the value of descricaoEntrega
     *
     * @return  self
     */ 
    public function setDescricaoEntrega($descricaoEntrega)
    {
        $this->descricaoEntrega = $descricaoEntrega;

        return $this;
    }

    /**
     * Get the value of Usuario
     */ 
    public function getUsuario()
    {
        return $this->Usuario;
    }

    /**
     * Set the value of Usuario
     *
     * @return  self
     */ 
    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getStatusEntregaPalavra()
    {
        $status = "";
        if($this->statusEntrega == 1)
            $status = "Pendente";
        else if($this->statusEntrega == 2)
            $status= "Entregado";

        return $status;
    }

    /**
     * Get the value of statusEntrega
     */ 
    public function getStatusEntrega()
    {
        return $this->statusEntrega;
    }

    /**
     * Set the value of statusEntrega
     *
     * @return  self
     */ 
    public function setStatusEntrega($statusEntrega)
    {
        $this->statusEntrega = $statusEntrega;

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
}