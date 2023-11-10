let MatilhasAlreadyUsed = [];
let idMatilhaUsuario = 0;
let UsuarioId= 0;
var chefeChangeMatilha = false;
// const body = document.body;

function findTheMatilhas(id = 0, action, idUsu) {
    idMatilhaUsuario = id;
    UsuarioId= idUsu;
    if(MatilhasAlreadyUsed.length == 0) {   
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "MatilhaController.php?action=" + action + "&sendMatilhas=true" + "&isAjax=true", true);  
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var retorno = xhttp.responseText;
                var MatilhasArray = JSON.parse(retorno);
                MatilhasAlreadyUsed = MatilhasArray;
                createModal(MatilhasArray);
            }
        }
        xhttp.send();
    }
    else {
        createModal(MatilhasAlreadyUsed);
    }
}

function createModal(Matilhas) {
    id = idMatilhaUsuario;

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
    h2.innerHTML = "Escolha a nova matilha";
    form.appendChild(h2);
        
    i = 0;
    Matilhas.forEach(element => {
        const br = document.createElement("br");
        const radio = document.createElement("input");
        radio.type = "radio";
        radio.className = "matilhas";
        radio.name = "matilhas";

        const{ id_matilha } = Matilhas[i];
        const{ nome } = Matilhas[i];

        radio.setAttribute("id", nome);
        radio.setAttribute("value",id_matilha); 

        if(radio.value == idMatilhaUsuario) {
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
    submitData.setAttribute("onclick", "sendMatilhaChange()");
    submitData.innerHTML = "Mudar matilha";
    submitData.className = "btn_mudar_matilha";
    form.appendChild(br2);
    form.appendChild(submitData);
    modal.appendChild(form);

    modalBackground.addEventListener("click", () => {
        body.removeChild(modalBackground);
        body.removeChild(modal);

    });
}

function sendMatilhaChange() {
        event.preventDefault();
    

    action = "changeMatilha";
    idMatilhaUsuario = id;    
    var checked = document.querySelector('[name="matilhas"]:checked');
    var matilhaId = checked.value;
    var matilhaName = checked.id;

    if(matilhaId == idMatilhaUsuario) {
        alert("Esse lobinho já está nessa matilha!");
        return;
    }

    var xhttp = new XMLHttpRequest();   
    xhttp.open("GET", "UsuarioController.php?action=" + action + "&id=" + UsuarioId+ "&idMatilha=" + matilhaId + '&chefeChangeMatilha' + chefeChangeMatilha +'&isAjax=true', true);
    
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == XMLHttpRequest.DONE && xhttp.status == 200) {
            response = xhttp.responseText;

            if(response != "nope") {
                chefeChangeMatilha = false;
                changeMatilhaCorrectly(matilhaName, matilhaId);
            }
            else {
                askChangeChefe(response);
            }
            
            
        }
    };
    xhttp.send();
}

function askChangeChefe() {
    chefeChangeMatilha = confirm("Tem certeza que quer mudar o chefe desta matilha? A antiga será deixada sem chefe.");
    if(chefeChangeMatilha == true) {
        chefeChangeMatilha = "true";
        sendMatilhaChangeChefe();
    }
    else {
        chefeChangeMatilha = false;
        return;
    }
    
}

function sendMatilhaChangeChefe() {
    
action = "changeMatilha";
idMatilhaUsuario = id;    
var checked = document.querySelector('[name="matilhas"]:checked');
var matilhaId = checked.value;
var matilhaName = checked.id;

if(matilhaId == idMatilhaUsuario) {
    alert("Esse lobinho já está nessa matilha!");
    return;
}

var xhttp = new XMLHttpRequest();
xhttp.open("GET", "UsuarioController.php?action=" + action + "&id=" + UsuarioId+ "&idMatilha=" + matilhaId + '&chefeChangeMatilha=' + chefeChangeMatilha + '&isAjax=true', true);

xhttp.onreadystatechange = function() {
    if (xhttp.readyState == XMLHttpRequest.DONE && xhttp.status == 200) {
        response = xhttp.responseText;

        if(response == null) {
            changeMatilhaCorrectly(matilhaName, matilhaId)
        }
        changeMatilhasChefes(response, matilhaName, matilhaId);
    }
};
xhttp.send();
}

function changeMatilhasChefes(idUsuarioToChange, matilhaName, matilhaId) {
    modalBackground = document.getElementById('modalBackground');
    modal = document.getElementById(idMatilhaUsuario +"modal");
    body.removeChild(modalBackground);
    body.removeChild(modal);

    var changeMatilhaName = document.getElementById(UsuarioId);
    var changeMatilhaToNull = document.getElementById(idUsuarioToChange);

    changeMatilhaName.innerHTML = matilhaName;
    changeMatilhaName.setAttribute("onclick", "findTheMatilhas("+ matilhaId +", 'list', "+UsuarioId+");");
    changeMatilhaName.className = "btn btn-secondary";

    changeMatilhaToNull.className = "btn btn-warning";
    changeMatilhaToNull.setAttribute("onclick", "findTheMatilhas(0, 'list', "+idUsuarioToChange+")"); 
    changeMatilhaToNull.innerHTML = "Sem matilha";

}

function changeMatilhaCorrectly(matilhaName, matilhaId) {
    modalBackground = document.getElementById('modalBackground');
    modal = document.getElementById(idMatilhaUsuario +"modal");
    body.removeChild(modalBackground);
    body.removeChild(modal);

    var changeMatilhaName = document.getElementById(UsuarioId);
    changeMatilhaName.innerHTML = matilhaName;
    changeMatilhaName.setAttribute("onclick", "findTheMatilhas("+ matilhaId +", 'list', "+UsuarioId+");");
    changeMatilhaName.className = "btn btn-secondary";
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
    
    statusButton = document.getElementById("status"+idUsu);
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

