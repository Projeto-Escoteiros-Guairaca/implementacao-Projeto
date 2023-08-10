
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
  <div class="row justify-content-center">
    <div id="usuario" class="col-3 m-4">
    <h2>Usuario</h2>

        Nome:
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getNome(); ?> <p>
        <br>
        Nome do Login:
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getLogin(); ?> <p>
        <br>
        Teu papel no sistema:
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getPapeisStr(); ?><p>
        <br>
        Tua senha: 
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getSenha(); ?> <p>
        <br>
    </div>

    <div  id="endereco" class="col-3 m-4">
    <h2>Endereco </h2>
    
        Teu CEP: <br>
        <?= $dados['usuario']->getEndereco()->getCep(); ?> 
        <br>
        Logradouro: <br>
        <?=$dados['usuario']->getEndereco()->getLogradouro(); ?>
        <br>
        Teu numero de endereço:<br>
        <?= $dados['usuario']->getEndereco()->getNumeroEndereco(); ?>
        <br>
        Bairro:<br>
        <?= $dados['usuario']->getEndereco()->getBairro(); ?>
        <br>
        cidade:<br>
        <?= $dados['usuario']->getEndereco()->getCidade(); ?> 
        <br>
         Pais:<br>
        <?= $dados['usuario']->getEndereco()->getPais(); ?>
        <br>
    </div>
    
    <div id="contato" class="col-3 m-4">
    <h2>Contato </h2>
        
        Telefone de casa: <br>
        <?= $dados['usuario']->getContato()->getTelefone(); ?> 
        <br>
        Celular:<br>
        <?= $dados['usuario']->getContato()->getCelular(); ?>
        <br>
        Email: <br>
        <?= $dados['usuario']->getContato()->getEmail(); ?>
        <br>
    </div>
  </div> 
</div>

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>