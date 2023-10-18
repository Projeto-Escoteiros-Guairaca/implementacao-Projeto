<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

require_once(__DIR__ . "/../../controller/LinkController.php");
require_once(__DIR__ . "/../../model/enum/UsuarioPapel.php");

$_SESSION['callAccessToken'] = true;

if(session_status() !== PHP_SESSION_ACTIVE) 
{
    session_start();
}

$nome = "Entrar";
if(isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];


//Variável para validar o link
$linkCont = new LinkController();
$isChefe = $linkCont->usuarioPossuiPapel([UsuarioPapel::CHEFE]);
$isAdministrador = $linkCont->usuarioPossuiPapel([UsuarioPapel::ADMINISTRADOR]);
$isLobinho = $linkCont->usuarioPossuiPapel([UsuarioPapel::LOBINHO]);

if($isChefe == 1) {
  $_SESSION["chefeAlcateia"] = $_SESSION[SESSAO_USUARIO_IDALCATEIA];
}
else {
  $_SESSION["chefeAlcateia"] = "";
}
?>


<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/menu.css" />

<div class="container-fluid fixed-top px-0">


<div class="logo" style="padding: 5px; background: #1d7874">
  <a href="<?=BASEURL?>/controller/HomeController.php">
    <img src="<?= BASEURL ?>/view/pages/home/images/lobo-amarelo.png" alt="" height="100">
  </a>
</div>



<nav class="navbar navbar-expand-lg navbar-dark bg-sweg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-principal" aria-controls="navbar-principal" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-md-center" id="navbar-principal">
    <ul class="navbar-nav">
        <?php if($isAdministrador == 1){
                echo '<li class="nav-item">';
                echo "<a class='nav-link' href = '" .BASEURL. "/controller/AcessoController.php?controller=Usuario&action=list'>Lobinhos</a>";
                echo '</li>';
                echo '<li class="nav-item">';
                echo "<a class='nav-link' href = '" .BASEURL. "/controller/AcessoController.php?controller=Alcateia&action=listAlcateia'> Alcateias</";
                echo '</li>';
                echo '<li class="nav-item">';
                echo "<a class='nav-link' href = '" .BASEURL. "/controller/AcessoController.php?controller=Encontro&action=list'> Encontros</a>";
                echo '</li>';
                echo '<li class="nav-item">';
                echo "<a class='nav-link' href = '" .BASEURL. "/controller/AcessoController.php?controller=Atividade&action=list'> Atividades</a>";
                echo '</li>';
            }
            elseif($isLobinho == 1) {
                echo '<li class="nav-item">';
                echo "<a class='nav-link' href = '" .BASEURL. "/controller/AtividadeController.php'> Minhas Tarefas</a>";
                echo '</li>';
            }
            elseif($isChefe == 1) {
              echo '<li class="nav-item">';
              echo "<a class='nav-link' href = '" .BASEURL. "/controller/UsuarioController.php'>Lobinhos</a>";
              echo '</li>';
              echo '<li class="nav-item">';
              echo "<a class='nav-link' href = '" .BASEURL. "/controller/AlcateiaController.php'> Alcateias</";
              echo '</li>';
              echo '<li class="nav-item">';
              echo "<a class='nav-link' href = '" .BASEURL. "/controller/EncontroController.php'> Encontros</a>";
              echo '</li>';
              echo '<li class="nav-item">';
              echo "<a class='nav-link' href = '" .BASEURL. "/controller/AtividadeController.php'> Atividades</a>";
              echo '</li>';
          }
        ?>

        <?php
            if (isset($_SESSION[SESSAO_USUARIO_ID])){
                echo "<a class='nav-link' href='". BASEURL ."/controller/UsuarioController.php?action=profile&id=". 
                $_SESSION[SESSAO_USUARIO_ID] ."'><i class='bi bi-person navbar-icon'></i></a>";
            }
        ?>
      <li class="nav-item">
        <a id="dark-button" class="nav-link" href="#"><i id="dark-icon" class="bi bi-moon-stars navbar-icon"></i></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-arrow-through-heart navbar-icon"></i></a>
      </li>

      <?php
      if (isset($_SESSION[SESSAO_USUARIO_ID])){
        if ($_SESSION[SESSAO_USUARIO_ID] == 0){
            echo "<a class='nav-link' href = " .LOGIN_PAGE."> Login</a>";
            echo "<a class='nav-link' href = " .REGISTER_PAGE."> Registre-se</a>";
        }
        else {
            echo "<a class='nav-link' href = " .LOGOUT_PAGE."> Sair</a>";
        }
        if($nome != "Entrar"){
          echo "<a class='nav-link'>".$nome."</a>";
        }
      }
      else {
        echo "<a class='nav-link' href = " .LOGIN_PAGE."> Login</a>";
        echo "<a class='nav-link' href = " .REGISTER_PAGE."> Registre-se</a>";
      }
      ?>

    </ul>
  </div>
</nav> 


</div>
    