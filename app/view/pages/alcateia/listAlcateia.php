<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/LinkController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/index.css" />
<h3 class='text-center titulos'>Escolha a Alcateia</h3>
<!-- COMECO DOS CARDS -->


<div class="col-12">
  <?php foreach ($dados['alcateias'] as $alc) : ?>
    <div class="col-sm-6 col-md-3 pb-4">
      <a class="card text-center card-sweg" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=listMatilhas&idAlcateia=<?= $alc->getIdAlcateia(); ?>&nomeAlcateia=<?= $alc->getNomeAlcateia(); ?>">
        <div class="card-body btn">
          <p class="card-text text-center">
            <img class="incons_redirecionais" src="<?= BASEURL ?>/view/pages/home/images/matilha.png" alt="">
          </p>
          <div class="card-sweg-details">
            <h5 class="card-title"> <?= $alc->getNomeAlcateia(); ?></h5>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
</div>


<?php
require_once(__DIR__ . "/../../include/footer.php");
?>