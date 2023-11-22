<?php

class lobinhoDidNotSend {
    public static function MostraFormulario() {
        echo '
        <form enctype="multipart/form-data" action="'.BASEURL.'/controller/TarefaController.php?action=addTarefa&isForm=true" method="POST">
                    <h3>Escreva aqui qualquer detalhe que precises:</h3>
        <hr><textarea name="texto"cols="30" rows="10"></textarea>
        <hr>
        <h3>passe por aqui os novos arquivos!</h3>
        <input  type="file" id="img" name="imagem" id="picture__input" accept="image/*, video/*"/> 
        <br>
        <button type="submit" class="btn btn-success">Enviar tarefa</button>
        </form>
        ';
        
    }
}