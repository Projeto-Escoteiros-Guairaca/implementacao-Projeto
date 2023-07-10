<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/login.css" />

<div class="container">
    <div class="row " style="margin-top: 20px;">
        <div class="col-6 personalizacao_form">
            <div class=" d_form">
                <h4>Informe os dados para logar:</h4>
                <br>

                <!-- Formulário de login -->
                <form id="frmLogin" action="./LoginController.php?action=logon" method="POST" >
                    <div class="form-group">
                        <label for="txtLogin">Login:</label>
                        <input type="text" class="form-control estilo_dados_form" name="login" id="txtLogin" 
                            maxlength="15" placeholder="Informe o login"
                            value="<?php echo isset($dados['login']) ? $dados['login'] : '' ?>" />        
                    </div>

                    <div class="form-group">
                        <label for="txtSenha">Senha:</label>
                        <input type="password" class="form-control estilo_dados_form" name="senha" id="txtSenha"
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />        
                    </div>
                    <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
        </svg>
                    <button type="submit" class="btn btn-success" id= "btn_logar"><span>Logar</span></button>
                    <a class="btn btn-primary" id= "btn_voltarr"href='<?= HOME_PAGE ?>'>Voltar</a>
                </form>
            </div>
        </div>

        <div class="col-6">
            <?php include_once(__DIR__ . "/../include/msg.php") ?>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
