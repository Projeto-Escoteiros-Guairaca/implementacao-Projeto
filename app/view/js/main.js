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

var darkButton = document.querySelector('#dark-button');
var darkIcon = document.querySelector('#dark-icon');

darkButton.addEventListener('click', () => {
  body.classList.toggle('modo-escuro');
  if(darkIcon.getAttribute('class') == 'bi bi-moon-stars navbar-icon'){
    darkIcon.removeAttribute('class');
    darkIcon.setAttribute('class', 'bi bi-sun-fill navbar-icon');
    localStorage.setItem('modo-escuro', 'true');
  }
  else{
    darkIcon.removeAttribute('class');
    darkIcon.setAttribute('class', 'bi bi-moon-stars navbar-icon');
    localStorage.setItem('modo-escuro', 'false');
  }
});
function carregar_modo(){
  if(localStorage.getItem('modo-escuro') == 'true'){
    body.classList.toggle('modo-escuro');
    darkIcon.removeAttribute('class');
    darkIcon.setAttribute('class', 'bi bi-sun-fill navbar-icon');
  }
  else{
    darkIcon.removeAttribute('class');
    darkIcon.setAttribute('class', 'bi bi-moon-stars navbar-icon');
  }
}

window.addEventListener("scroll",function(){
  let header = document.querySelector('#navbar-principal')
  header.classList.toggle('rolagem',window.scrollY > 80)
})