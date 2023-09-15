<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");

?>

</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listaTarefa.css" />

<h3 class='text-center'>Tarefas da atividade <?= $dados["atividade"]->getNomeAtividade(); ?> </h3>

<div class='container'>
        <div class="row">
            <div class="col-12">
                <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php if (count($dados["lista"]) == 0) : ?>
                    <tr>
                        <td colspan="6">Nenhum usuário encontrado, tente novamente.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($dados["lista"] as $taref): ?>

                        <div class="buttonn"> <button>
                        <span><?php echo $taref->getNomeTarefa(); ?> </span>

                        <input type="checkbox">
                        </button></div>

                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <a class="btn btn-success my-2" 
                href="<?= BASEURL ?>/controller/AtividadeController.php">Voltar</a>
    </div>

<script src="<?= BASEURL ?>/view/js/alcateia.js"> </script> 
<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>