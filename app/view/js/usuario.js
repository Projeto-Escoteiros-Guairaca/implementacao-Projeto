let AlcateiasAlreadyUsed = [];
let idAlcateiaUsuario = 0;
let UsuarioId= 0;
var chefeChangeAlcateia = false;
// const body = document.body;

function findTheAlcateias(id = 0, action, idUsu) {
    idAlcateiaUsuario = id;
    UsuarioId= idUsu;
    if(AlcateiasAlreadyUsed.length == 0) {   
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "AlcateiaController.php?action=" + action + "&sendAlcateias=true" + "&isAjax=true", true);  
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var retorno = xhttp.responseText;
                var AlcateiasArray = JSON.parse(retorno);
                AlcateiasAlreadyUsed = AlcateiasArray;
                createModal(AlcateiasArray);
            }
        }
        xhttp.send();
    }
    else {
        createModal(AlcateiasAlreadyUsed);
    }
}

function createModal(Alcateias) {
    id = idAlcateiaUsuario;

    const modalBackground = document.createElement("div");
    modalBackground.className = "modal-background";
    modalBackground.id = "modalBackground";
    
    const modal = document.createElement("div");
    modal.className = "modal";
    modal.name = "modal";
    modal.setAttribute("id", id +"modal");

    body.appendChild(modalBackground);
    body.appendChild(modal);

    const form = document.createElement("form");
    const h2 = document.createElement("h2");
    h2.innerHTML = "Escolha a nova alcateia";
    form.appendChild(h2);
        
    i = 0;
    Alcateias.forEach(element => {
        const br = document.createElement("br");
        const radio = document.createElement("input");
        radio.type = "radio";
        radio.className = "alcateias";
        radio.name = "alcateias";

        const{ id_alcateia } = Alcateias[i];
        const{ nome } = Alcateias[i];

        radio.setAttribute("id", nome);
        radio.setAttribute("value",id_alcateia); 

        if(radio.value == idAlcateiaUsuario) {
            radio.checked = true;
        }
        const label = document.createElement("label");
        label.setAttribute("for", nome);
        label.innerHTML = nome;
        
        form.appendChild(br);
        form.appendChild(radio);      
        form.appendChild(label);

        i++;
});
    const br2 = document.createElement("br");
    const submitData = document.createElement("button");
    submitData.setAttribute("onclick", "sendAlcateiaChange()");
    submitData.innerHTML = "Mudar alcateia";
    submitData.className = "btn_mudar_alcateia";
    form.appendChild(br2);
    form.appendChild(submitData);
    modal.appendChild(form);

    modalBackground.addEventListener("click", () => {
        body.removeChild(modalBackground);
        body.removeChild(modal);

    });
}

function sendAlcateiaChange() {
        event.preventDefault();
    

    action = "changeAlcateia";
    idAlcateiaUsuario = id;    
    var checked = document.querySelector('[name="alcateias"]:checked');
    var alcateiaId = checked.value;
    var alcateiaName = checked.id;

    if(alcateiaId == idAlcateiaUsuario) {
        alert("Esse lobinho já está nessa alcateia!");
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "UsuarioController.php?action=" + action + "&id=" + UsuarioId+ "&idAlcateia=" + alcateiaId + '&chefeChangeAlcateia' + chefeChangeAlcateia +'&isAjax=true', true);
    
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == XMLHttpRequest.DONE && xhttp.status == 200) {
            response = xhttp.responseText;

            if(response != "nope") {
                chefeChangeAlcateia = false;
                changeAlcateiaCorrectly(alcateiaName, alcateiaId);
            }
            else {
                askChangeChefe(response);
            }
            
            
        }
    };
    xhttp.send();
}

function askChangeChefe() {
    chefeChangeAlcateia = confirm("Tem certeza que quer mudar o chefe desta alcateia? A antiga será deixada sem chefe.");
    if(chefeChangeAlcateia == true) {
        chefeChangeAlcateia = "true";
        sendAlcateiaChangeChefe();
    }
    else {
        chefeChangeAlcateia = false;
        return;
    }
    
}

function sendAlcateiaChangeChefe() {
    
action = "changeAlcateia";
idAlcateiaUsuario = id;    
var checked = document.querySelector('[name="alcateias"]:checked');
var alcateiaId = checked.value;
var alcateiaName = checked.id;

if(alcateiaId == idAlcateiaUsuario) {
    alert("Esse lobinho já está nessa alcateia!");
    return;
}

var xhttp = new XMLHttpRequest();
xhttp.open("GET", "UsuarioController.php?action=" + action + "&id=" + UsuarioId+ "&idAlcateia=" + alcateiaId + '&chefeChangeAlcateia=' + chefeChangeAlcateia + '&isAjax=true', true);

xhttp.onreadystatechange = function() {
    if (xhttp.readyState == XMLHttpRequest.DONE && xhttp.status == 200) {
        response = xhttp.responseText;

        if(response == null) {
            changeAlcateiaCorrectly(alcateiaName, alcateiaId)
        }
        changeAlcateiasChefes(response, alcateiaName, alcateiaId);
    }
};
xhttp.send();
}

function changeAlcateiasChefes(idUsuarioToChange, alcateiaName, alcateiaId) {
    modalBackground = document.getElementById('modalBackground');
    modal = document.getElementById(idAlcateiaUsuario +"modal");
    body.removeChild(modalBackground);
    body.removeChild(modal);

    var changeAlcateiaName = document.getElementById(UsuarioId);
    var changeAlcateiaToNull = document.getElementById(idUsuarioToChange);

    changeAlcateiaName.innerHTML = alcateiaName;
    changeAlcateiaName.setAttribute("onclick", "findTheAlcateias("+ alcateiaId +", 'list', "+UsuarioId+");");
    changeAlcateiaName.className = "btn btn-secondary";

    changeAlcateiaToNull.className = "btn btn-warning";
    changeAlcateiaToNull.setAttribute("onclick", "findTheAlcateias(0, 'list', "+idUsuarioToChange+")"); 
    changeAlcateiaToNull.innerHTML = "Sem alcateia";

}

function changeAlcateiaCorrectly(alcateiaName, alcateiaId) {
    modalBackground = document.getElementById('modalBackground');
    modal = document.getElementById(idAlcateiaUsuario +"modal");
    body.removeChild(modalBackground);
    body.removeChild(modal);

    var changeAlcateiaName = document.getElementById(UsuarioId);
    changeAlcateiaName.innerHTML = alcateiaName;
    changeAlcateiaName.setAttribute("onclick", "findTheAlcateias("+ alcateiaId +", 'list', "+UsuarioId+");");
    changeAlcateiaName.className = "btn btn-secondary";
}

function sendChange(toChange, idUsu) {
    var action;
    var papel = "";

    if(toChange == 0) {
        action = "updateToAtivo";
    }
    else if(toChange == 1) {
        action = "updateToInativo";
    }
    else {
        action = "changePapel";
        let select = document.getElementById("papel"+idUsu);
        papel = select.value;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "UsuarioController.php?action=" + action  + "&id=" + idUsu + "&newPapel=" + papel + '&isAjax=true', true)
    
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == XMLHttpRequest.DONE && xhttp.status == 200) {
            var retorno = xhttp.responseText;
            if(retorno == "ATIVO" || retorno == "INATIVO"){
                changeStatus(retorno, idUsu);
            }
            }
    };
    xhttp.send();
}

function changeStatus(retorno, idUsu) {
    
    statusButton = document.getElementById("status");
    statusButton.innerHTML = retorno;

    if(retorno == "ATIVO") {
        statusButton.className = "btn btn-outline-success";
        statusButton.setAttribute("onclick", "sendChange(1, "+idUsu+");");
    }
    else {
        statusButton.className = "btn btn-outline-danger";
        statusButton.setAttribute("onclick", "sendChange(0, "+idUsu+");");
    }
}

