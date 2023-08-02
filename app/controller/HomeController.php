<?php 
#Classe controller para a Home do sistema
require_once(__DIR__ . "/Controller.php");

class HomeController extends Controller {

    public function __construct() {
        /*if(! $this->usuarioLogado())
            exit;*/
        $this->setActionDefault('home',true);
        $this->handleAction();
    }

    protected function home() {
        $this->loadView("pages/home/index.php", [], "", "", true);
    }
}


#Criar objeto da classe
$homeCont = new HomeController();
