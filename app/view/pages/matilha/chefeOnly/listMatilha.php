<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listMatilhas.css" />

<h3 class='text-center'>Matilhas da Alcateia <?php echo $dados['alcateia'][1]; ?></h3>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=create">Inserir</a>
        </div>
        <div class="col-9">
            <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <?php if (count($dados["lista"]) == 0) : ?>
                <center colspan="6">Nenhum encontro encontrado, tente novamente.</center>
            <?php else: ?>
                <?php foreach($dados["lista"] as $alc): ?>
                    <div class="card my-2 mx-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $alc->getNome();?></h5>
                            <hr>
                            <a class="btn btn-warning my-1" 
                                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=edit&id=<?php echo $alc->getId_matilha(); ?>">
                                Alterar</a> 
                            <a class="btn btn-info" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=listMatilha&idMatilha=<?= $alc->getId_matilha()?>&idAlcateia=<?=$dados['alcateia'][0];?>&nomeAlcateia=<?= $dados['alcateia'][1];?>">
                                    Mostrar Dados da Matilha: </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<br><br><br><br><br>

<script src="<?= BASEURL ?>/view/js/matilha.js"> </script> 
<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>