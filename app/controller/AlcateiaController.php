<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Alcateia.php");
require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../service/AlcateiaService.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

    
class AlcateiaController extends Controller{

    private UsuarioDAO $usuarioDao;
    private AlcateiaDAO $alcateiaDao;
    private AlcateiaService $alcateiaService;


    public function __construct(){

        $papelNecessario = array();
        $papelNecessario[0] = "ADMINISTRADOR";
        $accessVerified = $this->verifyAccess($papelNecessario);
        
        if(! $accessVerified) {
            return;
        }
        $this->usuarioDao = new UsuarioDAO();
        $this->alcateiaDao = new AlcateiaDAO();
        $this->alcateiaService = new AlcateiaService();
        $this->setActionDefault("list", true);
        $this->handleAction();
    }

    public function findChefeAndPrimo() {
        $chefeAndPrimo = [];
        $alcateia = $this->alcateiaDao->findById($_GET['idAlcateia']);
        $chefe = $this->usuarioDao->findById($alcateia->getIdChefe());   
        array_push($chefeAndPrimo, $chefe);

        if($alcateia->getIdPrimo() > 0) {
            $primo = $this->usuarioDao->findById($alcateia->getIdPrimo());
            array_push($chefeAndPrimo, $primo);
        }
        echo json_encode($chefeAndPrimo);
        die;
    }
    
    
    public function list(string $msgErro = "", string $msgSucesso = ""){
        $alcateias = $this->alcateiaDao->list();
        $sendAlcateias = false;
     
        if(isset($_GET['sendAlcateias'])) {
            $sendAlcateias = $_GET['sendAlcateias'];
        } 
        if($sendAlcateias == 'true') {
            echo json_encode($alcateias);
            return;
        }

        $dados["lista"] = $alcateias;
        $this->loadView("pages/alcateia/listAlcateia.php", $dados, $msgErro, $msgSucesso, true);
    }

    public function create(){
        $dados["id_alcateia"] = 0;
        $this->loadView("pages/alcateia/formAlcateia.php", $dados,"","", true);
    }
    
    protected function edit() {
        $alcateia = $this->findAlcateiaById();

        if($alcateia){

            $dados["id_alcateia"] = $alcateia->getId_alcateia();
            $dados["alcateia"] = $alcateia;        
            $this->loadView("pages/alcateia/formAlcateia.php", $dados, "", "", true);
        } else {
            $this->list("Alcateia não encontrada.");
        }

    }

    protected function findAlcateiaById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $dados["id_alcateia"] = $id;

        $alcateia = $this->alcateiaDao->findById($id);
        return $alcateia;
    }

    public function save(){
        
        $dados["id_alcateia"] = isset($_POST['id_alcateia']) ? $_POST['id_alcateia'] : 0;
        $nomeAlcateia = isset($_POST['nomeAlcateia']) ? trim($_POST['nomeAlcateia']) : NULL;
        $chefeAlcateia = isset($_POST['chefeAlcateia']) ? trim($_POST['chefeAlcateia']) : NULL;
        $primoAlcateia = isset($_POST['primoAlcateia']) ? trim($_POST['primoAlcateia']) : NULL;

        $alcateia = new Alcateia();
        $alcateia->setNome($nomeAlcateia);
        $alcateia->setIdChefe($chefeAlcateia);
        $alcateia->setIdPrimo($primoAlcateia);

        $erros = $this->alcateiaService->validarDados($alcateia);

        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id_alcateia"] == 0){ //Inserindo
                    $this->alcateiaService->insert($alcateia);

                }
                else {//Alterando

                    $alcateia->setId_alcateia($dados["id_alcateia"]);
                    $this->alcateiaService->update($alcateia);
                }

                // - Enviar mensagem de sucesso
                $msg = "Alcateia salva com sucesso.";
                
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                $erros = ["[Erro ao salvar a alcateia na base de dados.]"];
            }
        }
       
        $dados["nomeAlcateia"] = $nomeAlcateia;
        $dados["primoAlcateia"] = $primoAlcateia;
        $dados["chefeAlcateia"] = $chefeAlcateia;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("pages/alcateia/formAlcateia.php", $dados, $msgsErro, "", true);
 
    }
    
    protected function delete(){
        $alcateia = $this->findAlcateiaById();
             if($alcateia){
            $this->alcateiaDao->deleteById($alcateia->getId_alcateia());
            
            $this->list("","Alcateia excluída com sucesso.");
        } else {
            $this->list("Alcateia não encontrada.");
        }
    }
} 

$alcCont = new AlcateiaController();