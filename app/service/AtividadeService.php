<?php

require_once(__DIR__ . "/../model/Atividade.php");

class AtividadeService {
    
    public function validarDados(Atividade $atividade) {
        $erros = array();

        if(! $atividade->getNomeAtividade())
            array_push($erros, "O campo [Nome] é obrigatório.");
        if(! $atividade->getDescricao())
            array_push($erros, "O campo [Descrição] é obrigatório.");
        if(! $atividade->getImagem())
            array_push($erros, "Uma imagem é obrigatória.");
            
        return $erros;
    }
    public function insert(Atividade $atividade){
        $atividadeDao = new AtividadeDAO();
        $atividadeDao->insert($atividade);
    }
    public function update(Atividade $atividade){
        $atividadeDao = new AtividadeDAO();
        $atividadeDao->update($atividade);
    }
}
