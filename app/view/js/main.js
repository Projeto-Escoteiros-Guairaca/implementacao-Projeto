const body = document.body;

const modalBackground = document.createElement("div");
modalBackground.className = "modal-background";
modalBackground.id = "modalBackground";
function abrir_nav(){
   
    body.appendChild(modalBackground);

    document.getElementById("menu_oculto").style.width="250px";
    document.getElementById("principal").style.width="250px";

}
modalBackground.addEventListener("click", () => {
  fechar_nav();
});
function fechar_nav(){
  body.removeChild(modalBackground);

    document.getElementById("menu_oculto").style.width="0";
    document.getElementById("menu_oculto").style.width="0";

}

var darkButton = document.querySelector('#dark-mode');

darkButton.addEventListener('click', () => {
  document.body.classList.toggle('modo-escuro');
  if(darkButton.getAttribute('class') == 'btn btn-outline-light'){
    darkButton.removeAttribute('class');
    darkButton.setAttribute('class', 'btn btn-light');
    darkButton.style.color = 'black';
  }
  else{
    darkButton.removeAttribute('class');
    darkButton.setAttribute('class', 'btn btn-outline-light');
    darkButton.style.color = 'white';
  }
});