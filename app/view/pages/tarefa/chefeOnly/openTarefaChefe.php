<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
?>

</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />
<br>
<h3 class='text-center'>Tarefa <?= $dados["tarefa"]->getNomeTarefa(); ?> </h3>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <h3>Descrição</h3>
                <div id="descricao" class="caixas_texto">
                    <?php echo $dados["tarefa"]->getDescricaoTarefa();?> 
                </div>
                <br>
                <h3>Status</h3>
                <div id="status" class="caixas_texto">
                 
                    <h5>Veja o estado da entrega dos usuários: </h5> 
                    <a class = "btn_lista_usu" href="<?=BASEURL?>/controller/AcessoController.php?controller=Tarefa&action=listUsuarios&idMatilha=<?=$_SESSION[SESSAO_USUARIO_ID_MATILHA]?>&tarefa=1"> lista de usuários</a>
                
                </div>
            </div>
        </div>
    </section>
<script src="<?= BASEURL ?>/view/js/matilha.js"> </script> 
<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>