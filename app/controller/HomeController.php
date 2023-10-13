<?php 
#Classe controller para a Home do sistema
require_once(__DIR__ . "/Controller.php");

class HomeController extends Controller {

    public function __construct() {
        $this->setActionDefault('home',true);
        $this->handleAction();
    }

    protected function home() {
        if(isset($_SESSION[SESSAO_USUARIO_ID])) {
            if(in_array("LOBINHO",$_SESSION[SESSAO_USUARIO_PAPEIS])) {
                if(! isset($_SESSION['usuarioLobinho'])) {
                    $_SESSION['usuarioLobinho'] = "initialLobinhoPage";
                    $this->loadController("Usuario", "?action=initialLobinhoPage");
                }
                else {    

                    $this->loadController("Usuario", "?action=initialLobinhoPage");
                }

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
