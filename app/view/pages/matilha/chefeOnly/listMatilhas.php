<?php
require_once(__DIR__ . "/../../../include/header.php");
require_once(__DIR__ . "/../../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listMatilhas.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />

<h3 class='text-center'>Matilhas da Alcateia <?php echo $dados['alcateia'][1]; ?></h3>


<div class="container">
    <div class="col-12">

        <a class="btn_inserir" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=create&idAlcateia=<?= $dados['alcateia'][0]; ?>&nomeAlcateia=<?= $dados['alcateia'][1]; ?>">
            <div class="div_icon_inseriri">
                <i class="icon_inserir bi bi-plus"></i>
            </div>
            <div class="div_titulo_inserir">
                <h5 class="titulo_btn_inserir">Inserir Matilha</h5>
            </div>
        </a>

        <div class="row row_cards_pequenos" style="margin-top: 10px;">

            <?php if (count($dados["lista"]) == 0) : ?>
                <center colspan="6">Nenhum encontro encontrado, tente novamente.</center>
            <?php else : ?>
                <?php foreach ($dados["lista"] as $alc) : ?>
                    <div class="card my-2 mx-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $alc->getNomeMatilha(); ?></h5>
                            <hr>
                            <a class="btn_cards my-1" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=edit&id=<?php echo $alc->getIdMatilha(); ?>&idAlcateia=<?= $dados['alcateia'][0]; ?>&nomeAlcateia=<?= $dados['alcateia'][1]; ?>">
                                Alterar</a>
                                <br> <br>
                            <a class="btn_cards" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=listMatilhas&idMatilha=<?= $alc->getIdMatilha() ?>&idAlcateia=<?= $dados['alcateia'][0]; ?>&nomeAlcateia=<?= $dados['alcateia'][1]; ?>">
                                Mostrar Dados da Matilha: </a>
                                
                           
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="">
    <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
</div>
<br><br><br><br><br>

<script src="<?= BASEURL ?>/view/js/matilha.js"> </script>
<?php
require_once(__DIR__ . "/../../../include/footer.php");
?>