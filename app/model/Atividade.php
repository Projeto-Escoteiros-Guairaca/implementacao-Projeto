<?php

class Atividade {

    private $idAtividade;
    private $nomeAtividade;
    private $descricao;
    private $imagem;
    
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
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

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
}