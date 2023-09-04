<?php
    
class SelectPapeis{

    public static function desenhaSelect($usuarioSelected, $papeis, $name) {

        echo "<form action='". BASEURL ."/controller/UsuarioController.php?action=changePapel' method = 'POST'>";
            echo "<select style='max-width:150px;' class='form-control' name='". $name ."' >";

            foreach($papeis as $papel):

                echo "<option ";
                if($usuarioSelected->getPapeis() == $papel) {
                    echo "selected";
                }
                echo " value=' " .$papel. " '";
                echo ">". $papel."</option>";
                
            endforeach;

            echo "</select>";
        echo "</form>";
    }


}