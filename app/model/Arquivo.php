<?php


class Arquivo {

    private $idArquivo;
    private $nomeArquivo;
    private $caminhoArquivo;
    private $texto;
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
     * Get the value of nomeArquivo
     */ 
    public function getNomeArquivo()
    {
        return $this->nomeArquivo;
    }

    /**
     * Set the value of nomeArquivo
     *
     * @return  self
     */ 
    public function setNomeArquivo($nomeArquivo)
    {
        $this->nomeArquivo = $nomeArquivo;

        return $this;
    }

    /**
     * Get the value of caminhoArquivo
     */ 
    public function getCaminhoArquivo()
    {
        return $this->caminhoArquivo;
    }

    /**
     * Set the value of caminhoArquivo
     *
     * @return  self
     */ 
    public function setCaminhoArquivo($caminhoArquivo)
    {
        $this->caminhoArquivo = $caminhoArquivo;

        return $this;
    }

    /**
     * Get the value of texto
     */ 
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set the value of texto
     *
     * @return  self
     */ 
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }
}