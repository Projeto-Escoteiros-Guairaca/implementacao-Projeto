<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/LinkController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/index.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/lobinhos.css" />


<!-- COMECO DOS CARDS -->
<div class="dados_academicos_lobinhos">
  <p>Atividades feitas: <?= $dados['atividadesFeitas'] ?>/<?= $dados['atividades'] ?></p>
  <p>Encontros participados: <?= $dados['faltas'] ?>/<?= $dados['frequenciasTotais'] ?></p>
  <p>Faltas consecutivas: <?= $dados['faltasConsecutivas'] ?>/3</p>
</div>


<div class="col-12">
  <div class="col-sm-6 col-md-3 pb-4">
    <a class="card text-center card-sweg" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Atividade&action=listAtividades" class="btn btn-primary">

      <p class="card-text text-center">
        <i class="bi bi-journal-check incons_redirecionais"></i>
      </p>
      <div class="card-sweg-details btn">
        <h5 class="card-title">Atividades</h5>
      </div>
    </a>
  </div>
  <div class= "balao_de_fala_intial">Agora aperte o botão "Atividades" para ver como está o status de suas atividades!</div>
  <div class="img_escoteiro_intial"><img class="img_escoteiro_intial" src="<?= BASEURL ?>/view/pages/home/images/escoteiro_apresentacao.png" alt="" height="100">
  </div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>