<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

require_once(__DIR__ . "/../../controller/LinkController.php");
require_once(__DIR__ . "/../../model/enum/UsuarioPapel.php");


if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
$nome = "Entrar";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
  $nome = $_SESSION[SESSAO_USUARIO_NOME];


//Variável para validar o link
$linkCont = new LinkController();
$isChefe = $linkCont->usuarioPossuiPapel([UsuarioPapel::CHEFE]);
$isAdministrador = $linkCont->usuarioPossuiPapel([UsuarioPapel::ADMINISTRADOR]);
$isLobinho = $linkCont->usuarioPossuiPapel([UsuarioPapel::LOBINHO]);

if ($isChefe == 1) {
  $_SESSION["chefeMatilha"] = $_SESSION[SESSAO_USUARIO_ID_MATILHA];
} else {
  $_SESSION["chefeMatilha"] = "";
}
?>


<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/menu.css" />

<div class="container-fluid px-0">

  <nav class="navbar navbar-expand-lg navbar-dark bg-sweg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-principal" aria-controls="navbar-principal" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
  

    <div id="navbar-principal" class="collapse navbar-collapse justify-content-md-center">

    <li class="nav-link">
      <a id="btn_voltar"class="nav-item" href="javascript:history.back()"><i class="bi bi-arrow-left navbar-icon "></i></a>
    </li>

      <ul class="navbar-nav">
        <?php if ($isAdministrador == 1) {
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Usuario&action=listUsuarios'>Lobinhos</a>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Alcateia&action=listAlcateias'> Alcateias</";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Encontro&action=listEncontros'> Encontros</a>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Atividade&action=listAtividades'> Atividades</a>";
          echo '</li>';
        } elseif ($isLobinho == 1) {
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Atividade&action=listAtividades'> Minhas Tarefas</a>";
          echo '</li>';
        } elseif ($isChefe == 1) {
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Usuario&action=listUsuarios'>Lobinhos</a>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Matilha&action=listMatilhas'> Matilhas</a>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Encontro&action=listEncontros'> Encontros</a>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Atividade&action=listAtividades'> Atividades</a>";
          echo '</li>';
        }
        
        ?>
         

        <?php
        if (isset($_SESSION[SESSAO_USUARIO_ID])) {
          echo "<a class='nav-link' href='" . BASEURL . "/controller/AcessoController.php?controller=Usuario&action=profile&id=" .
            $_SESSION[SESSAO_USUARIO_ID] . "'><i class='bi bi-person navbar-icon'></i></a>";
        }
        ?>
        
        <li class="nav-item">
          <a id="dark-button" class="nav-link" href="#"><i id="dark-icon" class="bi bi-moon-stars navbar-icon"></i></a>
        </li>



        <?php
        if (isset($_SESSION[SESSAO_USUARIO_ID])) {
          if ($_SESSION[SESSAO_USUARIO_ID] == 0) {
            echo "<a class='nav-link' href = " . LOGIN_PAGE . "> Login</a>";
            echo "<a class='nav-link' href = " . REGISTER_PAGE . "> Registre-se</a>";
          } else {
            echo "<a class='nav-link' href = " . LOGOUT_PAGE . "> Sair</a>";
          }
          if ($nome != "Entrar") {
            echo "<a class='nav-link'>" . $nome . "</a>";
          }
        } else {
          echo "<a class='nav-link' href = " . LOGIN_PAGE . "> Login</a>";
          echo "<a class='nav-link' href = " . REGISTER_PAGE . "> Registre-se</a>";
        }
        ?>

      </ul>
      <div class="logo">
        <a id ="id_logo"href="<?= BASEURL ?>/controller/HomeController.php">
          <img class="img_logo" src="<?= BASEURL ?>/view/pages/home/images/lobo-amarelo.png" alt="" height="100">
        </a>
      </div>
    </div>
    
  </nav>
  <script src="main.js"> </script>

</div>