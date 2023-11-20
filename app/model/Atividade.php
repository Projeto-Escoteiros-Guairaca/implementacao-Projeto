<?php

class Atividade {

    private $idAtividade;
    private $nomeAtividade;
    private $descricaoAtividade;
    private $imagem;
    private $statusAtividade;

    
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
     * Get the value of nomeAtividade
     */ 
    public function getNomeAtividade()
    {
        return $this->nomeAtividade;
    }

    /**
     * Set the value of nomeAtividade
     *
     * @return  self
     */ 
    public function setNomeAtividade($nomeAtividade)
    {
        $this->nomeAtividade = $nomeAtividade;

        return $this;
    }

    /**
     * Get the value of descricaoAtividade
     */ 
    public function getDescricaoAtividade()
    {
        return $this->descricaoAtividade;
    }

    /**
     * Set the value of descricaoAtividade
     *
     * @return  self
     */ 
    public function setDescricaoAtividade($descricaoAtividade)
    {
        $this->descricaoAtividade = $descricaoAtividade;

        return $this;
    }

    /**
     * Get the value of imagem
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of statusAtividade
     */ 
    public function getStatusAtividade()
    {
        return $this->statusAtividade;
    }

    /**
     * Set the value of statusAtividade
     *
     * @return  self
     */ 
    public function setStatusAtividade($statusAtividade)
    {
        $this->statusAtividade = $statusAtividade;

        return $this;
    }
}