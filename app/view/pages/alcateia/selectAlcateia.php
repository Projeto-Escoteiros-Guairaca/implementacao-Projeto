<?php
    
class SelectAlcateia{

    public static function desenhaSelect($alcateias, $name,$id, $idAlcateiaSelec=0) {
        echo "<select class='form-control' name='". $name ."' id='".$id."'>";

        foreach($alcateias as $alcateia):
            echo "<option value='" .$alcateia->getId_alcateia(). "'";

            if($alcateia->getId_alcateia() == $idAlcateiaSelec){
                echo " selected ";
            }

            echo ">". $alcateia->getNome()."</option>";
        endforeach;

        echo "</select>";
    }


}