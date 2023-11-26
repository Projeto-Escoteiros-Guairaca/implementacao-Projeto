<?php

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../controller/LinkController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../matilha/selectMatilha.php");

?>

<div>
<p><h1>Você está atualmente sem nenhuma Matilha ativa. Avise seu chefe para que este o insira na matilha correta. </h1> </p>
<br>
</div>
     
<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>