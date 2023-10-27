papelArray = ["LOBINHO", "ADMINISTRADOR", "CHEFE"];
 var idUsuario;
function findUsuario(BASEURL, idUsu) {
idUsuario = idUsu;
    buscar = document.getElementById("buscar");
    input = buscar.value;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "UsuarioController.php?action=findIt&word=" + input + "&isAjax=true", true);

    //* verifica se está preparado ou não. Quando está preparado, recebe o retorno em JSON e o transforma em um array.
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var retorno = xhttp.responseText;
            var usuarioArray = JSON.parse(retorno);

            removeChildren({parentId:'card-pai',childName:'card'});
            createChildren(usuarioArray, BASEURL);
        }
    }
    xhttp.send();

}

function removeChildren(params) {
    var parentId = params.parentId;
    var childName = params.childName;
    var pai = document.getElementById(parentId);

    var childNodesToRemove = pai.getElementsByClassName(childName);
    for(var i=childNodesToRemove.length-1;i >= 0;i--){
        var childNode = childNodesToRemove[i];
        childNode.parentNode.removeChild(childNode);
    }
}

function createChildren(usuarioArray, BASEURL) {
    divPai = document.getElementById("card-pai");

    if(usuarioArray.length < 1) {
        a = document.createElement("a");
        a.className = "card";
        a.innerHTML = "Nenhum usuário encontrado, tente novamente.";
        divPai.appendChild(a);
        return;
    }
    usuarioArray.forEach(element => {
        if(idUsuario == element["idUsuario"]) {
            return;
        }
        div = document.createElement("div");
        div.className = "card my-2 mx-2";
        div.style = "width: 18rem;";
        divPai.appendChild(div);

        insideDiv = document.createElement("div");
        insideDiv.className = "card-body";
        div.appendChild(insideDiv);

        h5 = document.createElement("h5");
        h5.className = "card-title";
        h5.innerHTML = element["nome"];
        insideDiv.appendChild(h5);
    
        hr = document.createElement("hr");
        insideDiv.appendChild(hr);
        
        gmail = document.createElement("p");
        gmail.className = "card-text";
        gmail.innerHTML = "aqui vai o gmail"; //element['email'];
        insideDiv.appendChild(gmail);

        papel = document.createElement("p");
        papel.className = "card-text";
        insideDiv.appendChild(papel);

        select = document.createElement("select");
        select.className = "form-control selecPapel";
        select.id = "papel" + element["idUsuario"];
        select.setAttribute("onchange", "sendChange(5, "+element['idUsuario']+");");
        for(i = 0; i < 3; i++) {
            option = document.createElement("option");
            option.value = papelArray[i];
            option.innerHTML += papelArray[i];
            if(papelArray[i] == element["papel"]) {
                option.selected = true;
            }
            select.appendChild(option);
        }
        papel.appendChild(select);

        statusUsu = document.createElement("p");
        statusUsu.className = "card-text";
        insideDiv.appendChild(statusUsu);
        
        a = document.createElement("a");

        if(element["status"] == "ATIVO") {
            a.id = "status";
            a.className = "btn btn-outline-success";
            a.setAttribute("onclick", "sendChange(1, "+element["idUsuario"]+");");
            a.innerHTML = "ATIVO";
        }
        
        else if(element["status"] == "INATIVO") {
            a.id = "status";
            a.className = "btn btn-outline-danger";
            a.setAttribute("onclick", "sendChange(0, "+element["idUsuario"]+");");
            a.innerHTML = "INATIVO";    
        }
        statusUsu.appendChild(a);

        matilha = document.createElement("p");
        matilha.className = "card-text";
        insideDiv.appendChild(matilha);

        button = document.createElement("button");
        button.id = element["idUsuario"];

        if(element["idMatilha"] != null) { 
            button.className = "btn btn-secondary"; 
            button.setAttribute("onclick", "findTheMatilhas("+element["idMatilha"] +
            ", 'list', "+element["idUsuario"]+")");
            button.innerHTML = element["matilha"]["nome"];
        }
        else { 
            button.className = "btn btn-warning";
            button.setAttribute("onclick", "findTheMatilhas(0, 'list', "+element["idUsuario"]+")"); 
            button.innerHTML = "Sem matilha";
        }
        matilha.appendChild(button);
    });
}