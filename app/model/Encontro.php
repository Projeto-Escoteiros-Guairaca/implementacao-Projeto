<?php
    
class Encontro{

    private $id_encontro;
    private $matilha;
    private $data;
    private $descricao;

    //campos provisórios
    private $id_matilha;
    private $matilhaNome;
    


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
     * Get the value of id_matilha
     */ 
    public function getId_matilha()
    {
        return $this->id_matilha;
    }

    /**
     * Set the value of id_matilha
     *
     * @return  self
     */ 
    public function setId_matilha($id_matilha)
    {
        $this->id_matilha = $id_matilha;

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