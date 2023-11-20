<?php
    
class Encontro{

    private $idEncontro;
    private $matilha;
    private $dataEncontro;
    private $descricaoEncontro;

    //campos provisórios
    private $idMatilha;
    private $matilhaNome;
    


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
     * Get the value of matilha
     */ 
    public function getMatilha()
    {
        return $this->matilha;
    }

    /**
     * Set the value of matilha
     *
     * @return  self
     */ 
    public function setMatilha($matilha)
    {
        $this->matilha = $matilha;

        return $this;
    }

    /**
     * Get the value of dataEncontro
     */ 
    public function getDataEncontro()
    {
        return $this->dataEncontro;
    }

    public function getDataEncontroFormated()
    {
        if($this->dataEncontro)
            return date_format(date_create($this->dataEncontro),"d/m/Y");
        
        return "";
    }

    /**
     * Set the value of dataEncontro
     *
     * @return  self
     */ 
    public function setDataEncontro($dataEncontro)
    {
        $this->dataEncontro = $dataEncontro;

        return $this;
    }

    /**
     * Get the value of descricaoEncontro
     */ 
    public function getDescricaoEncontro()
    {
        return $this->descricaoEncontro;
    }

    /**
     * Set the value of descricaoEncontro
     *
     * @return  self
     */ 
    public function setDescricaoEncontro($descricaoEncontro)
    {
        $this->descricaoEncontro = $descricaoEncontro;

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
     * Get the value of matilhaNome
     */ 
    public function getMatilhaNome()
    {
        return $this->matilhaNome;
    }

    /**
     * Set the value of matilhaNome
     *
     * @return  self
     */ 
    public function setMatilhaNome($matilhaNome)
    {
        $this->matilhaNome = $matilhaNome;

        return $this;
    }
}