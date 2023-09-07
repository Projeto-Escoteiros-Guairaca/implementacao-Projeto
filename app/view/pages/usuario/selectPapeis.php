<?php
    
class SelectPapeis{

    public static function desenhaSelect($usuarioSelected, $papeis, $name) {

        echo "<form action='". BASEURL ."/controller/UsuarioController.php?action=changePapel&id=".
            $usuarioSelected->getId()."' method = 'POST'>";
            echo "<select style='max-width:150px;' class='form-control selecPapel' name='". $name ."' >";

            foreach($papeis as $papel):

                echo "<option ";
                if($usuarioSelected->getPapeis() == $papel) {
                    echo "selected";
                }
                echo " value=' " .$papel. " '";
                echo ">". $papel."</option>";
                
            endforeach;

            echo "</select>";
            echo "<button type='submit' class='btn btn-primary btnPapel'>Alterar</button>";
        echo "</form>";
    }


}