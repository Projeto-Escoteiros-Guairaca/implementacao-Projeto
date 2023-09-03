<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../service/TarefaService.php");
require_once(__DIR__ . "/../model/Tarefa.php");
require_once(__DIR__ . "/../service/TarefaDAO.php");


class TarefaController extends Controller {

    private $tarefaDao;
    private $tarefaService;
    
    function __construct(){
        $administradorChefeActions = ["list", "create", "edit", "delete", "save", "update"];
        $lobinhoActions = ["list"];
        $papelNecessario = array();

        if(isset($_GET['action'])) {
            if(in_array($_GET['action'], $administradorChefeActions)) {
                $papelNecessario[] = "ADMINISTRADOR";
            }
            if(in_array($_GET['action'], $lobinhoActions)) {
                $papelNecessario[] = "LOBINHO";
            }
        }
        else {
            $papelNecessario[] = "ADMINISTRADOR";
            $papelNecessario[] = "LOBINHO";
       }

        $accessVerified = $this->verifyAccess($papelNecessario);        
        if(! $accessVerified) {
            return;
        }
        
        $this->tarefaDao = new TarefaDAO();
        $this->tarefaService = new TarefaService();

        $this->setActionDefault("list", true);
        $this->handleAction();
    }

    public function list(string $msgErro = "", string $msgSucesso = ""){
        $tarefas = $this->tarefaDao->list();
        $dados["lista"] = $tarefas;
        $this->loadView("pages/tarefa/listTarefa.php", $dados, $msgErro, $msgSucesso, true);
    }

}

$TarefCont = new TarefaController();