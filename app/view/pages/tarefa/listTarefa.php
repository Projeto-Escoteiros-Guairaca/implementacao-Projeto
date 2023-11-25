<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
?>

</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listaTarefa.css" />


<h3 class='text-center'>Tarefas da atividade<?= $dados["atividade"]->getNomeAtividade(); ?> </h3>
<a class="btn_cards_atv" href = "<?= BASEURL ?>/controller/AcessoController.php?controller=Atividade&action=listAtividades"> voltar à lista de Atividades </a>

<div class="col-12 dados_universais_atv">
        <div class="row">
            <div >
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
                <a class="leftPart dados_universais_atv" href="<?= BASEURL ?> /controller/AcessoController.php?controller=Tarefa&action=openTarefa&id=<?=$taref->getTarefa()->getIdTarefa(); ?>">
                            <p class="p_atv"><?php echo $taref->getTarefa()->getNomeTarefa(); ?> </p>
                </a>
                <?php
                $echo = '<div class="rightPart dados_universais_atv">
                <button class="tarefaCheckada';
                if($taref->getStatusEntrega() != null) {
                    $echo .= $taref->getStatusEntrega();
                }
                echo $echo . '"></button>
                    </div>
                ';   
                ?>
                </div>

            <?php endforeach; ?>
            <?php endif; ?>
        </div>
</div>
               
<script src="<?= BASEURL ?>/view/js/matilha.js"> </script>
<?php
    require_once(__DIR__ . "/../../include/footer.php");
?> 
