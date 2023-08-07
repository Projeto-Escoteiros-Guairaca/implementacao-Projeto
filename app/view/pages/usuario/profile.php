
<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
?>
<?php require_once(__DIR__ . "/../../include/menu.php");?>
<link rel="stylesheet" type="text/css" href="../view/styles/profile.css?v=<?php echo time(); ?>">
<div class="container">
    <a class="btn btn-primary" href='<?= HOME_PAGE ?>'>Voltar</a>
                
    <h1> Datos do Usuário </h1>
    <button> <a href="<?= BASEURL ?>
        /controller/UsuarioController.php?action=edit&id=<?=$dados['usuario']->getId()?>">
        Quer alterar teus Dados? </a>  </button>
        <br>
    <div id="usuario">
        <div>
            <label> Nome: </label>
        <b> <li><?= $dados['usuario']->getNome(); ?></li> </b>
        </div>
        <hr>
        <div>
            <label> Nome do Login: </label>
            <b> <li><?= $dados['usuario']->getLogin(); ?></li> </b>
        </div>
        <hr>
        <div>
            <label> Teu papel no sistema: </label>
            <b> <li><?= $dados['usuario']->getPapeisStr(); ?></li> </b>
        </div>
        <hr>
        <div>
            <label> Tua senha: </label>
            <b> <li><?= $dados['usuario']->getSenha(); ?></li> </b>
        </div>
    </div>

    <h2>Endereco </h2>
    <div id="endereco">
        <div>
            <label> Teu CEP: </label>
            <b> <li><?= $dados['usuario']->getEndereco()->getCep(); ?></li> </b>
        </div>
    <hr>
        <div>
            <label> Logradouro: </label>
        <b> <li><?=$dados['usuario']->getEndereco()->getLogradouro(); ?></li> </b>
        </div>
    <hr>
        <div>
            <label> Teu numero de endereço: </label>
            <b> <li><?= $dados['usuario']->getEndereco()->getNumeroEndereco(); ?></li> </b>
        </div>
    <hr>
        <div>
            <label> Bairro: </label>
            <b> <li><?= $dados['usuario']->getEndereco()->getBairro(); ?></li> </b>
        </div>
    <hr>
        <div>
            <label> cidade:: </label>
            <b> <li><?= $dados['usuario']->getEndereco()->getCidade(); ?></li> </b>
        </div>
    <hr>
        <div>
            <label> Pais: </label>
            <b><li><?= $dados['usuario']->getEndereco()->getPais(); ?></li> </b>
        </div>
    </div>

    <h2>Contato </h2>
    <div id="contato">
        <div>
            <label> Telefone de casa: </label>
            <b> <li><?= $dados['usuario']->getContato()->getTelefone(); ?></li> </b>
        </div>
        <hr>
        <div>
            <label> Celular: </label>
            <b> <li><?= $dados['usuario']->getContato()->getCelular(); ?></li> </b>
        </div>
        <hr>
        <div>
            <label> Email: </label>
        <b>  <li><?= $dados['usuario']->getContato()->getEmail(); ?></li> </b>
        </div>
    </div>
</div>
<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>