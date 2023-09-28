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
        <a class="botoes_redirecionais btn btn-white btn-animate" >
            <div class= "div_redirecionais">
                <p class= "p_redirecionais">Atividades</p>
                <i class="bi bi-journal-check incons_redirecionais"></i>
            </div>
        </a>
        <a class="botoes_redirecionais btn btn-white btn-animate" >
            <div class= "div_redirecionais">
                <p class= "p_redirecionais">Lobinhos</p>
                <img class="incons_redirecionais" src="<?= BASEURL ?>/view/pages/home/images/wolf-pack-battalion.svg" alt="">
            </div>
        </a>
        <a class="botoes_redirecionais btn btn-white btn-animate" >
            <div class= "div_redirecionais">
                <p class= "p_redirecionais">Alcateias</p>
                <img class="incons_redirecionais" src="<?= BASEURL ?>/view/pages/home/images/lobinhos.png" alt="">
            </div>
        </a>
        <a class="botoes_redirecionais btn btn-white btn-animate" >
            <div class= "div_redirecionais">
                <p class= "p_redirecionais">Encontros</p>
                <i class="bi bi-people incons_redirecionais"></i>
            </div>
        </a>

        

</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>