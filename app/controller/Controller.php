<?php
#Classe controller padrão

require_once(__DIR__ . "/../util/config.php");

class Controller {

    //Atributo para armazenar a action default do controller
    private string $actionDefault = "";

    protected function handleAction() {
        //Captura a ação do parâmetro GET
        $action = NULL;
        if(isset($_GET['action']))
            $action = $_GET['action'];
        
        //Chama a ação
        $this->callAction($action);
    }

    protected function callAction($methodName) {
        $methodNoAction = "noAction";

        //Se o médoto extiver em branco, chama o $actionDefault (caso exista)
        if( ( (! $methodName) || empty(trim($methodName)) ) && 
                method_exists($this, $this->actionDefault) ) {
            $method = $this->actionDefault;
            $this->$method();

        //Verifica se o método existe na classe
        } elseif($methodName && method_exists($this, $methodName))
            $this->$methodName();
        
        elseif(method_exists($this, $methodNoAction))
            $this->$methodNoAction();

        else {
            throw new BadFunctionCallException("Ação não implementada");
        }

    }

    protected function loadView(string $path, array $dados, string $msgErro = "", string $msgSucesso = "", bool $fazer) {
        
        //Verificar os dados que estão sendo recebidos na função
        //print_r($dados);
        //exit;

        $caminho = __DIR__ . "/../view/" . $path;
        //echo $caminho;
        if(file_exists($caminho)) {
            require $caminho;

            if($fazer == true) { 
                 $url_parts = parse_url($_SERVER['REQUEST_URI']); //Divide a URL em 'path' e 'query'
                echo "<script>window.history.replaceState({}, '', '{$url_parts['path']}');</script>"; 
            }//Código para esconder os parâmetros da URL, inclusive o action
          
        } else {
            echo "Erro ao carrega a view solicitada<br>";
            echo "Caminho: " . $caminho;
        }
    }

    //Método executado para ação inexistente
    private function noAction() {
        echo "Ação não encontrada no controller.<br>";
        echo "Verifique com o administrador do sistema.";
    }

    //Método que verifica se o usuário está logado
    protected function usuarioLogado() {
       if(! isset($_SESSION[SESSAO_USUARIO_ID])) {
            header("location: " . LOGIN_PAGE);
            return false;
        }

        return true;
    }

    //Método que verifica se o usuário possui um papel necessário
    public function usuarioPossuiPapel(array $papeisNecessarios) {

        //* 0 no account, 1 é papel certo, 2 é papel errado.
        if(isset($_SESSION[SESSAO_USUARIO_ID])) {
            $papeisUsuario = $_SESSION[SESSAO_USUARIO_PAPEIS];
            //Percorre os papeis necessários e verifica se existem nos papéis do usuário
            foreach($papeisNecessarios as $papel) {

                if(in_array($papel, $papeisUsuario)) {
                    return 1;
                }
            }
        }
        elseif(! isset($_SESSION[SESSAO_USUARIO_ID])) {
            return 0;
        }
        return 2;
        
    }

    public function verifyAccess(Array $papelNecessario) {
        $dados = array();
        $hasAccess = $this->usuarioPossuiPapel($papelNecessario);
        if($hasAccess == 1) {
            return true;
        }
        elseif($hasAccess == 2){
            $this->loadView("pages/Errors/accessDenied.php", $dados, "", "", true);
            return false;
        }
        else {
            $this->loadView("pages/Errors/noAccountFound.php", $dados, "", "", true);
            return false;            
        }
     
    }

    /**
     * Set the value of actionDefault
     *
     * @return  self
     */ 
    public function setActionDefault($actionDefault, $fazer) {
        if($fazer == true)    
        {  
            $this->actionDefault = $actionDefault; 
        }

        return $this;
    }

}