<?php
    require_once(__DIR__ . "/../include/header.php");
    require_once(__DIR__ . "/../include/menu.php");
    
?>

<div class="container">

    <div class="row">
        <div class="col-6">
            <form id="formAlcateia" method="POST" action="<?= BASEURL ?>/controller/AlcateiaController.php?action=save">
                
                <h2 class="text-center">
                    <?php if(isset($dados["id_alcateia"])): ?>
                        Alterar Alcateia
                    <?php else: ?>
                        Criar uma nova Alcateia
                    <?php endif; ?>
                </h2>

                <div class="form-group col-6">
                    <label for="txtNomeAlcateia">Nome:</label>
                    <input class="form-control" type="text" id="txtNomeAlcateia" name="nomeAlcateia" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php
                            echo (isset($dados['alcateia']) ? $dados['alcateia']->getNome(): "");
                        ?>" />
                </div>
                
                <input type="hidden" id="hddId" name="id_alcateia" value="<?= $dados['id_alcateia']; ?>" />
                
                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
                
            </form>
            <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/AlcateiaController.php">Voltar</a>
        </div>
       

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>

    </div>

</div>

<?php
    require_once(__DIR__ . "/../include/footer.php");
?>