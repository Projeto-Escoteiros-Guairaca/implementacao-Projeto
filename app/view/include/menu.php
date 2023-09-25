<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

require_once(__DIR__ . "/../../controller/AcessoController.php");
require_once(__DIR__ . "/../../model/enum/UsuarioPapel.php");


if(session_status() !== PHP_SESSION_ACTIVE) 
{
    session_start();
}

$nome = "Faça Login no menu";
if(isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];


//Variável para validar o acesso
$acessoCont = new AcessoController();
$isAdministrador = $acessoCont->usuarioPossuiPapel([UsuarioPapel::ADMINISTRADOR]);
$isLobinho = $acessoCont->usuarioPossuiPapel([UsuarioPapel::LOBINHO]);

?>


<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/menu.css" />

<div class= "row " id = "cabecalho">
        <div class ="col-3 ">
        
                <aside id ="menu_oculto" class ="menu_oculto">
                    <a href = "javascript:void(0)" class = "btn_fechar" onclick ="fechar_nav()">&times;</a>
                    <?php echo"<a href = " .HOME_PAGE. "> Home</a>"; ?>
                    <?php if($nome === "Faça Login no menu") { 
                            echo "<a href = " .LOGIN_PAGE."> Login</a>";
                            echo "<a href = " .REGISTER_PAGE."> Registre-se</a>";

                        }
                        else {
                            echo "<a href = " .LOGOUT_PAGE."> Sair</a>";
                        }
                    ?>
                    <?php if($isAdministrador == 1) {
                            echo "<a href = " .BASEURL. "/controller/UsuarioController.php?action=list> Lobinhos</a>";
                            echo "<a href = " .BASEURL. "/controller/AlcateiaController.php?action=list> Alcateias</a>";
                            echo "<a href = " .BASEURL. "/controller/EncontroController.php?action=list> Encontros</a>";
                            echo "<a href = " .BASEURL. "/controller/AtividadeController.php?action=list> Atividades</a>";
                        }

                        if($isLobinho == 1) {
                            echo "<a href = " .BASEURL. "/controller/AtividadeController.php?action=list> Minhas Tarefas</a>";
                        }
                    ?>
                    <button type="button" id="dark-mode" class="btn btn-outline-light">Modo escuro</button>
                </aside>

                <section id="principal">
                    <span style="font-size:30px;cursor:pointer " onclick = "abrir_nav()">&#9776;</span>
                    <p></p>
                </section>
        </div>

    </div>

    <div class="nomeUsu">
    <?php
        if (isset($_SESSION[SESSAO_USUARIO_ID])){
            echo "<a href='". BASEURL ."/controller/UsuarioController.php?action=profile&id=". 
            $_SESSION[SESSAO_USUARIO_ID] ."'>". $nome ."</a>";
        }
        else {
            echo $nome;
        }
    ?>
</div>
    



