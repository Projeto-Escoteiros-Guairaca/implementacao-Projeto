<?php

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../controller/AcessoController.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../alcateia/selectAlcateia.php");

?>
 
<p>YOU ARE OUT OF UNIFORM, SOLDIER! WHERE IS YOUR POWER ARMOR?</p>

<p>DON'T HAVE ANY?</p>

<p>YOU EXPECT ME TO BELIEVE THAT, MAGGOT?</p>

<p>THE TRUTH IS YOU LOST AN EXPENSIVE PIECE OF ARMY-ISSUE EQUIPMENT.</p>

<p>THAT SUIT IS GOING TO COME OUT OF YOUR PAY</p>

<p>AND YOU WILL REMAIN IN THIS MANS ARMY UNTIL YOU ARE FIVE HUNDRED AND TEN YEARS OLD</p>

<p>WHICH IS THE NUMBER OF YEARS IT WILL TAKE FOR YOU TO PAY FOR A</p>

<p>MARK II POWERED COMBAT ARMOR YOU HAVE LOST!</p>

<p> REPORT TO THE ARMORY AND HAVE A NEW SUIT ISSUED TO YOU, THEN REPORT BACK TO ME, PRIVATE!
DISMISSED!</p>
            <a class="btn btn-success" 
                href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>