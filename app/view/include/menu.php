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
        <a id="btn_voltar" class="nav-item" href= " "> <span data-tooltip='Voltar'><i class="bi bi-arrow-left navbar-icon "></i></span></a>
      </li>

      <ul class="navbar-nav">
        <?php if ($isAdministrador == 1) {
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Usuario&action=listUsuarios'><span data-tooltip='Abrir Lobinhos'><strong>Lobinhos</span></strong></a>";
          echo '</li>';


          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Alcateia&action=listAlcateias'> <span data-tooltip='Abrir Alcateias'><strong>Alcateias</strong></span>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Encontro&action=listEncontros'> <span data-tooltip='Abrir Encontros'><strong>Encontros</strong></span></a>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Atividade&action=listAtividades'> <span data-tooltip='Abrir Atividades'><strong>Atividades</strong></span></a>";
          echo '</li>';
        } elseif ($isLobinho == 1) {
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Atividade&action=listAtividades'> <strong><span data-tooltip='Abrir Tarefas'>Minhas Tarefas</strong></span></a>";
          echo '</li>';
        } elseif ($isChefe == 1) {
          echo '<li class="nav-item">';
          echo "<span data-tooltip='Ativar Modo Escuro'><a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Usuario&action=listUsuarios'><strong><span data-tooltip='Abrir Lobinhos'>Lobinhos</span></strong></a></span>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<span data-tooltip='Ativar Modo Escuro'><a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Matilha&action=listMatilhas'><span data-tooltip='Abrir Matilhas'><strong> Matilhas</strong></span></a></span>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Encontro&action=listEncontros'> <span data-tooltip='Abrir Encontros'><strong>Encontros</strong>/span></a>";
          echo '</li>';
          echo '<li class="nav-item">';
          echo "<a class='nav-link' href = '" . BASEURL . "/controller/AcessoController.php?controller=Atividade&action=listAtividades'><span data-tooltip='Abrir Atividades'><strong>Atividades</strong></span></a>";
          echo '</li>';
        }

        ?>


        <?php
        if (isset($_SESSION[SESSAO_USUARIO_ID])) {
          echo "<a class='nav-link' href='" . BASEURL . "/controller/AcessoController.php?controller=Usuario&action=profile&id=" .
            $_SESSION[SESSAO_USUARIO_ID] . "'><span data-tooltip='Abrir perfil'><i class='bi bi-person navbar-icon'></i></span></a>";
        }
        ?>

        <li class="nav-item">
          <a id="dark-button" class="nav-link" href="#"><span data-tooltip='Ativar Modo Escuro'><i id="dark-icon" class="bi bi-moon-stars navbar-icon"></i></span></a>
        </li>



        <?php
        if (isset($_SESSION[SESSAO_USUARIO_ID])) {
          if ($_SESSION[SESSAO_USUARIO_ID] == 0) {
            echo "<a class='nav-link' href = " . LOGIN_PAGE . ">  <span data-tooltip='Se já possuir uma conta aperte aqui'><strong>Login</strong></a></span>";
            echo "<a class='nav-link' href = " . REGISTER_PAGE . "> <span data-tooltip='Se registre aqui'> <strong>Registre-se</strong></a></span>";
          } else {
            echo "<a class='nav-link' href = " . LOGOUT_PAGE . "> <span data-tooltip='Sair'><i class='bi bi-box-arrow-right navbar-icon'></i><span></a>";
          }
          if ($nome != "Entrar") {
            echo "<a class='nav-link'><strong>" . $nome . "</strong></a>";
          }
        } else {
          echo "<a class='nav-link' href = " . LOGIN_PAGE . "> <span data-tooltip='Se já possuir uma conta aperte aqui'><strong>Login</strong></span></a>";
          echo "<a class='nav-link' href = " . REGISTER_PAGE . "> <span data-tooltip='Se registre aqui'><strong>Registre-se</strong></a></span>";
        }
        ?>

      </ul>

      
        
        <div class="logo">


          <a id="id_logo" href="<?= BASEURL ?>/controller/HomeController.php">

          <span data-tooltip='Página Principal'> 
            <img class="img_logo" src="<?= BASEURL ?>/view/pages/home/images/lobo-amarelo.png" alt="" height="100">
          </span>  

          </a>

        </div>
      
    </div>

  </nav>
  <script src="main.js"> </script>

</div>