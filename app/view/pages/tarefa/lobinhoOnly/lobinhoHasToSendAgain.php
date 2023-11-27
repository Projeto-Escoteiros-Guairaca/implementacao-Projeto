<?php

class lobinhoHasToSendAgain {
    
    public static function MostraTarefa($entregaUsuario) {
        echo '
        <form enctype="multipart/form-data" action="'.BASEURL.'/controller/TarefaController.php?action=updateEntrega&isForm=true&idArquivo='.$entregaUsuario->getArquivo()->getIdArquivo().'&idEntrega='.$entregaUsuario->getIdEntrega().'" method="POST">
        <h3>Encaminhe a tarefa refeita por aqui:</h3>
        <hr>
        <h6>Novos comentários nessa caixa abaixo</h6>
        <hr><textarea name="texto" class="form-control" cols="60" rows="10"></textarea>
        <hr>
        <h6>Novos arquivos nessa caixa abaixo</h6>
        <input  type="file" class="form-control" id="img" name="imagem" id="picture__input" accept="image/*, video/*, audio/*"/> 
        <br>
        <br>
        <button type="submit" class="btn_gravar">Enviar a tarefa de novo</button>
        </form>
        ';
    }
}