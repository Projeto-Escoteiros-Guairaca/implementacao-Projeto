<?php

require_once(__DIR__ . "/../model/Alcateia.php");

class AlcateiaService {
    
    public function validarDados(Alcateia $alcateia) {
        $erros = array();

        if(! $alcateia->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");
            
        return $erros;
    }
    public function insert(Alcateia $alcateia){
        $alcateiaDao = new AlcateiaDAO();
        $alcateiaDao->insert($alcateia);
    }
    public function update(Alcateia $alcateia){
        $alcateiaDao = new AlcateiaDAO();
        $alcateiaDao->update($alcateia);
    }
}
