<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");

?>

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

                    <h3 class="text-center">Nenhum tarefa nesta atividade, entre em contato com o seu Chefe.</h3>
                    
                <?php else: ?>
                    <?php foreach($dados["lista"] as $tarefa):?>
                        <div class="card my-2 mx-2" style="width: 18rem;">
                            <img style="height: 225px;" class="card-img-top" src="<?= BASEURL?>/view/pages/home/images/semimagem.jpg" alt="INSERE IMAGEM AQUI LOL">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $tarefa->getNomeTarefa();?></h5>
                                <hr>
                                <p class="card-text">
                                <?php echo $tarefa->getDescricaoTarefa();?></p>
                                <!--<a href="<?= BASEURL?>/controller/TarefaController.php?action=listByIdAtiv&id=" 
                                class="btn btn-primary">Mostrar Tarefas</a>
                                <a href="<?= BASEURL?>/controller/AtividadeController.php?action=edit&id=" 
                                class="btn btn-primary my-2">alterar</a>
                                <a class="btn btn-danger" href="<?= BASEURL?>/controller/AtividadeController.php?action=delete&id="
                                > deletar </a>-->
                            </div>
                        </div>
                    <?php endforeach;?>
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