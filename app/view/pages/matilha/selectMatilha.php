<?php
    
class SelectMatilha{

    public static function desenhaSelect($matilhas, $name,$id, $idMatilhaSelec=0) {
        echo "<select style='max-width:150px;' class='form-control' name='". $name ."' id='".$id."'>";
            echo "<option value=''></option>";
        foreach($matilhas as $matilha):
            echo "<option value='" .$matilha->getId_matilha(). "'";

            if($matilha->getId_matilha() == $idMatilhaSelec){
                echo " selected ";
            }

            echo ">". $matilha->getNome()."</option>";
        endforeach;

        echo "</select>";
    }


}