<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Alcateia.php");
require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../service/AlcateiaService.php");

    
class AlcateiaController extends Controller{

    private AlcateiaDAO $alcateiaDao;
    private AlcateiaService $alcateiaService;

    public function __construct(){

        if($_GET['action'] == "save" or $_GET['action'] == "edit") {
            $_SESSION['callAccessToken'] = false;
        }
        if(! isset($_GET['isAjax'])) {
            if(isset($_SESSION['callAccessToken'])) {
                if($_SESSION['callAccessToken'] == true) {
                    $_SESSION['controller'] = "Alcateia";
        
                    $this->loadController("Acesso");
                    return;
                }
                $_SESSION['callAccessToken'] = true;
            }
            else {
                $this->loadController('Login', '?action=login');
                die;
            }
        }
        
        $this->alcateiaDao = new AlcateiaDAO();
        $this->alcateiaService = new AlcateiaService();
        $this->setActionDefault("listAlcateias", true);
        $this->handleAction();
    }

    public function listAlcateias(string $msgErro = "", string $msgSucesso = ""){
        $alcateias = $this->alcateiaDao->list();
       
        $dados["alcateias"] = $alcateias;
        $this->loadView("pages/alcateia/listAlcateia.php", $dados, $msgErro, $msgSucesso, true);    
    }

    public function getAlcateiasAndMatilhas(string $msgErro = "", string $msgSucesso = ""){
        $alcateias = $this->alcateiaDao->list();
       
        $dados["alcateias"] = $alcateias;
    }

} 

$alcCont = new AlcateiaController();