<?php

class Matilha implements JsonSerializable {

    private $id_matilha;
    private $nome;
    private $usuarioChefe;
    private $usuarioPrimo;

    private $idChefe;
    private $idPrimo;
    
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {   
        return
        [
            'id_matilha' => $this->id_matilha,
            'nome' => $this->nome,
            'usuarioChefe' => $this->usuarioChefe,
            'usuarioPrimo' => $this->usuarioPrimo
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