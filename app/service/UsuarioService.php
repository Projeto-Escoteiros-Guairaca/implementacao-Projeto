<?php
    
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Endereco.php");
require_once(__DIR__ . "/../model/Contato.php");

class UsuarioService {

    public function validarEndereco(Endereco $endereco) {
        $ErrorEndereco = array();
        if(! $endereco->getCep())
            array_push($ErrorEndereco, "O campo [CEP] é obrigatório.");

        if(! $endereco->getLogradouro())
            array_push($ErrorEndereco, "O campo [Logradouro] é obrigatório.");

        if(! $endereco->getNumeroEndereco())
            array_push($ErrorEndereco, "O campo [Número] é obrigatório.");
    
        if(! $endereco->getBairro())
            array_push($ErrorEndereco, "O campo [Bairro] é obrigatório.");

        if(! $endereco->getCidade())
            array_push($ErrorEndereco, "O campo [Cidade] é obrigatório.");

        if(! $endereco->getPais())
            array_push($ErrorEndereco, "O campo [País] é obrigatório.");
    return $ErrorEndereco;
    }
    public function validarContato( Contato $contato) {
        $errorContato = array();
        if(! $contato->getCelular())
            array_push($errorContato, "O campo [Celular] é obrigatório.");

        if(! $contato->getEmail())
            array_push($errorContato, "O campo [E-mail] é obrigatório.");
    return $errorContato;
    }
    public function validarUsuario(Usuario $usuario,string $confSenha) {
        $errorUsuario = array();

        if(! $usuario->getNome())
            array_push($errorUsuario, "O campo [Nome] é obrigatório.");
        
        if(! $usuario->getSenha())
            array_push($errorUsuario, "O campo [Senha] é obrigatório.");

        if(! $confSenha)
            array_push($errorUsuario, "O campo [Confirmação da senha] é obrigatório.");
        
        if(! $usuario->getCpf())
            array_push($errorUsuario, "O campo [CPF] é obrigatório.");

        //Validar se a senha é igual a contra senha
        if($usuario->getSenha() != $confSenha)
            array_push($errorUsuario, "O campo [Senha] e [Confirmação da senha] devem ser iguais.");
            
    return $errorUsuario;
    }
    public function insertUsu(Usuario $usuario){
        $usuarioDao = new UsuarioDAO();
        $usuarioDao->insert($usuario);
    }
    public function insertEnd(Endereco $endereco){
        $enderecoDao = new EnderecoDAO();
        $enderecoDao->insert($endereco);
    }
    public function insertCont(Contato $contato){
        $contatoDao = new ContatoDAO();
        $contatoDao->insert($contato);
    }

    public function updateUsu(Usuario $usuario){
        $usuarioDao = new UsuarioDAO();
        $usuarioDao->update($usuario);
    }
    public function updateEnd(Endereco $endereco){
        $enderecoDao = new EnderecoDAO();
        $enderecoDao->update($endereco);
    }
    public function updateCont(Contato $contato){
        $contatoDao = new ContatoDAO();
        $contatoDao->update($contato);
    }

}
