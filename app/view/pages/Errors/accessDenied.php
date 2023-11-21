<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../controller/LinkController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../matilha/selectMatilha.php");

?>

<h1>Parece que você tentou entrar em uma página sem o acesso correspondente. Por favor, não tente entrar 
    onde não é bem-vindo outra vez.
</h1>
<br>
            <a class="" 
                href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>