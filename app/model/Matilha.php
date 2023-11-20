<?php

class Matilha implements JsonSerializable {

    private $idMatilha;
    private $nomeMatilha;
    private $usuarioChefe;
    private $usuarioPrimo;

    private $idChefe;
    private $idPrimo;
    
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {   
        return
        [
            'idMatilha' => $this->idMatilha,
            'nomeMatilha' => $this->nomeMatilha,
            'usuarioChefe' => $this->usuarioChefe,
            'usuarioPrimo' => $this->usuarioPrimo
        ];
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
     * Get the value of nomeMatilha_matilha
     */
    public function getNomeMatilha()
    {
        return $this->nomeMatilha;
    }

    /**
     * Set the value of nomeMatilha_matilha
     *
     * @return  self
     */
    public function setNomeMatilha($nomeMatilha)
    {
        $this->nomeMatilha = $nomeMatilha;

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
     * Get the value of usuarioChefe
     */ 
    public function getUsuarioChefe()
    {
        return $this->usuarioChefe;
    }

    /**
     * Set the value of usuarioChefe
     *
     * @return  self
     */ 
    public function setUsuarioChefe($usuarioChefe)
    {
        $this->usuarioChefe = $usuarioChefe;

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