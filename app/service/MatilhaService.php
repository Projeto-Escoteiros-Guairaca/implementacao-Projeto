<?php

require_once(__DIR__ . "/../model/Matilha.php");

class MatilhaService {
    
    public function validarDados(Matilha $matilha) {
        $erros = array();

        if(! $matilha->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");
        if(! $matilha->getIdChefe())
            array_push($erros, "O campo [Chefe] é obrigatório.");
            
        return $erros;
    }
    public function insert(Matilha $matilha){
        $matilhaDao = new MatilhaDAO();
        $matilhaDao->insert($matilha);
    }
    public function update(Matilha $matilha){
        $matilhaDao = new MatilhaDAO();
        $matilhaDao->update($matilha);
    }
}
