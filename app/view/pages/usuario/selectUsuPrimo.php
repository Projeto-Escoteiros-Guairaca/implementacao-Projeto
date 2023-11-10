<?php
    
class SelectUsuPrimo{

    public static function desenhaSelect($primos, $name, $id, $idUsuPrimoSelec=0) {
        echo "<select class='form-control' name=' ". $name ." ' id=' ".$id." '>";
            echo "<option value=''></option>";
        foreach($primos as $primo):
            echo "<option value=' " .$primo->getId(). " '";
            if($primo->getId() == $idUsuPrimoSelec){
                echo " selected ";
            }
            echo ">". $primo->getNome()."</option>";
        endforeach;

        echo "</select>";
    }


}