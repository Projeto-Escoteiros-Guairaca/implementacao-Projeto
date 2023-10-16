<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
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
                    <h5 style="color:brown;"><?php 
                    if($dados['alcateia']->getIdPrimo() != null) {
                        echo $dados['alcateia']->getIdPrimo();
                    }  
                    else {
                       echo "O primo ainda não foi selecionado.";
                    }
                    ?></h5>
                    <hr>
                    <h4>Chefe responsável: </h4>
                    <h5 style="color:darkorange;">
                    <?php 
                    if($dados['alcateia']->getIdChefe() != null) {
                        echo $dados['alcateia']->getUsuarioChefe()->getNome();
                    }  
                    else {
                       echo "Esta alcateia está sem um chefe. Defina ele na página dos Lobinhos.";
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
    require_once(__DIR__ . "/../../../include/footer.php");
?>