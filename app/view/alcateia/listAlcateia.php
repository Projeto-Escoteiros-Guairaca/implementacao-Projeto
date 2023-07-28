<?php
    require_once(__DIR__ . "/../include/header.php");
    require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" href="<?= BASEURL ?>/controller/AlcateiaController.php?action=create">Inserir</a>
        </div>
        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabAlcateias" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Alterar</th>
                            <th>Listar usuários</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados["lista"] as $alc): ?>
                    <table id="tabAlcateias <?php echo $alc->getId_alcateia(); ?>" class="table table-striped table-bordered">
                            <tr >
                                <td><?= $alc->getNome(); ?></td>
                                <td><a class="btn btn-warning" 
                                    href="<?= BASEURL ?>/controller/AlcateiaController.php?action=edit&id=<?= $alc->getId_alcateia() ?>">
                                    Alterar</a> 
                                </td>
                                <td>        <button class="btn btn-info" onclick="usuarios(<?php echo $alc->getId_alcateia(); ?>, 'listUsuarios')"> 
                                   Listar usuarios </button>
                                </td>
                            </tr>
                            </table>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>

<script src="<?= BASEURL ?>/view/js/alcateia.js"> </script> 
<?php
    require_once(__DIR__ . "/../include/footer.php");
?>