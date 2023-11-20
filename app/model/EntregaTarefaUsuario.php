<?php

class EntregaTarefaUsuario {

    private $idEntrega;
    private $statusEntrega;
    private $dataEntrega;

    private $usuario;
    private $idUsuario;

    private $arquivo;
    private $idArquivo;

    private $tarefa;
    private $idTarefa;
        
    
    public function getStatusEntregaPalavra() {
        $statusEntregaPalavra = "";
        if($this->statusEntrega == 0) {
           $statusEntregaPalavra = "Avaliação pendente.";
        }
        else if($this->statusEntrega == 1) {
           $statusEntregaPalavra = "É necessário refazer.";
        }
        else {
            $statusEntregaPalavra = "Tarefa completada.";
        }
        
        return $statusEntregaPalavra;
    }
    /**
     * Get the value of idEntrega
     */ 
    public function getIdEntrega()
    {
        return $this->idEntrega;
    }

    /**
     * Set the value of idEntrega
     *
     * @return  self
     */ 
    public function setIdEntrega($idEntrega)
    {
        $this->idEntrega = $idEntrega;

        return $this;
    }

    /**
     * Get the value of statusEntrega
     */ 
    public function getStatusEntrega()
    {
        return $this->statusEntrega;
    }

    /**
     * Set the value of statusEntrega
     *
     * @return  self
     */ 
    public function setStatusEntrega($statusEntrega)
    {
        $this->statusEntrega = $statusEntrega;

        return $this;
    }

    /**
     * Get the value of dataEntrega
     */ 
    public function getDataEntrega()
    {
        return $this->dataEntrega;
    }

    /**
     * Set the value of dataEntrega
     *
     * @return  self
     */ 
    public function setDataEntrega($dataEntrega)
    {
        $this->dataEntrega = $dataEntrega;

        return $this;
    }
    
    public function getDataEntregaFormated()
    {
        if($this->dataEntrega)
            return date_format(date_create($this->dataEntrega),"d/m/Y");
        
        return "";
    }
    /**
     * Get the value of arquivo
     */ 
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set the value of arquivo
     *
     * @return  self
     */ 
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of tarefa
     */ 
    public function getTarefa()
    {
        return $this->tarefa;
    }

    /**
     * Set the value of tarefa
     *
     * @return  self
     */ 
    public function setTarefa($tarefa)
    {
        $this->tarefa = $tarefa;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

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
     * Get the value of idTarefa
     */ 
    public function getIdTarefa()
    {
        return $this->idTarefa;
    }

    /**
     * Set the value of idTarefa
     *
     * @return  self
     */ 
    public function setIdTarefa($idTarefa)
    {
        $this->idTarefa = $idTarefa;

        return $this;
    }
}