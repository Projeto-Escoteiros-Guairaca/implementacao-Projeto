<?php

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../controller/LinkController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../matilha/selectMatilha.php");

?>

<div>
<p><h1> Você está tentando entrar no sistema sem ter uma sessão aberta. Faça log-in na página ou registre-se se for novo aqui! </h1> </p>
<br>
</div>
<div>       <a class="" href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a></div>
     
<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>