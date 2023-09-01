<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/AtividadeDAO.php");
require_once(__DIR__ . "/../model/Atividade.php");


class AtividadeController extends Controller {
    
    private AtividadeDAO $atividadeDao;

    function __construct() {
        $administradorChefeActions = ["list", "create", "edit", "delete"];
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
        
        $this->atividadeDao = new AtividadeDAO();

        $this->setActionDefault("list", true);
        $this->handleAction();
    }

    public function list(string $msgErro = "", string $msgSucesso = ""){
        $atividades = $this->atividadeDao->list();
    
        $dados["lista"] = $atividades;
        $this->loadView("pages/atividade/listAllAtividades.php", $dados, $msgErro, $msgSucesso, true);
    }
    
    public function create(){
        $dados["id_atividade"] = 0;
        $this->loadView("pages/alcateia/formAtividade.php", $dados,"","", true);
    }
}

$ativCont = new AtividadeController();
