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
}