<?php

class Alcateia implements JsonSerializable {

    private $id_alcateia;
    private $nome;

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return
        [
            'id_alcateia' => $this->id_alcateia,
            'nome' => $this->nome
        ];
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

    /**
     * Get the value of nome_alcateia
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome_alcateia
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

}