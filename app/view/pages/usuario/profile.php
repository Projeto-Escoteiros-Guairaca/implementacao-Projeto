
<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
?>
<?php require_once(__DIR__ . "/../../include/menu.php");?>
<link rel="stylesheet" type="text/css" href="../view/styles/profile.css?v=<?php echo time(); ?>">
<div class="container col-12">
    <a class="btn btn-primary" href='<?= HOME_PAGE ?>'>Voltar</a>
                
    <h1> Dados do Usuário </h1>
    <button> <a href="<?= BASEURL ?>
        /controller/UsuarioController.php?action=edit&id=<?=$dados['usuario']->getId()?>">
        Quer alterar teus Dados? </a>  </button>
        <br>
    <div class= "col-4 " id="usuario">
        <div class= "row">
            <label> Nome: </label>
        </div>      
            <div class = "row">
                <b> <li><?= $dados['usuario']->getNome(); ?></li> </b>
            </div>
        <hr>

        <div class= "row">
            <label> Nome do Login: </label>
        </div>
            <div class="row">
                <b> <li><?= $dados['usuario']->getLogin(); ?></li> </b>
            </div>
        <hr>

        <div class= "row">
            <label> Teu papel no sistema: </label>
        </div>
            <div class= "row">
                <b> <li><?= $dados['usuario']->getPapeisStr(); ?></li> </b>
            </div>
        <hr>

        <div class= "row">
            <label> Tua senha: </label>
        </div>
            <div class= "row">
                <b> <li><?= $dados['usuario']->getSenha(); ?></li> </b>
            </div>
    </div>

    <h2>Endereco </h2>
    <div class= "col-4" id="endereco">
        <div class= "row">
            <label> Teu CEP: </label>
        </div>
            <div class= "row">
                <b> <li><?= $dados['usuario']->getEndereco()->getCep(); ?></li> </b>
            </div>
    <hr>
        <div class= "row">
            <label> Logradouro: </label>
        </div>
            <div class= "row">
                <b> <li><?=$dados['usuario']->getEndereco()->getLogradouro(); ?></li> </b>
        </div>
    <hr>
        <div class= "row">
            <label> Teu numero de endereço: </label>
        </div>
            <div class= "row">
                <b> <li><?= $dados['usuario']->getEndereco()->getNumeroEndereco(); ?></li> </b>
            </div>
    <hr>
        <div class= "row">
            <label> Bairro: </label>
        </div>
            <div class= "row">
                <b> <li><?= $dados['usuario']->getEndereco()->getBairro(); ?></li> </b>
            </div>
    <hr>
        <div class= "row">
            <label> cidade:: </label>
        </div>
            <div class= "row">
                <b> <li><?= $dados['usuario']->getEndereco()->getCidade(); ?></li> </b>
            </div>
    <hr>
        <div class= "row">
            <label> Pais: </label>
        </div>
            <div class= "row">
                <b><li><?= $dados['usuario']->getEndereco()->getPais(); ?></li> </b>
            </div>
    </div>

    <h2>Contato </h2>
    <div class= "col-4" id="contato">
        <div class= "row">
            <label> Telefone de casa: </label>
            <b> <li><?= $dados['usuario']->getContato()->getTelefone(); ?></li> </b>
        </div>
        <hr>
        <div class= "row">
            <label> Celular: </label>
        </div>
            <div class= "row">
                <b> <li><?= $dados['usuario']->getContato()->getCelular(); ?></li> </b>
            </div>
        <hr>
        <div class= "row">
            <label> Email: </label>
        </div>
            <div class= "row">
                <b>  <li><?= $dados['usuario']->getContato()->getEmail(); ?></li> </b>
            </div>
    </div>
</div>
<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>