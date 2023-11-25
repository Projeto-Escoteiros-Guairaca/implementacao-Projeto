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
                <div id="img-holder">
                    <img width="320" height="240" src="'.$envioUsuario->getArquivo()->getCaminhoArquivo().'"> </img>
                </div>
                <button class="btn btn-success save-button">Baixar imagem</button>
            ';
        }
        else if($envioUsuario->getArquivo()->getNomeArquivo() == "Video") {
            echo '
                <div id="video-holder"> 
                    <video  width="320" height="240" controls>
                        <source src="'.$envioUsuario->getArquivo()->getCaminhoArquivo().'" type="video/.mp4">
                        Este video não tem o formato aceitado pelo videoplayer. Por favor, baixe no seu computador e abra por um aplicativo.
                    </video>
                </div>
                <button class="btn btn-success save-video-button">Baixar video</button>
            ';
        }
    }
}