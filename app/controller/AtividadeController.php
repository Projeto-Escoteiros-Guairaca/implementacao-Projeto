<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/AtividadeDAO.php");
require_once(__DIR__ . "/../model/Atividade.php");


class AtividadeController extends Controller {
    
    function __construct() {
        $papelNecessario = array();
        $papelNecessario[0] = "ADMINISTRADOR";
        $accessVerified = $this->verifyAccess($papelNecessario);
        
        if(! $accessVerified) {
            return;
        }

        $this->setActionDefault("list", true);
        $this->handleAction();
    }
}

$ativCont = new AtividadeController();
