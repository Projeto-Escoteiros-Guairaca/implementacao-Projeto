<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
    require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
    require_once(__DIR__ . "/../alcateia/selectAlcateia.php");
    require_once(__DIR__ . "/../../../controller/LinkController.php");
?>

<div class="container">

    <div class="row">
        
        <div class="col-6">

            <h2 class="text-center">
                <?php if(isset($dados["id_encontro"])): ?>
                    Registrar um Encontro
                <?php else: ?>
                    Alterar Dados de um Encontro
                <?php endif; ?>
            </h2>

            <form id="formEncontro" method="POST" action="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=save">

                <div class="form-group col-6">
                    <label style="width: fit-content;" for="dataEncontro">Data do Encontro:</label>
                    <input style="width: 250px;" class="form-control" type="date" id="dataEncontro" name="dataEncontro" 
                        placeholder="Informe a data"
                        value="<?php
                            echo (isset($dados['encontro']) ? $dados['encontro']->getData(): "");
                        ?>" />
                </div>
                <div class="form-group col-6">
                    <label style="width: fit-content;" for="descricaoEncontro"> Descreva o encontro </label>
                    <textarea style="width: 250px;" class="form-control" id="descricaoEncontro" name="descricaoEncontro" rows="3">
                        <?php
                            echo (isset($dados['encontro']) ? $dados['encontro']->getDescricao(): "");
                        ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label style="width: fit-content;" for="somAlcateia">Alcateia:</label>
                    
                    <?php
                        $alcDao = new AlcateiaDAO();
                        $alcateias = $alcDao->list();

                        SelectAlcateia::desenhaSelect($alcateias, "alcateiaEncontro", "somAlcateia", isset($dados['id_alcateia']) ? $dados['id_alcateia'] : 0);
                    ?>
                </div>
                <input type="hidden" id="hddId" name="id_encontro" value="<?= $dados['id_encontro']; ?>" />
                
                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
                
            </form>
            <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=list">Voltar</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>

    </div>

</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>