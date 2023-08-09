<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/FrequenciaDAO.php");
require_once(__DIR__ . "/../model/Frequencia.php");



class FrequenciaController extends Controller {

    private $frequenciaDao;

    public function __construct() {

        $papelNecessario = array();
        $papelNecessario[0] = "ADMINISTRADOR";
        $accessVerified = $this->verifyAccess($papelNecessario);
        
        if(! $accessVerified) {
            return;
        }

        $this->frequenciaDao = new FrequenciaDAO();

        $this->setActionDefault("createFrequencias", false);    
        $this->handleAction();
    }

    public function createFrequencias() {
        $frequencias = array();
        $frequenciasTest = $this->findFrequenciasByIdEncontro();
        if($frequenciasTest) {
            $this->list();
        }
        else {
            $usuarios = $this->findUsuariosByIdAlcateia();
            $i = 0;
            foreach ($usuarios as $us) {
                $frequencia = new Frequencia();
                $frequencia->setUsuario($usuarios[$i]);
                $frequencia->setId_encontro($_GET['idEncontro']);
                array_push($frequencias, $frequencia);
                $i++;
            }
            $this->frequenciaDao->create($frequencias);
            $this->list();
        }
    }

    public function list(string $msgErro = "", string $msgSucesso = "") {
        $encontro = $this->findEncontroByIdEncontro();
        $frequencias = $this->findFrequenciasByIdEncontro();
        $usuarios = $this->findUsuariosById($frequencias);
        $i = 0;
        foreach ($usuarios as $us) {
            $frequencias[$i]->setUsuario($us);
            $i++;
        }
        $dados["lista"] = $frequencias;
        $dados["encontro"] = $encontro;
        $this->loadView("pages/frequencia/listFrequencias.php", $dados,$msgErro, $msgSucesso, false);
    }

    public function findUsuariosByIdAlcateia() {
        $id = 0;
        $id = $_GET['idAlcateia'];

        $usuarios = $this->frequenciaDao->findUsuariosByIdAcateia($id);
        return $usuarios;
    }
    public function findUsuariosById(Array $frequencias){
        $usuarios = array();
        foreach($frequencias as $freq):
            $usuario = $this->frequenciaDao->findUsuariosById($freq->getId_usuario());
            array_push($usuarios, $usuario);
        endforeach;
        return $usuarios;
    }

    public function findFrequenciasByIdEncontro(){
        $id = 0;
        $id = $_GET['idEncontro'];
        $frequencias = $this->frequenciaDao->findFrequenciaByIdEncontro($id);
        return $frequencias;
    }

    public function findEncontroByIdEncontro(){
        $id = 0;
        $id = $_GET['idEncontro'];
        $frequencias = $this->frequenciaDao->findEncontroByIdEncontro($id);
        return $frequencias;
    }

    protected function updateToFalse(){
        $frequencia = $this->findFrequenciaById();
        if($frequencia){
            $this->frequenciaDao->updateToFalse($frequencia->getId_frequencia());
            $this->list("","Frequencia alterada com sucesso.");
        } else {
            $this->list("","Frequencia não encontrada.");
        }
    }
    protected function updateToTrue(){
        $frequencia = $this->findFrequenciaById();
        if($frequencia){
            $this->frequenciaDao->updateToTrue($frequencia->getId_frequencia());
            $this->list("","Frequencia alterada com sucesso.");
        } else {
            $this->list("Frequencia não encontrada.");
        }
    }

    protected function findFrequenciaById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];
        $dados["id"] = $id;

        $frequencia = $this->frequenciaDao->findById($id);
        return $frequencia;
    }
}

$freqCont = new FrequenciaController();
