<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/login.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />

<br>
<h4 class="titulos">Informe os dados para logar:</h4>

<div class="container">
        <div class="col-12">
           
                
              
                <!-- Formulário de login -->
                <form id="frmLogin" class="formularios" action="./LoginController.php?action=logon&isForm=true" method="POST" >
                    <div class="form-group">
                        <label for="txtLogin">Login:</label>
                        <input type="text" class="form-control" name="login" id="txtLogin" 
                            maxlength="15" placeholder="Informe o login"
                            value="<?php echo isset($dados['login']) ? $dados['login'] : '' ?>" />        
                    </div>

                    <div class="form-group">
                        <label for="txtSenha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="txtSenha"
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />        
                    </div>
                    <button type="submit" class="btn_verde ">
                        <span>Logar</span>
                    </button>
                    <button class="btn_vermelho">
                    <a class="a_bugs" href = " <?= REGISTER_PAGE?> ">Registre-se</a>
                    </button>
                </form>
      
        </div>

        
    
</div>
<div class="">
            <?php include_once(__DIR__ . "/../../include/msg.php") ?>
        </div>

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>
