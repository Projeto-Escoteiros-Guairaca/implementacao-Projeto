<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
    require_once(__DIR__ . "/../../../../dao/UsuarioDAO.php");
    require_once(__DIR__ . "/../../../../model/Usuario.php");
    require_once(__DIR__ . "/../../usuario/selectUsuChefe.php");
    require_once(__DIR__ . "/../../usuario/selectUsuPrimo.php");
    require_once(__DIR__ . "/../../../../controller/AcessoController.php");
    require_once(__DIR__ . "/../../../../controller/AlcateiaController.php");
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
                <div class="form-group col-6">
                    <label for="somUsuChef">Chefe:</label>
                    
                    <?php
                        $usuDao = new UsuarioDAO();
                        $usuarios = $usuDao->findByPapel("CHEFE");
                        SelectUsuChefe::desenhaSelect($usuarios, "chefeAlcateia", "somUsuChef", isset($dados['alcateia']) ? $dados['alcateia']->getIdChefe() : 0);
                    ?>

                </div>
                <?php
                    if($dados["id_alcateia"] > 0):
                
                        echo "<div class='form-group col-6'>";
                            echo "<label for='somUsuPrimo'>Primo:</label>";

                                $primos = $usuDao->findPrimo($dados['id_alcateia']);
                                SelectUsuChefe::desenhaSelect($primos, "primoAlcateia", "somUsuPrimo", isset($dados['alcateia']) ? $dados['alcateia']->getIdPrimo() : 0);

                        echo "</div>";
                    endif;
                ?>
                
                <input type="hidden" id="hddId" name="id_alcateia" value="<?= $dados['id_alcateia']; ?>" />
                
                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
                
            </form>
            <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/AlcateiaController.php">Voltar</a>
        </div>
       

        <div class="col-9">
            <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
        </div>

    </div>

</div>

<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>