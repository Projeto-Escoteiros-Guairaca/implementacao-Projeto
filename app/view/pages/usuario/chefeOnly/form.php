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

    <div class="col-12" style="margin-top: 10px;">
        
        
            <form id="frmUsuario" class="formularios" method="POST" 
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=save&isForm=true" >

                <h2 class="text-center">
                    Dados de identificação do Usuário
                </h2>

                
                    <div class="form-group">
                        <label for="txtNome">Nome:</label>
                        <input class="form-control" type="text" id="usuario.Nome" name="nome" 
                            maxlength="70" placeholder="Informe o nome"
                            value="<?php
                                echo (isset($dados['usuario']) ? $dados['usuario']->getNome(): "");
                            ?>" />
                    </div>
                    <div class="form-group">
                        <label for="txtCpf">CPF:</label>
                        <input class="form-control" type="text" id="usuario-Cpf" name="cpf" 
                            maxlength="11" placeholder="Informe o CPF"
                            value="<?php
                                echo (isset($dados['usuario']) ? $dados['usuario']->getCpf(): "");
                            ?>" />
                    </div>
            
                    <div class="form-group ">
                        <label for="txtSenha">Senha:</label>
                        <input class="form-control" type="password" id="usuario-Password" name="senha" 
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getSenha(): "");
                            ?>"/>
                    </div>

                    <div class="form-group ">
                        <label for="txtConfSenha">Confirmação da senha:</label>
                        <input class="form-control" type="password" id="usuario-ConfSenha" name="conf_senha" 
                            maxlength="15" placeholder="Informe a confirmação da senha"
                            value="<?php
                                echo (isset ($dados['confSenha'])? $dados['confSenha'] : "");
                            ?>"/>
                    </div>
              

                <input type="hidden" id="hddId" name="id" 
                    value="<?= $dados['id']; ?>" />

                <h2 class="text-center">
                    Dados de endereço do Usuário
                </h2>

                
                    <div class="form-group ">
                        <label for="txtCep">CEP:</label>
                        <input class="form-control" type="text" id="endereco-Cep" name="cep" 
                            maxlength="9" placeholder="Informe o CEP, ex: 00000-000"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getCep(): "");
                        ?>" />
                    </div>
                    <div class="form-group ">
                        <label for="txtLogradouro">Logradouro:</label>
                        <input class="form-control" type="text" id="endereco-Logradouro" name="logradouro" 
                            maxlength="255" placeholder="Informe o logradouro, ex: Rua, Avenida, etc"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getLogradouro(): "");
                        ?>" />
                    </div>
               
               
                    <div class="form-group ">
                        <label for="numeroEndereco">Nº:</label>
                        <input class="form-control" type="number" id="endereco-Numero" name="numeroEndereco" 
                            maxlength="5" placeholder="Informe o número"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getNumeroEndereco(): "");
                        ?>" />
                    </div>
                    <div class="form-group ">
                        <label for="txtBairro">Bairro:</label>
                        <input class="form-control" type="text" id="endereco-Bairro" name="bairro" 
                            maxlength="100" placeholder="Informe o Bairro"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getBairro(): "");
                        ?>" />
                    </div>
              
                
                    <div class="form-group ">
                        <label for="txtCidade">Cidade:</label>
                        <input class="form-control" type="text" id="endereco-Cidade" name="cidade" 
                            maxlength="100" placeholder="Informe a cidade"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getCidade(): "");
                        ?>" />
                    </div>
                    <div class="form-group ">
                        <label for="txtPais">País:</label>
                        <input class="form-control" type="text" id="endereco-Pais" name="pais" 
                            maxlength="45" placeholder="Informe o País"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getEndereco()->getPais(): "");
                        ?>" />
                    </div>
               

                <input type="hidden" id="hddIdEndereco" name="id_endereco"
                    value="<?= $dados['id_endereco']; 
               ?>" />

                <h2 class="text-center">
                    Dados de contato do Usuário
                </h2>

               
                    <div class="form-group ">
                        <label for="txtTelefone">Telefone:</label>
                        <input class="form-control" type="text" id="contato-Telefone" name="telefone" 
                            maxlength="10" placeholder="Informe um telefone"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getContato()->getTelefone(): "");
                        ?>" />
                    </div>
                    <div class="form-group">
                        <label for="txtCelular">Celular:</label>
                        <input class="form-control" type="txt" id="contato-Celular" name="celular" 
                            maxlength="11" placeholder="Informe um celular"
                            value="<?php
                               echo (isset ($dados['usuario'])? $dados['usuario']->getContato()->getCelular(): "");
                        ?>" />
                    </div>
              
                
                    <div class="form-group">
                        <label for="txtEmail">E-mail:</label>
                        <input class="form-control" type="email" id="contato-Email" name="email" 
                            maxlength="100" placeholder="Informe um e-mail"
                            value="<?php
                                echo (isset ($dados['usuario'])? $dados['usuario']->getContato()->getEmail(): "");
                        ?>" />
                    </div>
                

                <input type="hidden" id="hddIdContato" name="id_contato"
                    value="<?= $dados['id_contato']; ?>" />

                <button type="submit" class="btn_verde">Gravar</button>
                <button type="reset" class="btn_vermelho">Limpar</button>
            </form>
            
            
        

        <div class="">
            <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
        </div>
    </div>
    <script type="text/javascript" src="<?= BASEURL ?>/view/js/userVerification.js">></script>
<?php  
require_once(__DIR__ . "/../../../include/footer.php");
?>