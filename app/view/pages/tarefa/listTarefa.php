<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");

?>

</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listaTarefa.css" />

<h3 class='text-center'>Tarefas da atividade<?= $dados["atividade"]->getNomeAtividade(); ?> </h3>

<div class='container dados_universais_atv'>
        <div class="row">
            <div class="col-12">
                <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
            </div>
        </div>

        <div class="tarefas">
            <?php if (count($dados["lista"]) == 0) : ?>
                <tr>
                    <td colspan="6">Nenhuma tarefa encontrada, tente novamente.</td>
                </tr>
            <?php else: ?>
                <?php foreach($dados["lista"] as $taref): ?>

                <div class="containerTarefa dados_universais_atv">
                <a class="leftPart dados_universais_atv" href="<?= BASEURL ?> /controller/TarefaController.php?action=openTarefa&id=<?=$taref->getIdTarefa(); ?>">
                            <p class=""p_atv><?php echo $taref->getNomeTarefa(); ?> </p>
                </a>
                        <div class="rightPart dados_universais_atv">
                            <button class="tarefaCheckada"></button>
                        </div>
                </div>

            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <a class="btn btn-success my-2 btn-return" 
        href="<?= BASEURL ?>/controller/AtividadeController.php">Voltar</a>

</div>

<script src="<?= BASEURL ?>/view/js/alcateia.js"> </script> 
<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>