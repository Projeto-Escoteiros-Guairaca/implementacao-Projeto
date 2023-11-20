<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
?>
<?php require_once(__DIR__ . "/../../include/menu.php"); ?>
<link rel="stylesheet" type="text/css" href="../view/styles/profile.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />

<h1 class="text-center">Dados do Usuario</h1>

<a class="btn_inserir" href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $dados['usuario']->getId() ?>">
  <div class="div_icon_inseriri">
    <i class="icon_inserir bi bi-plus"></i>
  </div>
  <div class="div_titulo_inserir">
    <h5 class="titulo_btn_inserir">Editar dados</h5>
  </div>
</a>

<div class="container">
  <div class="col-12">



    <div class="card_dados">
      <h2>Usuário</h2>

      <h6 class="h6_dados">Nome:</p>

        <p class="p_dados"> <?= $dados['usuario']->getNome(); ?>
        </p>

        <h6 class="h6_dados">Nome do Usuário:</h6>

        <p class="p_dados"> <?= $dados['usuario']->getLogin(); ?>
        </p>

        <h6 class="h6_dados">Classificacão:</h6>

        <p class="p_dados"> <?= $dados['usuario']->getPapeisStr(); ?>
        </p>

        <h6 class="h6_dados">Senha:</h6>

        <p class="p_dados"> <?= $dados['usuario']->getSenha(); ?>
        </p>

    </div>

    <div class="card_dados">
      <h2>Endereço </h2>

      <h6 class="h6_dados">CEP:</h6>
      <p class="p_dados"><?= $dados['usuario']->getEndereco()->getCep(); ?> </p>

      <h6 class="h6_dados">Logradouro:</h6>
      <p class="p_dados"> <?= $dados['usuario']->getEndereco()->getLogradouro(); ?> </p>

      <h6 class="h6_dados">Número de endereço:</h6>
      <p class="p_dados"> <?= $dados['usuario']->getEndereco()->getNumeroEndereco(); ?> </p>

      <h6 class="h6_dados">Bairro:</h6>
      <p class="p_dados"> <?= $dados['usuario']->getEndereco()->getBairro(); ?> </p>

      <h6 class="h6_dados">Cidade:</h6>
      <p class="p_dados"> <?= $dados['usuario']->getEndereco()->getCidade(); ?> </p>

      <h6 class="h6_dados">País:</h6>
      <p class="p_dados"> <?= $dados['usuario']->getEndereco()->getPais(); ?> </p>

    </div>

    <div class="card_dados">
      <h2>Contato </h2>

      <h6 class="h6_dados">Telefone residencial:</h6>

      <p class="p_dados"> <?= $dados['usuario']->getContato()->getTelefone(); ?> </p>

      <h6 class="h6_dados">Celular:</h6>

      <p class="p_dados"> <?= $dados['usuario']->getContato()->getCelular(); ?> </p>

      <h6 class="h6_dados">Email:</h6>

      <p class="p_dados"> <?= $dados['usuario']->getContato()->getEmail(); ?> </p>

    </div>

  </div>
</div>

<a href='<?= HOME_PAGE ?>'>Voltar</a>
<script src="<?= BASEURL ?>/view/js/usuario.js"> </script>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>