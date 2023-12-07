<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../../controller/LinkController.php");
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

<div class="col-12">

    <center class="title"><h1>Sobre os Escoteiros</h1></center>
    
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="img-wrapper">
                <img src="<?= BASEURL ?>/view/pages/home/images/logoEscoteiros.png">
            </div>

        </div>

        <div class="col-xs-12 col-md-6 text">
            <p>Há 43 anos o Grupo Escoteiro Guairacá desenvolve várias atividades socioambientais e detém dois importantes certificados de Honra ao Mérito Ambiental (1998 e 2002) e o Troféu Onda Verde do Prêmio Expressão de Ecologia 2012, com o projeto “Plantando Cidadãos”. Cerca de 90 jovens (com idade entre 7 e 21 anos) e 31 adultos voluntários participam do Grupo Escoteiro Guairacá. A entidade mantém ainda parcerias em atividades comunitárias e cívicas, como Natal Solidário, campanhas de educação ambiental e comunitárias em colaboração com outras entidades filantrópicas do município. </p>

        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>