<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/AcessoController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
?>
<?php require_once(__DIR__ . "/../../include/menu.php"); ?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/index.css" />

<div class="container cx_meio col-12">
    
        <a class="botoes_redirecionais">
            <div class= "div_redirecionais">
                <p class= "p_redirecionais">Cadastro</p>
                <i class="bi bi-person-add incons_redirecionais"></i>
            </div>
        </a>
        <a class="botoes_redirecionais">
            <div class= "div_redirecionais">
                <p class= "p_redirecionais">Alcateias</p>

            </div>
        </a>
        <a class="botoes_redirecionais">
            <div class= "div_redirecionais">
                <p class= "p_redirecionais">Encontros</p>
                <i class="bi bi-people incons_redirecionais"></i>
            </div>
        </a>

</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>