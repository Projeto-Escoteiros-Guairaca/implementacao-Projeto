<?php
#Nome do arquivo: LinkController.php
#Objetivo: classe controller para controlar acesso às 
        //funcionalidades de sistema de acordo com os papeis do usuário

require_once(__DIR__ . "/Controller.php");

class LinkController extends Controller {

    public function __construct() {
    }
}
$LinkCont = new LinkController();