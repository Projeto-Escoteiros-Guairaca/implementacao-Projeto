<?php

class lobinhoSendedTarefa {
    public static function MostraTarefa($envioUsuario) {
        echo '
        <hr>
        <textarea name="texto" disabled cols="30" rows="10">'.$envioUsuario->getArquivo()->getTexto().'</textarea>
        <hr>
        <p> Aqui seu arquivo: </p>
        ';
        if($envioUsuario->getArquivo()->getNomeArquivo() == "Imagem") {
            echo '
                <img width="320" height="240" src="'.$envioUsuario->getArquivo()->getCaminhoArquivo().'"> </img>
            ';
        }
        else if($envioUsuario->getArquivo()->getNomeArquivo() == "Video") {
            echo '
                <video  width="320" height="240" controls> 
                <source src="'.$envioUsuario->getArquivo()->getCaminhoArquivo().'" type="video/.mp4">
                Este video não tem o formato aceitado pelo videoplayer. Por favor, baixe no seu computador e abra por um aplicativo.
                </video>
            ';
        }
    }
}
                            
                            //
                            
                            //  if(isset($dados['envioUsuario'])) {
                            //     echo ;
                            // }
                             
                            // if(isset($dados['envioUsuario'])) {
                            //     echo "aqui seu arkivo:";
                            
                            // }
                            // else {

                            //     echo "<h3>passe por aqui os arquivos!</h3>
                            
                            //     <input  type='file' id='img' name='imagem' id='picture__input' accept='image/*, video/*'/> 
                            //     <br>
                            //     <button type='submit' class='btn btn-success'>Enviar tarefa</button>";
                            // }