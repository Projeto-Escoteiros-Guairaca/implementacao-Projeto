<?php

class lobinhoHasToSendAgain {
    
    public static function MostraTarefa($entregaUsuario) {
        echo '
        <form enctype="multipart/form-data" action="'.BASEURL.'/controller/TarefaController.php?action=updateEntrega&isForm=true&idEntrega='.$entregaUsuario->getIdEntrega().'" method="POST">
        <h3>Escreva aqui os novo detalhes que precisar:</h3>
        <hr>
        <hr><textarea name="texto" cols="30" rows="10"></textarea>
        <hr>
        <h3>passe por aqui os novos arquivos!</h3>
        <input  type="file" id="img" name="imagem" id="picture__input" accept="image/*, video/*"/> 
        <br>
        <input type="hidden" name="idArquivo" value="'.$entregaUsuario->getArquivo()->getIdArquivo().'">
        <button type="submit" class="btn btn-success">Enviar a tarefa de novo</button>
        </form>
        ';
    }
}