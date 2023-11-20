<?php

class Tarefa {
    private $idTarefa;
    private $atividade;
    private $nomeTarefa;
    private $descricaoTarefa;

   
    //campos provisórios

    private $idArquivo;
    private $idAtividade;
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
     * Get the value of idAtividade
     */ 
    public function getIdAtividade()
    {
        return $this->idAtividade;
    }

    /**
     * Set the value of idAtividade
     *
     * @return  self
     */ 
    public function setIdAtividade($idAtividade)
    {
        $this->idAtividade = $idAtividade;

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
        if($this->statusEntrega == 0)
            $status = "Pendente para avaliação";
        else if($this->statusEntrega == 1)
            $status= "Precisa refazer";
        else
        $status = "Avaliado";
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

    /**
     * Get the value of Arquivo
     */ 
    public function getArquivo()
    {
        return $this->Arquivo;
    }

    /**
     * Set the value of Arquivo
     *
     * @return  self
     */ 
    public function setArquivo($Arquivo)
    {
        $this->Arquivo = $Arquivo;

        return $this;
    }

    /**
     * Get the value of idArquivo
     */ 
    public function getIdArquivo()
    {
        return $this->idArquivo;
    }

    /**
     * Set the value of idArquivo
     *
     * @return  self
     */ 
    public function setIdArquivo($idArquivo)
    {
        $this->idArquivo = $idArquivo;

        return $this;
    }

    /**
     * Get the value of idEntrega
     */ 
    public function getIdEntrega()
    {
        return $this->idEntrega;
    }

    /**
     * Set the value of idEntrega
     *
     * @return  self
     */ 
    public function setIdEntrega($idEntrega)
    {
        $this->idEntrega = $idEntrega;

        return $this;
    }
}