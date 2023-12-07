<?php 
#Classe controller para a Home do sistema
require_once(__DIR__ . "/Controller.php");

class HomeController extends Controller {

    public function __construct() {
        $_GET['action'] = 'home';
        // if($_SESSION['callAccessToken'] == true) {
        //     $_SESSION['controller'] = "Home";

        //     $this->loadController("Acesso");
        //     return;
        // }
        // if($_GET['action'] != "create" && $_GET['action'] != "save" && $_GET['action'] != "edit") {
        //     $_SESSION['callAccessToken'] = true;
        // }
    
        $this->setActionDefault('home',true);
        $this->handleAction();
    }

    //* abre a página home se for administrador; se não, envia ao home indicado.
    protected function home() {
        if(isset($_SESSION[SESSAO_USUARIO_ID])) {
            if(in_array("LOBINHO", $_SESSION[SESSAO_USUARIO_PAPEIS])) {
                $this->homeLobinho();
            }
            else if(in_array("CHEFE", $_SESSION[SESSAO_USUARIO_PAPEIS])) {
                $this->homeChefe();
            }
            else {
                $this->loadView("pages/home/initialPage.php", [], "", "", true);
            }
            return;
        }
        $this->loadView("pages/home/index.php", [], "", "", true);
    }
    protected function homeLobinho() {
        if(! isset($_SESSION['usuarioLobinho'])) {
            $_SESSION['usuarioLobinho'] = "initialLobinhoPage";
            $this->loadController("Acesso", "?controller=Usuario&action=initialLobinhoPage");
        }
        else {    
            $this->loadController("Acesso", "?controller=Usuario&action=initialLobinhoPage");
        }
    }

    protected function homeChefe() {
        if(! isset($_SESSION['usuarioChefe'])) {
            $_SESSION['usuarioChefe'] = "initialChefePage";
            $this->loadController("Acesso", "?controller=Usuario&action=initialChefePage");
        }
        else {    
            $this->loadController("Acesso", "?controller=Usuario&action=initialChefePage");
        }
    }
}


#Criar objeto da classe
$homeCont = new HomeController();
