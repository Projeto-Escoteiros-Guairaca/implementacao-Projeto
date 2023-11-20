<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
    require_once(__DIR__ . "/../../../dao/MatilhaDAO.php");
    require_once(__DIR__ . "/../matilha/selectMatilha.php");
    require_once(__DIR__ . "/../../../controller/LinkController.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/encontro.css" />

<div class="container">
    <div class="col-12">
 
        <form id="formEncontro" class="form_universal"method="POST" action="<?= BASEURL ?>/controller/EncontroController.php?action=save&isForm=true">

            <h3 class="titulos">
                <?php if(isset($dados["id_encontro"])): ?>
                    Registrar um Encontro
                <?php else: ?>
                    Alterar Dados de um Encontro
                <?php endif; ?>
            </h3>
                <div class="form-group">
                    <label  for="dataEncontro">Data do Encontro:</label>
                    <input class="form-control" type="date" id="dataEncontro" name="dataEncontro" 
                        placeholder="Informe a data"
                        value="<?php
                            echo (isset($dados['encontro']) ? $dados['encontro']->getDataEncontro(): "");
                        ?>" />
                </div>

                <div class="form-group">
                    <label for="descricaoEncontro"> Descreva o encontro </label>
                    <textarea class="form-control" id="descricaoEncontro" name="descricaoEncontro" rows="3">
                        <?php
                            echo (isset($dados['encontro']) ? $dados['encontro']->getDescricaoEncontro(): "");
                        ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="somMatilha">Matilha:</label>  
                    <?php
                        $alcDao = new MatilhaDAO();
                        $matilhas = $alcDao->list();

                        SelectMatilha::desenhaSelect($matilhas, "matilhaEncontro", "somMatilha", isset($dados['id_matilha']) ? $dados['id_matilha'] : 0);
                    ?>
                </div>

                <input type="hidden" id="hddId" name="id_encontro" value="<?= $dados['id_encontro']; ?>" />
                
                <button type="submit" class="btn_gravar">Gravar</button>
                <button type="reset" class="btn_limpar">Limpar</button>
                
        </form>
    
        <div class="">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>

    
  </div>
  <a href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=listEncontros">Voltar</a>
</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>