<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/AcessoController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
?>
<?php require_once(__DIR__ . "/../../include/menu.php"); ?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/index.css" />

<div class="container p-2 cx_meio">
    <div class="row apresentacao">
        <div class="col-6 text">
            <div> aviso 1</div>
            <div> aviso 2 </div>
            <div> aviso 3</div>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>