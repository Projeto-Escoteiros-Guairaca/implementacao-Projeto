<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");

?>

</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />

<h3 class='text-center'>Tarefa <?= $dados["tarefa"]->getNomeTarefa(); ?> </h3>
    <section class="container">
        <div class="tarefa">
            <div id="tarefa-container">
                <h3>Descrição</h3>
                <div id="descricao">
                    <?php echo $dados["tarefa"]->getDescricaoTarefa();?> 
                </div>
                <hr>
                <h3>Status</h3>
                <div id="status">
                    <hr>
                    <h5>Veja o estado da entrega dos usuários: </h5> 
                    <a href="<?=BASEURL?>/controller/UsuarioController.php?action=listUsuariosByAlcateia&idAlcateia=<?=$_SESSION[SESSAO_USUARIO_IDALCATEIA]?>"> lista de usuários</a>
                
                </div>
            </div>
        </div>
    </section>
<script src="<?= BASEURL ?>/view/js/alcateia.js"> </script> 
<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>