<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/FrequenciaDAO.php");
require_once(__DIR__ . "/../dao/EncontroDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

require_once(__DIR__ . "/../model/Frequencia.php");


class FrequenciaController extends Controller {

    private $frequenciaDao;
    private $usuarioDao;
    private $encontroDao;

    public function __construct() {
        
        if($_SESSION['callAccessToken'] == true) {
            $_SESSION['controller'] = "Frequencia";

            $this->loadController("Acesso");
            return;
        }
        $_SESSION['callAccessToken'] = true;
        $papelNecessario = array();
        $papelNecessario[0] = "ADMINISTRADOR";
        $accessVerified = $this->verifyAccess($papelNecessario);
        
        if(! $accessVerified) {
            return;
        }

        $this->frequenciaDao = new FrequenciaDAO();
        $this->usuarioDao = new UsuarioDAO();
        $this->encontroDao = new EncontroDAO();

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
        $this->loadView("pages/frequencia/listFrequencias.php", $dados,$msgErro, $msgSucesso, true);
    }
    
    public function listByUsuario(string $msgErro = "", string $msgSucesso = "") {
        
        $encontros = array();
        $frequenciasOfUsuarios = $this->frequenciaDao->listFrequenciasByIdUsuario($_GET['id']);
        $usuario = $this->usuarioDao->findById($_GET['id']);

        foreach($frequenciasOfUsuarios as $freq):
            $encontro = $this->encontroDao->getEncontroByFrequencia($freq->getId_encontro());
                if(! in_array($encontro, $encontros)) {
                array_push($encontros, $encontro);
            }
        endforeach;

        $dados["usuario"] = $usuario;
        $dados["lista"] = $frequenciasOfUsuarios;
        $dados["encontros"] = $encontros;
        $this->loadView("pages/frequencia/listFrequenciasByUsuario.php", $dados,$msgErro, $msgSucesso, true);

    }

    public function findUsuariosByIdAlcateia() {
        $id = 0;
        $id = $_GET['idAlcateia'];

        $usuarios = $this->usuarioDao->findUsuariosByIdAcateia($id);
        return $usuarios;
    }
    public function findUsuariosById(Array $frequencias){
        $usuarios = array();
        foreach($frequencias as $freq):
            $usuario = $this->usuarioDao->findUsuariosById($freq->getId_usuario());
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
        $frequencias = $this->encontroDao->findById($id);
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
