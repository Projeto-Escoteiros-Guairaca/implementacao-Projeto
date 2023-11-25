<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../../include/header.php");
?>

<?php require_once(__DIR__ . "/../../../include/menu.php"); 

if(! isset($_SESSION[SESSAO_USUARIO_ID])) {
    $_SESSION['callAccessToken'] = true;
}
?>

<h3 class="text-center">
    <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?> 
    Usuário
</h3>


<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />
<div class="container">
    
    <div class="col-12" style="margin-top: 10px;">
        
        <div class="form_editar_dados">
            <form id="frmUsuario" class="formularios" method="POST" 
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=save&isForm=true" >

                <h2 class="text-center">
                    Dados de identificação do Usuário
                </h2>

                <div class="row">
                    <div class="form-group">
                        <label for="txtNome">Nome:</label>
                        <input class="form-control" type="text" id="txtNome" name="nome" 
                            maxlength="70" placeholder="Informe o nome"
                            value="<?php
                                echo (isset($dados['usuario']) ? $dados['usuario']->getNome(): "");
                            ?>" />
                    </div>
                    <div class="form-group">
                        <label for="txtCpf">CPF:</label>
                        <input class="form-control" type="text" id="txtCpf" name="cpf" 
                            maxlength="11" placeholder="Informe o CPF"
                            value="<?php
                                echo (isset($dados['usuario']) ? $dados['usuario']->getCpf(): "");
                            ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txtLogin">Login:</label>
                    <input class="form-control" type="text" id="txtLogin" name="login" 
                        maxlength="15" placeholder="Informe o login"
                        value="<?php
                            echo (isset ($dados['usuario'])? $dados['usuario']->getLogin(): "");
                        ?>"/>
                </div>

                <div class="row">
                    <div class="form-group ">
                        <label for="txtSenha">Senha:</label>
                        <input class="form-control" type="password" id="txtPassword" name="senha" 
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getSenha(): "");
                            ?>"/>
                    </div>

                    <div class="form-group ">
                        <label for="txtConfSenha">Confirmação da senha:</label>
                        <input class="form-control" type="password" id="txtConfSenha" name="conf_senha" 
                            maxlength="15" placeholder="Informe a confirmação da senha"
                            value="<?php
                                echo (isset ($dados['confSenha'])? $dados['confSenha'] : "");
                            ?>"/>
                    </div>
                </div>

                <input type="hidden" id="hddId" name="id" 
                    value="<?= $dados['id']; ?>" />

                <h2 class="text-center">
                    Dados de endereço do Usuário
                </h2>

                <div class="row">
                    <div class="form-group ">
                        <label for="txtCep">CEP:</label>
                        <input class="form-control" type="text" id="txtCep" name="cep" 
                            maxlength="9" placeholder="Informe o CEP, ex: 00000-000"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getCep(): "");
                        ?>" />
                    </div>
                    <div class="form-group ">
                        <label for="txtLogradouro">Logradouro:</label>
                        <input class="form-control" type="text" id="txtLogradouro" name="logradouro" 
                            maxlength="255" placeholder="Informe o logradouro, ex: Rua, Avenida, etc"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getLogradouro(): "");
                        ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group ">
                        <label for="numeroEndereco">Nº:</label>
                        <input class="form-control" type="number" id="numeroEndereco" name="numeroEndereco" 
                            maxlength="5" placeholder="Informe o número"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getNumeroEndereco(): "");
                        ?>" />
                    </div>
                    <div class="form-group ">
                        <label for="txtBairro">Bairro:</label>
                        <input class="form-control" type="text" id="txtBairro" name="bairro" 
                            maxlength="100" placeholder="Informe o Bairro"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getBairro(): "");
                        ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group ">
                        <label for="txtCidade">Cidade:</label>
                        <input class="form-control" type="text" id="txtCidade" name="cidade" 
                            maxlength="100" placeholder="Informe a cidade"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getCidade(): "");
                        ?>" />
                    </div>
                    <div class="form-group ">
                        <label for="txtPais">País:</label>
                        <input class="form-control" type="text" id="txtPais" name="pais" 
                            maxlength="45" placeholder="Informe o País"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getPais(): "");
                        ?>" />
                    </div>
                </div>

                <input type="hidden" id="hddIdEndereco" name="id_endereco"
                    value="<?= $dados['id_endereco']; 
               ?>" />

                <h2 class="text-center">
                    Dados de contato do Usuário
                </h2>

                <div class="row">
                    <div class="form-group ">
                        <label for="txtTelefone">Telefone:</label>
                        <input class="form-control" type="text" id="txtTelefone" name="telefone" 
                            maxlength="10" placeholder="Informe um telefone"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getContato()->getTelefone(): "");
                        ?>" />
                    </div>
                    <div class="form-group">
                        <label for="txtCelular">Celular:</label>
                        <input class="form-control" type="txt" id="txtCelular" name="celular" 
                            maxlength="11" placeholder="Informe um celular"
                            value="<?php
                               echo (isset ($dados['usuario'])? $dados['usuario']->getContato()->getCelular(): "");
                        ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="txtEmail">E-mail:</label>
                        <input class="form-control" type="email" id="txtEmail" name="email" 
                            maxlength="100" placeholder="Informe um e-mail"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getContato()->getEmail(): "");
                        ?>" />
                    </div>
                </div>

                <input type="hidden" id="hddIdContato" name="id_contato"
                    value="<?= $dados['id_contato']; ?>" />

                <button type="submit" class="btn_gravar">Gravar</button>
                <button type="reset" class="btn_limpar">Limpar</button>
            </form>
            
            
        </div>

        <div class="">
            <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <?php
        if($dados['id'] > 0)
            echo "<a href='". BASEURL ."/controller/AcessoController.php?controller=Usuario&action=profile&id=". $_SESSION[SESSAO_USUARIO_ID] ."'>Voltar</a>";
        else
            echo "<a href='". BASEURL ."/controller/HomeController.php'>Voltar</a>";
        ?>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../../../include/footer.php");
?>