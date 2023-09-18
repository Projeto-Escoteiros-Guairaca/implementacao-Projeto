papelArray = ["LOBINHO", "ADMINISTRADOR", "CHEFE"];
function findUsuario(BASEURL) {

    buscar = document.getElementById("buscar");
    input = buscar.value;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "UsuarioController.php?action=findIt&word=" + input, true);

    //* verifica se está preparado ou não. Quando está preparado, recebe o retorno em JSON e o transforma em um array.
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var retorno = xhttp.responseText;
            var usuarioArray = JSON.parse(retorno);

            
            removeChildren({parentId:'usuarioTable',childName:'usuarioLinha'});
            createChildren(usuarioArray, BASEURL);
        }
    }
    xhttp.send();

}

function removeChildren(params) {
    var parentId = params.parentId;
    var childName = params.childName;

    var childNodesToRemove = document.getElementById(parentId).getElementsByClassName(childName);
    for(var i=childNodesToRemove.length-1;i >= 0;i--){
        var childNode = childNodesToRemove[i];
        childNode.parentNode.removeChild(childNode);
    }
}

function createChildren(usuarioArray, BASEURL) {
    tabela = document.getElementById('usuarioTable');
 
    usuarioArray.forEach(element => {
        var linha = tabela.insertRow();
        linha.className = "usuarioLinha";
    
        nome = linha.insertCell();
        nome.innerHTML += element["nome"];
        nome.className = "usuarioLinha";
        
        login = linha.insertCell();
        login.innerHTML += element["login"];
        login.className = "usuarioLinha";

        papelLinha = linha.insertCell();

        select = document.createElement("select");
        select.className = "form-control selecPapel";
        select.id = element["idUsuario"];
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
        papelLinha.appendChild(select);
        
        ativo = linha.insertCell();

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
        ativo.appendChild(a);

        alcateia = linha.insertCell();
        button = document.createElement("button");
        button.id = element["idUsuario"];

        if(element["idAlcateia"] != null) { 
            button.className = "btn btn-secondary"; 
            button.setAttribute("onclick", "findTheAlcateias("+element["idAlcateia"] +
            ", 'list', "+element["idUsuario"]+")");
            button.innerHTML = element["alcateia"]["nome"];
        }
        else { 
            button.className = "btn btn-warning";
            button.setAttribute("onclick", "findTheAlcateias(0, 'list', "+element["idUsuario"]+")"); 
            button.innerHTML = "Sem alcateia";
        }

        
        alcateia.appendChild(button);

    });

}