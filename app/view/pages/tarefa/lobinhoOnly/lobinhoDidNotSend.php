<?php

class lobinhoDidNotSend {
    public static function MostraFormulario() {
        echo '
        <hr><textarea name="texto"cols="30" rows="10"></textarea>
        <hr>
        <h3>passe por aqui os arquivos!</h3>
        <input  type="file" id="img" name="imagem" id="picture__input" accept="image/*, video/*"/> 
        <br>
        <button type="submit" class="btn btn-success">Enviar tarefa</button>
        
        ';
        
    }
}