<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/LinkController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__."/../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/index.css" />

<!-- COMECO DOS CARDS -->
<div class="container-fluid pt-4">

  <div class="row">
    
    <div class="col-sm-6 col-md-3 pb-4">
      <a class="card text-center card-sweg"  href="<?= BASEURL ?>/controller/AcessoController.php?controller=Atividade&action=listAtividades" class="btn btn-primary">
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


    <div class="col-sm-6 col-md-3 pb-4">
      <a class="card text-center card-sweg" href=" <?=BASEURL ?>/controller/AcessoController.php?controller=Usuario&action=listUsuarios">
       <div class="card-body btn">
          <p class="card-text text-center">
            <img class="incons_redirecionais" src="<?= BASEURL ?>/view/pages/home/images/lobo.png" alt="">
          </p>
          <div class="card-sweg-details ">
            <h5 class="card-title">Lobinhos</h5>
          </div>  
        </div>
      </a>
    </div>
    

    <div class="col-sm-6 col-md-3 pb-4">
      <a class="card text-center card-sweg" href="<?=BASEURL ?>/controller/AcessoController.php?controller=Alcateia&action=listAlcateia">          
        <div class="card-body btn">
          <p class="card-text text-center">
            <img class="incons_redirecionais" src="<?= BASEURL ?>/view/pages/home/images/alcateia.png" alt="">
          </p>
          <div class="card-sweg-details">
            <h5 class="card-title">Alcateias</h5>
          </div>  
        </div>  
      </a>
    </div>


    <div class="col-sm-6 col-md-3 pb-4">
      <a class="card text-center card-sweg" href="<?=BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=listEncontros">
        <div class="card-body btn">
          <p class="card-text text-center">
             <i class="bi bi-people incons_redirecionais"></i>
          </p>
          <div class="card-sweg-details">
            <h5 class="card-title">Encontros</h5>
          </div>
     </div>
     </a>
  </div>


<?php
    require_once(__DIR__."/../../include/footer.php");
?>
</div>