<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Alcateia.php");
require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../model/Matilha.php");
require_once(__DIR__ . "/../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../service/AlcateiaService.php");

    
class AlcateiaController extends Controller{

    private AlcateiaDAO $alcateiaDao;
    private MatilhaDAO $matilhaDao;

    public function __construct(){

        if(isset($_GET['isForm'])) {
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
        $this->matilhaDao = new MatilhaDao();
        $this->setActionDefault("listAlcateias", true);
        $this->handleAction();
    }

    public function listAlcateias(string $msgErro = "", string $msgSucesso = ""){
        $alcateias = $this->alcateiaDao->list();
       
        $dados["alcateias"] = $alcateias;
        $this->loadView("pages/alcateia/listAlcateia.php", $dados, $msgErro, $msgSucesso, true);    
    }

    public function getAlcateiasAndMatilhas(){
        try {
            $alcateiasAndMatilhas = array();
            $dataTotal = array();
            $alcateias = $this->alcateiaDao->list();
            
            foreach($alcateias as $alca):
                $matilhas = $this->matilhaDao->listByIdAlcateia($alca->getIdAlcateia());
                
                foreach($matilhas as $mat) {
                    $mat->setAlcateia($alca);
                    $alcateiasAndMatilhas[$alca->getIdAlcateia()][] = $mat;
                }
            endforeach;
    
            foreach ($alcateiasAndMatilhas as $matilhas) {
                $dataTotal = array_merge($dataTotal, $matilhas);
            }
    
             echo trim(json_encode($alcateiasAndMatilhas));
             return;
            } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => $e->getMessage()));
        }

        header('Content-Type: application/json');
        
    }

} 

$alcCont = new AlcateiaController();