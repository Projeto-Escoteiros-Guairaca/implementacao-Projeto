<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/AcessoController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");

session_status();
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];

?>
<?php require_once(__DIR__ . "/../../include/menu.php"); ?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/index.css" />

<div class="container p-2 cx_meio">
    <div class="row apresentacao">
        <div class="col-6 text">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit officiis quaerat sint officia eos repellendus itaque dolor impedit quia harum dolorem ex ratione, cum quasi maiores praesentium in doloremque modi?</p>
        </div>
    </div>
</div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>