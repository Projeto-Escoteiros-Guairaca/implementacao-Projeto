<?php 
#Classe controller para a Sobre do sistema
require_once(__DIR__ . "/Controller.php");

class SobreController extends Controller {

    public function __construct() {
      
        $this->setActionDefault('sobre',true);
        $this->handleAction();
    }

    protected function sobre() {
        $this->loadView("pages/home/sobre.php", [], "", "", true);
    }
}


#Criar objeto da classe
$sobreCont = new SobreController();