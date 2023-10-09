<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
?>

</style>
<style>
textarea {
  resize: none;
}
</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />

<h2 class='text-center'>Tarefa <?= $dados["tarefa"]->getNomeTarefa(); ?> </h3>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <h3>Descrição</h3>
                <div id="descricao">
                    <hr>
                    <?php echo $dados["tarefa"]->getDescricaoTarefa();?> 
                    <hr>
                </div>
                <h3>Status</h3>
                <div id="status">
                   
                    
                    <hr>
                    <h4>Estado da entrega: </h4>
                    <h5 style="color:brown;"><?php echo $dados['tarefa']->getStatusEntregaPalavra(); ?></h5 > 
                    <hr>
                    <h4>Data da entrega: </h4>
                    <h5 style="color:darkorange;"><?php echo $dados['tarefa']->getDataEntrega(); ?></h5 > 
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <h3>Descrição da Entrega:</h3>
                <div id="descricao">
                    <hr><textarea disabled cols="30" rows="10"><?php echo $dados["tarefa"]->getDescricaoEntrega();?></textarea>
                    
                    <hr>
                </div>
                <h3>Entrega: </h3>
                <div id="status">
                    <hr>
                    <h4>Estado da entrega: </h4>
                    <h5 style="color:brown;">
                    
                    <?php
                        echo $dados['tarefa']->getStatusEntregaPalavra();
                    ?></h5 >
                    <hr>
                    <h4>Data da entrega: </h4>
                    <h5 style="color:darkorange;"><?php echo $dados['tarefa']->getDataEntrega(); ?></h5 > 
                </div>
            </div>
        </div>
    </section>
<script src="<?= BASEURL ?>/view/js/alcateia.js"> </script> 
<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>