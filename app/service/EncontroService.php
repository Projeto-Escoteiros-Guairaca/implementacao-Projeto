<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../model/Encontro.php");

class EncontroService {
   
    public function validarDados(Encontro $encontro) {
        $erros = array();
        if(!$encontro->getDescricaoEncontro())
            array_push($erros, "O campo [Descricao] é obrigatório.");
        if(! $encontro->getDataEncontro())
            array_push($erros, "O campo [Data] é obrigatório.");
        if(! $encontro->getMatilha())
            array_push($erros, "O campo [Matilha] é obrigatório.");

        return $erros;
    }
    public function insert(Encontro $encontro){
        $encontroDao = new EncontroDAO();
        $encontroDao->insert($encontro);
    }
    public function update(Encontro $encontro){
        $encontroDao = new EncontroDAO();
        $encontroDao->update($encontro);
    }
}