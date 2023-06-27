<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Alcateia.php");
require_once(__DIR__ . "/../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../service/AlcateiaService.php");
    
class AlcateiaController extends Controller{

    private AlcateiaDAO $alcateiaDao;
    private AlcateiaService $alcateiaService;

    public function __construct(){

        $this->alcateiaDao = new AlcateiaDAO();
        $this->alcateiaService = new AlcateiaService();
        $this->setActionDefault("list", true);
        $this->handleAction();
    }

    public function listUsuarios() {
        $usuarios = $this->findUsuarioByIdAlcateia(); 
        echo json_encode($usuarios); 
        return;
    }
    protected function findUsuarioByIdAlcateia(){
        $id = 0;
        if(isset($_GET['idAlcateia']))
            $id = $_GET['idAlcateia'];

        $dados["id_alcateia"] = $id;

        $usuario = $this->alcateiaDao->findUsuariosByIdAlcateia($id);
        return $usuario;
    }

    
    public function list(string $msgErro = "", string $msgSucesso = ""){
        $alcateias = $this->alcateiaDao->list();
        $dados["lista"] = $alcateias;
        $this->loadView("alcateia/listAlcateia.php", $dados, $msgErro, $msgSucesso, true);
    }

    public function create(){
        $dados["id_alcateia"] = 0;
        $this->loadView("alcateia/formAlcateia.php", $dados,"","", true);
    }
    
    protected function edit() {
        $alcateia = $this->findAlcateiaById();

        if($alcateia){

            $dados["id_alcateia"] = $alcateia->getId_alcateia();
            $dados["alcateia"] = $alcateia;        
            $this->loadView("alcateia/formAlcateia.php", $dados, "", "", true);
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
        $alcateia = new Alcateia();
        $alcateia->setNome($nomeAlcateia);

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

        $msgsErro = implode("<br>", $erros);
        $this->loadView("alcateia/formAlcateia.php", $dados, $msgsErro, "", true);
 
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