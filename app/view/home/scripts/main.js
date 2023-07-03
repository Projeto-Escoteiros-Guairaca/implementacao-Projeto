function abrir_nav(){

    document.getElementById("menu_oculto").style.width="250px";
    document.getElementById("principal").style.width="250px";

}
function fechar_nav(){

    document.getElementById("menu_oculto").style.width="0";
    document.getElementById("menu_oculto").style.width="0";

}

document.querySelector('#modo-escuro').addEventListener('click', () => {
  document.body.classList.toggle('modo-escuro');
});
