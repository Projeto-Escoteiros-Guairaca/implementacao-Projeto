var idFrequenciaAtual;

function changeFrequencia(idFrequencia, changeStatus) {
    idFrequenciaAtual = idFrequencia;
    var xhttp = new XMLHttpRequest();

    xhttp.open("GET", "FrequenciaController.php?action=updateFrequencia&idFrequencia="+idFrequencia+"&status="+changeStatus+"&isForm=true", true);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var retorno = xhttp.responseText;
            console.log(retorno);
            changeButton(retorno);
        }
    }
    xhttp.send();
}

function changeButton(status) {
    button = document.getElementById('frequencia'+idFrequenciaAtual);

    if(status == 1) {
        button.innerHTML = "C";
        button.className = "btn btn-outline-success";
        button.setAttribute("onclick", "changeFrequencia('"+idFrequenciaAtual+"', '0')");
    }
    else {
        button.innerHTML = "F";
        button.className = "btn btn-outline-danger";
        button.setAttribute("onclick", "changeFrequencia('"+idFrequenciaAtual+"', '1')");
    }
    
}