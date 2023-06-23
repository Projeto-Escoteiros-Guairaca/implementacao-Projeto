<?php
    
class Encontro{

    private $id_encontro;
    private $alcateia;
    private $data;
    private $descricao;

    //campos provisórios
    private $id_alcateia;

    


    /**
     * Get the value of id_encontro
     */ 
    public function getId_encontro()
    {
        return $this->id_encontro;
    }

    /**
     * Set the value of id_encontro
     *
     * @return  self
     */ 
    public function setId_encontro($id_encontro)
    {
        $this->id_encontro = $id_encontro;

        return $this;
    }

    /**
     * Get the value of alcateia
     */ 
    public function getAlcateia()
    {
        return $this->alcateia;
    }

    /**
     * Set the value of alcateia
     *
     * @return  self
     */ 
    public function setAlcateia($alcateia)
    {
        $this->alcateia = $alcateia;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    public function getDataFormated()
    {
        if($this->data)
            return date_format(date_create($this->data),"d/m/Y");
        
        return "";
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

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
     * Get the value of id_alcateia
     */ 
    public function getId_alcateia()
    {
        return $this->id_alcateia;
    }

    /**
     * Set the value of id_alcateia
     *
     * @return  self
     */ 
    public function setId_alcateia($id_alcateia)
    {
        $this->id_alcateia = $id_alcateia;

        return $this;
    }
}