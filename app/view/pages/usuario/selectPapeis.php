<?php
    
class SelectPapeis{

    public static function desenhaSelect($usuarioSelected, $papeis, $name) {
        $papelEmNumero = 5;

            echo "<select id='".$usuarioSelected->getId()."' style='max-width:150px;' onChange='sendChange(".$papelEmNumero.", ".
            $usuarioSelected->getId().");' class='form-control selecPapel' name='". $name ."' >";

            foreach($papeis as $papel):

                echo "<option ";
                if($usuarioSelected->getPapeis() == $papel) {
                    echo "selected";
                }
                echo " value=' " .$papel. " '";
                echo ">". $papel."</option>";
                
            endforeach;

            echo "</select>";
    }


}