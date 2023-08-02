<?php
#Nome do arquivo: AcessoController.php
#Objetivo: classe controller para controlar acesso às 
        //funcionalidades de sistema de acordo com os papeis do usuário

require_once(__DIR__ . "/Controller.php");

class AcessoController extends Controller {

    public function __construct() {    
    }  

    public function VerifyAccess(Array $papelNecessario) {
        $dados = array();
        $hasAccess = $this->usuarioPossuiPapel($papelNecessario);

        if($hasAccess) {
            return true;
        }
        else {
            $this->loadView("pages/Errors/accessDenied.php", $dados, "", "", true);
        }
    }

    public function NoLogin() {
        $dados = array();
        $this->loadView("pages/Errors/noAccountFound.php", $dados, "", "", true);

    }
}

//$AcesCont = new AcessoController();