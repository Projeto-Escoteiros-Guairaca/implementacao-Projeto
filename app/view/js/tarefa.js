// Adicione a lógica para capturar a div e salvar como imagem
document.querySelector('.save-button').addEventListener('click', () => {
    html2canvas(document.getElementById('img-holder')).then(function(canvas) {
        // Converte o canvas para um URL de dados
        var image = canvas.toDataURL('image/png');

        // Cria um link para o download
        var a = document.createElement('a');
        a.href = image;
        a.download = 'tarefa.png';
        a.click();
    });
});

document.querySelector('.save-video-button').addEventListener('click', () => {
    html2canvas(document.getElementById('video-holder')).then(function(canvas) {
        // Converte o canvas para um URL de dados
        var video = canvas.toDataURL('video/mp4');

        // Cria um link para o download
        var a = document.createElement('a');
        a.href = video;
        a.download = 'tarefa.mp4';
        a.click();
    });
});