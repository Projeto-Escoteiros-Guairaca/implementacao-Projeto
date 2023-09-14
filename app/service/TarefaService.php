<?php

class TarefaService {
    public function validarDados(Tarefa $tarefa) {
        if(! $tarefa->getNomeTarefa())
            array_push($erros, "O campo [Nome da Tarefa] é obrigatório.");
        $erros = array();
        if(!$tarefa->getDescricaoTarefa())
            array_push($erros, "O campo [Descricao] é obrigatório.");

        return $erros;
    }
    public function insert(Tarefa $tarefa){
        $tarefaDao = new TarefaDAO();
        $tarefaDao->insert($tarefa);
    }
    public function update(Tarefa $tarefa){
        $tarefaDao = new TarefaDAO();
        $tarefaDao->update($tarefa);
    }

}