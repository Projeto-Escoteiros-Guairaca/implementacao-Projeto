
var idSelectedMatilha;
var MatilhasAlreadyUsed = []; 

function usuarios(id, BASEURL) {
    idSelectedMatilha = id;
    action = "findChefeAndPrimo";
    if(MatilhasAlreadyUsed.includes(id) == true) {
        eliminate();
    }
    else {

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "MatilhaController.php?action=" + action + "&idMatilha=" + id, true);
  
    //* verifica se está preparado ou não. Quando está preparado, recebe o retorno em JSON e o transforma em um array.
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var retorno = xhttp.responseText;
            var usuarioArray = JSON.parse(retorno);
            var primoExists = "Sem primo";
            if(usuarioArray.length > 1) {
                primoExists = usuarioArray[1]["nome"];
            }
                

            const modalBackground = document.createElement("div");
            modalBackground.className = "modal-background";
            modalBackground.id = "modalBackground";
            
            const modal = document.createElement("div");
            modal.className = "modal";
            modal.name = "modal";
            modal.setAttribute("id", id +"modal");
        
            body.appendChild(modalBackground);
            body.appendChild(modal);
            const h2 = document.createElement("h2");
            h2.innerHTML = "";
            modal.appendChild(h2);
                
            a = document.createElement("a");
            a.className = "btn btn-success";
            a.innerHTML = "lista de usuários";
            a.href= BASEURL+"/controller/AcessoController.php?controller=Usuario&action=listUsuariosByMatilha&idMatilha="+idSelectedMatilha;
            MatilhasAlreadyUsed.push(id);

            modalBackground.addEventListener("click", () => {
                body.removeChild(modalBackground);
                body.removeChild(modal);
        
            });
        };
    }

    xhttp.send();
    }
}

function eliminate() {
    removeElementsByClass("infoDaTabela"+idSelectedMatilha);
    index = MatilhasAlreadyUsed.indexOf(idSelectedMatilha);
    MatilhasAlreadyUsed.splice(index, 1);
}

function removeElementsByClass(className){
    const elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}

