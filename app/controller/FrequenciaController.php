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

    //* o Construct te envia ao AcessoController se não houver nenhuma excepção. 
    public function __construct() {
        if(isset($_GET['action'])) {
            if(isset($_GET['isForm'])) {
                $_SESSION['callAccessToken'] = false;
            }
        }

        if(isset($_SESSION['callAccessToken'])) {
            if($_SESSION['callAccessToken'] == true) {
                $_SESSION['controller'] = "Frequencia";
    
                $this->loadController("Acesso");
                return;
            }
            $_SESSION['callAccessToken'] = true;
        }
        else {
            $this->loadController('Login', '?action=login');
            die;
        }

        $this->frequenciaDao = new FrequenciaDAO();
        $this->usuarioDao = new UsuarioDAO();
        $this->encontroDao = new EncontroDAO();

        $this->setActionDefault("createFrequencias", false);    
        $this->handleAction();
    }

    //* veriica se existem as frequencias, se não, as cria e envia à listagem
    public function createFrequencias() {
        $frequencias = array();
        $frequenciasTest = $this->findFrequenciasByIdEncontro();
        if($frequenciasTest) {
            $this->listFrequencias();
        }
        else {
            $usuarios = $this->findUsuariosByIdMatilha();
            $i = 0;
            foreach ($usuarios as $us) {
                $frequencia = new Frequencia();
                $frequencia->setUsuario($usuarios[$i]);
                $frequencia->setIdEncontro($_GET['idEncontro']);
                array_push($frequencias, $frequencia);
                $i++;
            }
            $this->frequenciaDao->create($frequencias);
            $this->listFrequencias();
        }
    }

    //* lista as frequencias
    public function listFrequencias(string $msgErro = "", string $msgSucesso = "") {
        
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
            $encontro = $this->encontroDao->getEncontroByFrequencia($freq->getIdEncontro());
                if(! in_array($encontro, $encontros)) {
                array_push($encontros, $encontro);
            }
        endforeach;

        $dados["usuario"] = $usuario;
        $dados["lista"] = $frequenciasOfUsuarios;
        $dados["encontros"] = $encontros;
        $this->loadView("pages/frequencia/listFrequenciasByUsuario.php", $dados,$msgErro, $msgSucesso, true);

    }

    //* encontra os dados especificos pela informação especificada
    public function findUsuariosByIdMatilha() {
        $id = 0;
        $id = $_GET['idMatilha'];

        $usuarios = $this->usuarioDao->findUsuariosByIdMatilha($id);
        return $usuarios;
    }
    public function findUsuariosById(Array $frequencias){
        $usuarios = array();
        foreach($frequencias as $freq):
            $usuario = $this->usuarioDao->findUsuariosById($freq->getIdUsuario());
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
    protected function findFrequenciaById(){
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];
        $dados["id"] = $id;

        $frequencia = $this->frequenciaDao->findById($id);
        return $frequencia;
    }

    //* mudar caracteristicas da frequencia
    public function updateFrequencia() {
    
        $status = $_GET['status'];
        if($status == 1) {
            $this->frequenciaDao->updateFrequencia($status, $_GET['idFrequencia']);
            echo $status;
            return;
        } 
        else { 
            $this->frequenciaDao->updateFrequencia($status, $_GET['idFrequencia']);
            echo $status;
            return;
        }
        
    }
    
}

$freqCont = new FrequenciaController();
