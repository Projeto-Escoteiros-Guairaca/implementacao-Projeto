<?php
#Nome do arquivo: sobre/sobre.php
#Objetivo: interface com a página inicial do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>


<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/sobre.css" />



<body>


    <div class="container">

        <h1 class="title">Sobre os Escoteiros</h1>

        <div class="row">

            <div class="col-xs-12 col-md-6">
                <div class="img-wrapper">
                    <img src="<?= BASEURL ?>/view/pages/home/images/semimagem.jpg">
                    <p class="img-caption">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>

            </div>

            <div class="col-xs-12 col-md-6">
                <p>Há 43 anos o Grupo Escoteiro Guairacá desenvolve várias atividades socioambientais e detém dois importantes certificados de Honra ao Mérito Ambiental (1998 e 2002) e o Troféu Onda Verde do Prêmio Expressão de Ecologia 2012, com o projeto “Plantando Cidadãos”. Cerca de 90 jovens (com idade entre 7 e 21 anos) e 31 adultos voluntários participam do Grupo Escoteiro Guairacá. A entidade mantém ainda parcerias em atividades comunitárias e cívicas, como Natal Solidário, campanhas de educação ambiental e comunitárias em colaboração com outras entidades filantrópicas do município. </p>

            </div>

        </div>

    </div>



    
</body>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>