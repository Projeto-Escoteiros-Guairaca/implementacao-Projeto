<?php

class lobinhoSendedTarefa {
    public static function MostraTarefa($envioUsuario) {
        echo '
        <h3>Atividade Reenviada</h3>
        <hr>
        <p> Texto enviado </p>
        <textarea name="texto" disabled cols="30" rows="10">'.$envioUsuario->getArquivo()->getTexto().'</textarea>
        <hr>
        <p> Arquivo enviado </p>
        ';
        if($envioUsuario->getArquivo()->getNomeArquivo() == "Imagem") {
            echo '
                <img width="320" height="240" src="'.$envioUsuario->getArquivo()->getCaminhoArquivo().'"> </img>
            ';
        }
        else if($envioUsuario->getArquivo()->getNomeArquivo() == "Video") {
            echo '
                <video 
                    src="'.$envioUsuario->getArquivo()->getCaminhoArquivo().'" 
                    width="320" height="240" controls autoplay>
                </video>
                <p>Se não conseguir reproduzir o vídeo, <a href="'.BASEURL.'/view/pages/tarefa/download.php?file='.$envioUsuario->getArquivo()->getCaminhoArquivo().'" download>baixe aqui</a>.</p>
            ';
            echo $envioUsuario->getArquivo()->getCaminhoArquivo();
        }
        else{
            echo '<p> Nenhum arquivo enviado </p>';
        }
    }
}