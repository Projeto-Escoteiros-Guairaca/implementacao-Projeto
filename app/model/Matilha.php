<?php

class Matilha implements JsonSerializable {

    private $id_matilha;
    private $nome;
    private $usuariochefe;
    private $usuarioPrimo;

    private $idChefe;
    private $idPrimo;
    
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return
        [
            'id_matilha' => $this->id_matilha,
            'nome' => $this->nome
        ];
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
     * Get the value of nome_matilha
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome_matilha
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    /**
     * Get the value of idChefe
     */ 
    public function getIdChefe()
    {
        return $this->idChefe;
    }

    /**
     * Set the value of idChefe
     *
     * @return  self
     */ 
    public function setIdChefe($idChefe)
    {
        $this->idChefe = $idChefe;

        return $this;
    }

    /**
     * Get the value of idPrimo
     */ 
    public function getIdPrimo()
    {
        return $this->idPrimo;
    }

    /**
     * Set the value of idPrimo
     *
     * @return  self
     */ 
    public function setIdPrimo($idPrimo)
    {
        $this->idPrimo = $idPrimo;

        return $this;
    }

    /**
     * Get the value of usuariochefe
     */ 
    public function getUsuarioChefe()
    {
        return $this->usuariochefe;
    }

    /**
     * Set the value of usuariochefe
     *
     * @return  self
     */ 
    public function setUsuarioChefe($usuariochefe)
    {
        $this->usuariochefe = $usuariochefe;

        return $this;
    }

    /**
     * Get the value of usuarioPrimo
     */ 
    public function getUsuarioPrimo()
    {
        return $this->usuarioPrimo;
    }

    /**
     * Set the value of usuarioPrimo
     *
     * @return  self
     */ 
    public function setUsuarioPrimo($usuarioPrimo)
    {
        $this->usuarioPrimo = $usuarioPrimo;

        return $this;
    }
}