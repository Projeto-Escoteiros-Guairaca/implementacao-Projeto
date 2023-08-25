
var idSelectedAlcateia;
var AlcateiasAlreadyUsed = []; 

function usuarios(id, BASEURL) {
    idSelectedAlcateia = id;
    action = "findChefeAndPrimo";
    if(AlcateiasAlreadyUsed.includes(id) == true) {
        eliminate();
    }
    else {

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "AlcateiaController.php?action=" + action + "&idAlcateia=" + id, true);
  
    //* verifica se está preparado ou não. Quando está preparado, recebe o retorno em JSON e o transforma em um array.
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var retorno = xhttp.responseText;
            var usuarioArray = JSON.parse(retorno);
            var primoExists = "Sem primo";
                tabela = document.getElementById("tabAlcateias " + id);

                if(usuarioArray.length > 1) {
                    primoExists = usuarioArray[1]["nome"];
                }
                


                    var linha = tabela.insertRow();
                    linha.className = "infoDaTabela"+id;
                    papelChefe = linha.insertCell();
                    papelChefe.innerHTML += "<b> Chefe: </b>";
                    papelChefe.className = "infoDaTabela"+id;

                    papelPrimo = linha.insertCell();
                    papelPrimo.innerHTML = "<b> Primo: </b>";
                    papelPrimo.className = "infoDaTabela"+id;

                    usuario = linha.insertCell();
                    usuario.innerHTML = "<b> Usuarios: </b>";
                    usuario.className = "infoDaTabela"+id;

                    
                    var linha = tabela.insertRow();
                    linha.className = "infoDaTabela"+id;
                    nomeChefe = linha.insertCell();
                    nomeChefe.innerHTML += usuarioArray[0]["nome"];
                    nomeChefe.className = "infoDaTabela"+id;

                    nomePrimo = linha.insertCell();
                    nomePrimo.innerHTML = primoExists;
                    nomePrimo.className = "infoDaTabela"+id;
                    
                    
                    a = document.createElement("a");
                    a.className = "btn btn-success";
                    a.innerHTML = "lista de usuários";
                    a.href= BASEURL+"/controller/UsuarioController.php?action=listUsuariosByAlcateia&idAlcateia="+idSelectedAlcateia;

                    listaUsuarios = linha.insertCell();
                    listaUsuarios.className = "infoDaTabela"+id;
                    listaUsuarios.appendChild(a);
            AlcateiasAlreadyUsed.push(id);
        };
    }

    xhttp.send();
    }
}

function eliminate() {
    removeElementsByClass("infoDaTabela"+idSelectedAlcateia);
    index = AlcateiasAlreadyUsed.indexOf(idSelectedAlcateia);
    AlcateiasAlreadyUsed.splice(index, 1);
}

function removeElementsByClass(className){
    const elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}

