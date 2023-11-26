<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
?>

</style>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />
<a href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=listMatilhas&idAlcateia=<?=$dados['alcateia'][0];?>&nomeAlcateia=<?= $dados['alcateia'][1];?>">voltar</a>
<h2 class='text-center titulos'>Matilha <?= $dados["matilha"]->getNomeMatilha(); ?> </h3>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <div id="status">
                    <hr>
                    <h4>Primo: </h4>
                    <h5 style="color:brown;"><?php 
                    if($dados['matilha']->getIdPrimo() != null) {
                        echo $dados['matilha']->getUsuarioPrimo()->getNome();
                    }  
                    else {
                       echo "O primo ainda não foi selecionado.";
                    }
                    ?></h5>
                    <hr>
                    <h4>Chefe responsável: </h4>
                    <h5 style="color:darkorange;">
                    <?php 
                    if($dados['matilha']->getIdChefe() != null) {
                        echo $dados['matilha']->getUsuarioChefe()->getNome();
                    }  
                    else {
                       echo "Esta matilha está sem um chefe. Defina ele na página dos Lobinhos.";
                    }
                    ?>
                </h5 > 
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <h3>Lobinhos: </h3>
                <div id="descricao">
                <hr>
                    <?php foreach ($dados["usuarios"] as $usu):?>

                        <a href="<?=BASEURL?>/controller/MatilhaController.php?action=definePrimo&isForm&idMatilha=<?=$dados['matilha']->getIdMatilha()?>&id=<?=$usu->getId()?>" class="btn btn-warning"> Definir Como primo </a>
                        
                        <?= $usu->getNome();?>
                        <br>
                        <br>
                        <a href="<?=BASEURL?>/controller/AcessoController.php?controller=Usuario&action=profile&id=<?=$usu->getId() ?>" class="btn btn-warning">dados do Lobinho</a>
                    <hr>
                    <?php endforeach;?>
                </div>
                </div>
            </div>
        </div>
    </section>
<script src="<?= BASEURL ?>/view/js/matilha.js"> </script> 
<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>