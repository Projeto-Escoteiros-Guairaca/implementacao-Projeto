<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
?>

</style>
<style>
textarea {
  resize: none;
}
</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />
<a class="btn_cards_atv" href = "<?= BASEURL ?>/controller/AcessoController.php?controller=Tarefa&action=listTarefas"> voltar à lista de tarefas </a>

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
                <div id="status">
                    <hr>
                    <h4>Estado da entrega: </h4>
                    <h5 style="color:brown;">
                    
                    <?php
                    if(null != $dados['tarefa']->getStatusEntregaPalavra()) {
                        echo $dados['tarefa']->getStatusEntregaPalavra();
                    }
                    else {
                        echo "Não entregou ainda.";
                    }
                    ?></h5 >
            </div>
        </div>
    </section>
    <br>
    <br>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <h3>Escreva aqui qualquer detalhe que precises:</h3>
                <div id="descricao">
                    <hr><textarea cols="30" rows="10"><?php echo $dados["tarefa"]->getDescricaoEntrega();?></textarea>
                    <hr>

                    <h3>passe por aqui os arquivos!</h3>
                    
                    <input type="file"/> 
                </div>
            </div>
        </div>
    </section>
<script src="<?= BASEURL ?>/view/js/matilha.js"> </script> 
<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>