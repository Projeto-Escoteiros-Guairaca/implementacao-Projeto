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
            <a class="btn btn-success" href="<?= BASEURL ?>/controller/EncontroController.php?action=create">Inserir</a>
        </div>
        <div class="col-6">

            <form method="POST" action="<?= BASEURL ?>/controller/EncontroController.php?filtered=true">

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
                <a href="<?= BASEURL ?>/controller/EncontroController.php?action=list" class="btn btn-alert"> Limpar filtro </a>

            </form>

        </div>
        <div class="col-6">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabencontros" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Alcateia</th>
                            <th>Alterar</th>
                            <th>Lista de usuários</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (count($dados["lista"]) == 0) : ?>
                        <tr>
                            <td colspan="6">Nenhum encontro encontrado, tente novamente.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($dados["lista"] as $enc): ?>
                            <tr>
                                <td><?php echo $enc->getDataFormated(); ?></td>
                                <td><?= $enc->getDescricao(); ?></td>
                                <td><?= $enc->getAlcateia()->getNome(); ?></td>
                                <td>
                                    <a class="btn btn-primary" 
                                        href="<?= BASEURL ?>/controller/EncontroController.php?action=edit&id=<?= $enc->getId_encontro() ?>">
                                        Alterar</a> 
                                </td>
                                <td>
                                    <a class="btn btn-secondary" 
                                        href="<?= BASEURL ?>/controller/FrequenciaController.php?action=createFrequencias&idEncontro=<?= 
                                            $enc->getId_encontro()?>&idAlcateia=<?= $enc->getId_alcateia()?>">
                                        Usuários</a> 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    </tbody>
                </table>
                <a class="btn btn-success" 
                    href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
            </div>
        </div>
</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>