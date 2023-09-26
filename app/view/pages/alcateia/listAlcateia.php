<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listAlcateias.css" />

<h3 class='text-center'>Alcateias</h3>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" href="<?= BASEURL ?>/controller/AlcateiaController.php?action=create">Inserir</a>
        </div>
        <div class="col-9">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
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
                                href="<?= BASEURL ?>/controller/AlcateiaController.php?action=edit&id=<?= $alc->getId_alcateia() ?>">
                                Alterar</a> 
                            <button class="btn btn-info" onclick="usuarios(<?php echo $alc->getId_alcateia(); ?>, '<?php echo BASEURL ?>')">
                                    Mostrar Dados da Alcateia: </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <a class="btn btn-success" 
                href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
    </div>
</div>
<br><br><br><br><br>

<script src="<?= BASEURL ?>/view/js/alcateia.js"> </script> 
<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>