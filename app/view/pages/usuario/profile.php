
<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
?>
<?php require_once(__DIR__ . "/../../include/menu.php");?>
<link rel="stylesheet" type="text/css" href="../view/styles/profile.css?v=<?php echo time(); ?>">

<div class="d_total">
    <a id="btn_voltar_profile" class=" btn " href='<?= HOME_PAGE ?>'>Voltar</a>
                
    <h1> Dados do Usuário </h1>
    <button id="btn_altercao" class=" btn "> <a href="<?= BASEURL ?>
        /controller/UsuarioController.php?action=edit&id=<?=$dados['usuario']->getId()?>">
        Quer alterar seus Dados? </a>  </button>
        <br>
  <div class="row justify-content-center">

  <button> Usuario </button>
  <dialog>
    <div id="usuario" class="col-3 m-4">
    <h2>Usuário</h2>

        Nome:
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getNome(); ?> <p>
        <br>
        Nome do Usuário:
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getLogin(); ?> <p>
        <br>
        Classificacão:
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getPapeisStr(); ?><p>
        <br>
        Senha: 
        <br>
        <p class ="p_dados"> <?= $dados['usuario']->getSenha(); ?> <p>
        <br>
    </div>
  </dialog>

  <button> Endereco </button>
  <dialog>
    <div  id="endereco" class="col-3 m-4">
    <h2>Endereço </h2>
    
        CEP: <br>
        <p class ="p_dados"><?= $dados['usuario']->getEndereco()->getCep(); ?> </p>
        <br>
        Logradouro: <br>
        <p class ="p_dados"> <?=$dados['usuario']->getEndereco()->getLogradouro(); ?> </p>
        <br>
        Número de endereço:<br>
        <p class ="p_dados"> <?= $dados['usuario']->getEndereco()->getNumeroEndereco(); ?> </p>
        <br>
        Bairro:<br>
        <p class ="p_dados"> <?= $dados['usuario']->getEndereco()->getBairro(); ?> </p>
        <br>
        Cidade:<br>
        <p class ="p_dados"> <?= $dados['usuario']->getEndereco()->getCidade(); ?> </p>
        <br>
        País:<br>
        <p class ="p_dados"> <?= $dados['usuario']->getEndereco()->getPais(); ?> </p>
        <br>
    </div>
  </dialog>

  <button> Contato </button>
  <dialog>
    <div id="contato" class="col-3 m-4">
    <h2>Contato </h2>
        
        Telefone residencial: <br>
        <p class ="p_dados"> <?= $dados['usuario']->getContato()->getTelefone(); ?> </p>
        <br>
        Celular:<br>
        <p class ="p_dados">  <?= $dados['usuario']->getContato()->getCelular(); ?> </p>
        <br>
        Email: <br>
        <p class ="p_dados"> <?= $dados['usuario']->getContato()->getEmail(); ?> </p>
        <br>
    </div>
    </dialog>
    
  </div> 
</div>

<script src="<?= BASEURL ?>/view/js/usuario.js"> </script> 

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>