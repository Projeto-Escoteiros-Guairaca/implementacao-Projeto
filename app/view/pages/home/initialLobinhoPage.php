<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/AcessoController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__."/../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/index.css" />

<!-- COMECO DOS CARDS -->
<div class="container-fluid pt-4">
  <div class="dados-lobinhos">
    <p>Atividades feitas: <?= $dados['atividadesFeitas']?>/<?=$dados['atividades'] ?></p>
    <p>Encontros participados: <?= $dados['faltas']?>/<?=$dados['frequenciasTotais'] ?></p>
    <p>Faltas consecutivas: <?= $dados['faltasConsecutivas']?>/3</p>
  </div>

  <div class="row">
    
    <div class="col-sm-6 col-md-3 pb-4">
      <a class="card text-center card-sweg"  href="<?= BASEURL ?>/controller/AtividadeController.php" class="btn btn-primary">
        <div class="card-body btn">
            <p class="card-text text-center">
              <i class="bi bi-journal-check incons_redirecionais"></i>
            </p>
           <div class="card-sweg-details btn">
              <h5 class="card-title">Atividades</h5>
          </div>  
        </div>
      </a>
    </div>

<?php
    require_once(__DIR__."/../../include/footer.php");
?>