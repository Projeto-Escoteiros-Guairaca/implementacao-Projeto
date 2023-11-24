<?php

class Alcateia implements JsonSerializable{

    private $idAlcateia;
    private $nomeAlcateia;

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {   
        return
        [
            'idAlcateia' => $this->idAlcateia,
            'nomeAlcateia' => $this->nomeAlcateia
        ];
    }

    /**
     * Get the value of idAlcateia
     */ 
    public function getIdAlcateia()
    {
        return $this->idAlcateia;
    }

    /**
     * Set the value of idAlcateia
     *
     * @return  self
     */ 
    public function setIdAlcateia($idAlcateia)
    {
        $this->idAlcateia = $idAlcateia;

        return $this;
    }

    /**
     * Get the value of nomeAlcateia
     */ 
    public function getNomeAlcateia()
    {
        return $this->nomeAlcateia;
    }

    /**
     * Set the value of nomeAlcateia
     *
     * @return  self
     */ 
    public function setNomeAlcateia($nomeAlcateia)
    {
        $this->nomeAlcateia = $nomeAlcateia;

        return $this;
    }
}