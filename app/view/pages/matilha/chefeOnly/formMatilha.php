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
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listMatilhas.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />
<div class="container">
    <div class="col-12">
            <form id="formMatilha" class="formularios" method="POST" action="<?= BASEURL ?>/controller/MatilhaController.php?action=save&isForm=true">
                
                <h2 class="text-center">
                    <?php 
                    if(isset($dados["id_matilha"])): ?>
                        Alterar Matilha
                    <?php else: ?>
                        Criar uma nova Matilha
                    <?php endif; ?>
                </h2>

                <div class="form-group">
                    <label for="txtNomeMatilha">Nome:</label>
                    <input class="form-control" type="text" id="txtNomeMatilha" name="nomeMatilha" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php
                            echo (isset($dados['matilha']) ? $dados['matilha']->getNomeMatilha(): "");
                        ?>" />
                </div>
                <div class="form-group">
                    <label for="somUsuChef">Chefe:</label>
                    <?php
                        $usuDao = new UsuarioDAO();
                        $usuarios = $usuDao->findByPapel("CHEFE");
                        SelectUsuChefe::desenhaSelect($usuarios, "chefeMatilha", "somUsuChef", isset($dados['matilha']) ? $dados['matilha']->getIdChefe() : 0);
                    ?>

                </div>
                <?php
                    if($dados["id_matilha"] > 0):
                
                        echo "<div class='form-group'>";
                            echo "<label for='somUsuPrimo'>Primo:</label>";

                                $primos = $usuDao->findPrimo($dados['id_matilha']);
                                SelectUsuChefe::desenhaSelect($primos, "primoMatilha", "somUsuPrimo", isset($dados['matilha']) ? $dados['matilha']->getIdPrimo() : 0);

                        echo "</div>";
                    endif;
                ?>
                
                <input type="hidden" id="hddId" name="id_matilha" value="<?= $dados['id_matilha']; ?>" />
                
                <button type="submit" class=" btn_verde">Gravar</button>
                <button type="reset" class="btn_vermelho">Limpar</button>
                
            </form>
          
       
       

        <div class="col-9">
            <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
        </div>

    </div>

</div>

<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>