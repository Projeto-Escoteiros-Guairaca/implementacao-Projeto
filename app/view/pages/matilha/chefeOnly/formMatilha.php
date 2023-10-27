<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
    require_once(__DIR__ . "/../../../../dao/UsuarioDAO.php");
    require_once(__DIR__ . "/../../../../model/Usuario.php");
    require_once(__DIR__ . "/../../usuario/selectUsuChefe.php");
    require_once(__DIR__ . "/../../usuario/selectUsuPrimo.php");
    require_once(__DIR__ . "/../../../../controller/LinkController.php");
    require_once(__DIR__ . "/../../../../controller/MatilhaController.php");
?>

<div class="container">

    <div class="row">
        <div class="col-6">
            <form id="formMatilha" method="POST" action="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=save">
                
                <h2 class="text-center">
                    <?php if(isset($dados["id_matilha"])): ?>
                        Alterar Matilha
                    <?php else: ?>
                        Criar uma nova Matilha
                    <?php endif; ?>
                </h2>

                <div class="form-group col-6">
                    <label style="width: fit-content;" for="txtNomeMatilha">Nome:</label>
                    <input style="width: 150px;" class="form-control" type="text" id="txtNomeMatilha" name="nomeMatilha" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php
                            echo (isset($dados['matilha']) ? $dados['matilha']->getNome(): "");
                        ?>" />
                </div>
                <div class="form-group col-6">
                    <label style="width: fit-content;" for="somUsuChef">Chefe:</label>
                    
                    <?php
                        $usuDao = new UsuarioDAO();
                        $usuarios = $usuDao->findByPapel("CHEFE");
                        SelectUsuChefe::desenhaSelect($usuarios, "chefeMatilha", "somUsuChef", isset($dados['matilha']) ? $dados['matilha']->getIdChefe() : 0);
                    ?>

                </div>
                <?php
                    if($dados["id_matilha"] > 0):
                
                        echo "<div class='form-group col-6'>";
                            echo "<label for='somUsuPrimo'>Primo:</label>";

                                $primos = $usuDao->findPrimo($dados['id_matilha']);
                                SelectUsuChefe::desenhaSelect($primos, "primoMatilha", "somUsuPrimo", isset($dados['matilha']) ? $dados['matilha']->getIdPrimo() : 0);

                        echo "</div>";
                    endif;
                ?>
                
                <input type="hidden" id="hddId" name="id_matilha" value="<?= $dados['id_matilha']; ?>" />
                
                <button type="submit" class="btn btn-success my-2">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
                
            </form>
            <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Matilha&action=listMatilha">Voltar</a>
        </div>
       

        <div class="col-9">
            <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
        </div>

    </div>

</div>

<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>