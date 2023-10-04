<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
?>

</style>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />

<h2 class='text-center'>Alcateia <?= $dados["alcateia"]->getNome(); ?> </h3>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <div id="status">
                    <hr>
                    <h4>Primo: </h4>
                    <h5 style="color:brown;"><?php echo $dados['alcateia']->getIdPrimo(); ?></h5 > 
                    <hr>
                    <h4>Chefe: </h4>
                    <h5 style="color:darkorange;"><?php echo $dados['alcateia']->getIdChefe(); ?></h5 > 
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
                    
                        <?= $usu->getNome();?>

                        <a class="btn btn-warning">dados do Lobinho</a>
                    <hr>
                    <?php endforeach;?>
                </div>
                </div>
            </div>
        </div>
    </section>
<script src="<?= BASEURL ?>/view/js/alcateia.js"> </script> 
<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>