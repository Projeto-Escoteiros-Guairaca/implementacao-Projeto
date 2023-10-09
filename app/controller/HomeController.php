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
        if(isset($_SESSION[SESSAO_USUARIO_ID])) {
            if(in_array("LOBINHO",$_SESSION[SESSAO_USUARIO_PAPEIS])) {
                $this->loadView("pages/home/initialLobinhoPage.php", [], "", "", true);
            }
            else {
                $this->loadView("pages/home/initialPage.php", [], "", "", true);
            }
            
            return;
        }
        $this->loadView("pages/home/index.php", [], "", "", true);
    }
}


#Criar objeto da classe
$homeCont = new HomeController();
