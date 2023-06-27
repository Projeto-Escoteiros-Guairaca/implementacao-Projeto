
var idFull; //guarda o id encontrado como variavel global para ser utilizada em outras funções
var AlcateiasAlreadyUsed = []; // array usada para guardar as alcateias já abertas.

function usuarios(id, action) {
    idFull = id;

    //* if e else definem se deve ser fechado ou aberto a lista de usuários
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
            
                tabela = document.getElementById("tabAlcateias " + id);
                for(var i=0; i<usuarioArray.length; i++) {
                    //* Cria as linhas da tabela para cada elemento do array, adiciona uma classe generica com o ID da alcateia específica
                    //* assim, podemos encontrar os usuarios exatos para eliminar as linhas depois.
        
                    var linha = tabela.insertRow();
                    linha.className = "usuariosdatabela"+id;
                    nome = linha.insertCell();
                    nome.innerHTML = usuarioArray[i].nome;
                    nome.className = "usuariosdatabela"+id;

                    celular = linha.insertCell();
                    celular.innerHTML = usuarioArray[i].celular;
                    celular.className = "usuariosdatabela"+id;

                    email = linha.insertCell();
                    email.innerHTML = usuarioArray[i].email;
                    email.className = "usuariosdatabela"+id;

                    button = linha.insertCell().innerHTML = "<button class='btn btn-secondary usuariosdatabela"+id+"'>Alterar sua alcateia</button>";
                    button.className="usuariosdatabela"+id;
                }
            AlcateiasAlreadyUsed.push(id);
            console.log(AlcateiasAlreadyUsed);
        };
    }

    xhttp.send();
    }
}

function eliminate() {
    removeElementsByClass("usuariosdatabela"+idFull);
    index = AlcateiasAlreadyUsed.indexOf(idFull);
    AlcateiasAlreadyUsed.splice(index, 1);
}

function removeElementsByClass(className){
    const elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}