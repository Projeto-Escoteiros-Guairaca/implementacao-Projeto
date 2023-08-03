const body = document.body;

const menuBackground = document.createElement("div");
menuBackground.className = "menu-background";
menuBackground.id = "menuBackground";
function abrir_nav(){
   
    body.appendChild(menuBackground);

    document.getElementById("menu_oculto").style.width="40vw";
    document.getElementById("principal").style.width="40vw";

}
menuBackground.addEventListener("click", () => {
  fechar_nav();
});
function fechar_nav(){
  body.removeChild(menuBackground);

    document.getElementById("menu_oculto").style.width="0";
    document.getElementById("menu_oculto").style.width="0";

}

var darkButton = document.querySelector('#dark-mode');

darkButton.addEventListener('click', () => {
  body.classList.toggle('modo-escuro');
  if(darkButton.getAttribute('class') == 'btn btn-outline-light'){
    darkButton.removeAttribute('class');
    darkButton.setAttribute('class', 'btn btn-light');
    darkButton.style.color = 'black';
    darkButton.innerHTML = 'Modo Claro';
    localStorage.setItem('modo-escuro', 'true');
  }
  else{
    darkButton.removeAttribute('class');
    darkButton.setAttribute('class', 'btn btn-outline-light');
    darkButton.style.color = 'white';
    darkButton.innerHTML = 'Modo Escuro';
    localStorage.setItem('modo-escuro', 'false');
  }
});
function carregar_modo(){
  if(localStorage.getItem('modo-escuro') == 'true'){
    body.classList.toggle('modo-escuro');
    darkButton.removeAttribute('class');
    darkButton.setAttribute('class', 'btn btn-light');
    darkButton.style.color = 'black';
    darkButton.innerHTML = 'Modo Claro';
  }
  else{
    darkButton.removeAttribute('class');
    darkButton.setAttribute('class', 'btn btn-outline-light');
    darkButton.style.color = 'white';
    darkButton.innerHTML = 'Modo Escuro';
  }
}