<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
    require_once(__DIR__ . "/../lobinhoOnly/lobinhoSendedTarefa.php");

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
                    <h5 style="color:brown;"><?php echo $dados['envioUsuario']->getStatusEntregaPalavra(); ?></h5 > 
                    <hr>
                    <h4>Data da entrega: </h4>
                    <h5 style="color:darkorange;"><?php echo $dados['envioUsuario']->getDataEntrega(); ?></h5 > 
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <?php
                lobinhoSendedTarefa::MostraTarefa($dados['envioUsuario']);  
                ?>
                <div>
                    <form action="TarefaController.php?action=validateTarefa&isForm=true&idEnvio=<?php echo $dados['envioUsuario']->getIdEntrega();?>&idUsuario=<?php echo $dados['envioUsuario']->getUsuario()->getid();?>" method="POST">
                        <input type="radio" id="aprovado" name="avaliacao" value="2">
                        <label for="aprovado">Aprovado</label><br>
                        <input type="radio" id="enviardnv" name="avaliacao" value="1">
                        <label for="enviardnv">Enviar Novamente</label><br>
                        <button type="submit" class="btn_gravar">Avaliar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script src="<?= BASEURL ?>/view/js/matilha.js"> </script> 
<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>