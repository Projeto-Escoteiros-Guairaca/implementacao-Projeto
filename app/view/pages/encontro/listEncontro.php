<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
    require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
    require_once(__DIR__ . "/../alcateia/selectAlcateia.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listEncontro.css" />

<h3 class='text-center'>Encontros</h3>

<div class="container">
    <div class="row">

        <div class="col-3">
            <a class="btn btn-success" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=create">Inserir</a>
        </div>
        <div class="col-6">

            <form method="POST" action="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&filtered=true">

                <input class="filters" class="form-control" type="date" placeholder="De" name="desde" 
                value="<?php
                            echo (isset($dados['desde']) ? $dados['desde'] : "");
                        ?>">
                <input class="filters" class="form-control" type="date" placeholder="Até" name="ate"
                value="<?php
                            echo (isset($dados['ate']) ? $dados['ate'] :  "");
                        ?>">
                <div class="form-group">
                    <label for="somAlcateia">Alcateia:</label>
                    <?php
                        $alcDao = new AlcateiaDAO();
                        $alcateias = $alcDao->list();

                        SelectAlcateia::desenhaSelect($alcateias, "alcateiaEncontro", "somAlcateia", isset($dados['id_alcateia']) ? $dados['id_alcateia'] : 0);
                    ?>
                </div>

                <button class="btn btn-alert" type="submit"> Filtrar </button>
                <a href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=list" class="btn btn-alert"> Limpar filtro </a>

            </form>

        </div>
        <div class="col-6">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <?php if (count($dados["lista"]) == 0) : ?>
                <center colspan="6">Nenhum encontro encontrado, tente novamente.</center>
            <?php else: ?>
                <?php foreach($dados["lista"] as $enc): ?>
                    <div class="card my-2 mx-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $enc->getDataFormated();?></h5>
                            <hr>
                            <p class="card-text"><?php echo $enc->getAlcateia()->getNome();?></p>
                            <p class="card-text"><?php echo $enc->getDescricao();?></p>
                            <a class="btn btn-primary my-1" 
                                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=edit&id=<?= $enc->getId_encontro() ?>">
                                Alterar</a> 
                            <a class="btn btn-secondary" 
                                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Frequencia&action=createFrequencias&idEncontro=<?= 
                                    $enc->getId_encontro()?>&idAlcateia=<?= $enc->getId_alcateia()?>">Registrar Frequência</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <a class="btn btn-success" 
                href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
    </div>
</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>