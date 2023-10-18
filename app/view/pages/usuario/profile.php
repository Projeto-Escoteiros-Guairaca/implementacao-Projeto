
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
        /controller/AcessoController.php?controller=Usuario&action=edit&id=<?=$dados['usuario']->getId()?>">
        Quer alterar seus Dados? </a>  </button>
        <br>
  <div class="row justify-content-center" id="apresentacoes">

  <button class="b_apresentacoes btn btn-primary"> <i class="bi bi-person-fill"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
</svg>Usuario </button>
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

  <button class="b_apresentacoes btn btn-primary">  <i class="fas fa-home"></i> Endereco </button>
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

  <button class="b_apresentacoes btn btn-primary"><i class= "bi-telephone-fill"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg>Contato </button>
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