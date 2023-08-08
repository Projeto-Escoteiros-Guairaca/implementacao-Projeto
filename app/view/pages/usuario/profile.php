
<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
?>
<?php require_once(__DIR__ . "/../../include/menu.php");?>
<link rel="stylesheet" type="text/css" href="../view/styles/profile.css?v=<?php echo time(); ?>">

<div class="d_total">
    <a class="btn btn-primary" href='<?= HOME_PAGE ?>'>Voltar</a>
                
    <h1> Dados do Usuário </h1>
    <button> <a href="<?= BASEURL ?>
        /controller/UsuarioController.php?action=edit&id=<?=$dados['usuario']->getId()?>">
        Quer alterar teus Dados? </a>  </button>
        <br>


    <div class= "col-4 " id="usuario">
       
    <h2>Usuario</h2>

        Nome:
        <?= $dados['usuario']->getNome(); ?>
        
        Nome do Login: </label>
        <?= $dados['usuario']->getLogin(); ?>

        Teu papel no sistema:
        <?= $dados['usuario']->getPapeisStr(); ?>

        Tua senha: 
        <?= $dados['usuario']->getSenha(); ?> 
    </div>

    <div class= "col-4 " id="endereco">
    <h2>Endereco </h2>
    
        Teu CEP: 
        <?= $dados['usuario']->getEndereco()->getCep(); ?> 
        
        Logradouro: 

        <?=$dados['usuario']->getEndereco()->getLogradouro(); ?>

        Teu numero de endereço:
        <?= $dados['usuario']->getEndereco()->getNumeroEndereco(); ?>
        
        Bairro:
        <?= $dados['usuario']->getEndereco()->getBairro(); ?>
        
        cidade:
        <?= $dados['usuario']->getEndereco()->getCidade(); ?> 
    
         Pais:
        <?= $dados['usuario']->getEndereco()->getPais(); ?>

    </div>

    
    <div class= "col-4" id="contato">
    <h2>Contato </h2>
        
        Telefone de casa: 
        <?= $dados['usuario']->getContato()->getTelefone(); ?> 
        
        Celular:
        <?= $dados['usuario']->getContato()->getCelular(); ?>
         
        Email: 
        <?= $dados['usuario']->getContato()->getEmail(); ?>
    </div>

</div>
<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>