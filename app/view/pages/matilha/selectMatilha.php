<?php
    
class SelectMatilha{

    public static function desenhaSelect($matilhas, $name,$id, $idMatilhaSelec=0) {
        echo "<select style='max-width:150px;' class='form-control' name='". $name ."' id='".$id."'>";
            echo "<option value=''></option>";
        foreach($matilhas as $matilha):
            echo "<option value='" .$matilha->getIdMatilha(). "'";

            if($matilha->getIdMatilha() == $idMatilhaSelec){
                echo " selected ";
            }

            echo ">". $matilha->getNomeMatilha()."</option>";
        endforeach;

        echo "</select>";
    }


}