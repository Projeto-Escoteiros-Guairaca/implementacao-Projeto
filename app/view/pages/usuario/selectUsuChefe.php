<?php
    
class SelectUsuChefe{

    public static function desenhaSelect($usuarios, $name, $id, $idUsuChefeSelec=0) {
        echo "<select style='width:150px;' class='form-control' name='". $name ."' id=' ".$id." '>";
            echo "<option value=''></option>";
        foreach($usuarios as $usuario):
            echo "<option value=' " .$usuario->getId(). " '";
            if($usuario->getId() == $idUsuChefeSelec){
                echo " selected ";
            }
            echo ">". $usuario->getNome()."</option>";
        endforeach;

        echo "</select>";
    }


}