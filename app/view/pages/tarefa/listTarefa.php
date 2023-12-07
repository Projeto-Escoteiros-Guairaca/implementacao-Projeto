<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listaTarefa.css" />


<h3 class='text-center titulos'>Tarefas da atividade <?= $dados["atividade"]->getNomeAtividade(); ?> </h3>



    <div class="row">
        <div>
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>

    <div class="col-12 ">
    <?php if (count($dados["lista"]) == 0) : ?>
        <tr>
            <td colspan="6">Nenhuma tarefa encontrada, tente novamente.</td>
        </tr>
    <?php else : ?>
        <?php foreach ($dados["lista"] as $taref) : ?>

            <div class="card_tarefa">
                <?php

                if (!isset($dados['idUsuario'])) {
                    $linkTarefa = BASEURL . '/controller/AcessoController.php?controller=Tarefa&action=openTarefa&id=' . $taref->getTarefa()->getIdTarefa();
                } else {
                    $linkTarefa = BASEURL . '/controller/AcessoController.php?controller=Tarefa&action=openTarefa&id=' . $taref->getTarefa()->getIdTarefa() . '&idUsuario=' . $dados['idUsuario'];
                }

                ?>
                <div class="titulo_atv" ><strong>
                <a class="a_bugs" href="<?= $linkTarefa ?>">
                     <?php echo $taref->getTarefa()->getNomeTarefa(); ?> 
                </a> </strong>
                </div> <br> 
                <?php
                $echo = '<div class=" status_atv "><strong>Status da atividade:</strong><br>
                <button class="tarefaCheckada';
                if ($taref->getStatusEntrega() != null) {
                    $echo .= $taref->getStatusEntrega();
                }
                echo $echo . '">
                </button>
                
                    </div>
                ';
                ?>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>

</div>

<script src="<?= BASEURL ?>/view/js/matilha.js"> </script>
<script src="<?= BASEURL ?>/view/js/tarefa.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>