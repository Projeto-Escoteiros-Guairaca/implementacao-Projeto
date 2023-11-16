<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
    require_once(__DIR__ . "/../../../dao/UsuarioDAO.php");
    require_once(__DIR__ . "/../../../model/Usuario.php");
    require_once(__DIR__ . "/../usuario/selectUsuChefe.php");
    require_once(__DIR__ . "/../usuario/selectUsuPrimo.php");
    require_once(__DIR__ . "/../../../controller/LinkController.php");
    require_once(__DIR__ . "/../../../controller/atividadeController.php");
?>
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/atividade.css" />
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />

<div class="container">
    <div class="col-12">
        
            <form id="formatividade" class= " for_universal"method="POST" enctype="multipart/form-data" action="<?= BASEURL ?>/controller/AtividadeController.php?action=save">
                
                <h3 class="titulos">
                    <?php if(isset($dados["id_atividade"])): ?>
                        Alterar atividade
                    <?php else: ?>
                        Criar uma nova atividade
                    <?php endif; ?>
                </h3>

                <div class="form-group">
                    <label for="txtNomeatividade">Nome:</label>
                    <input class="form-control" type="text" id="txtNomeAtividade" name="nomeAtividade" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php
                            echo (isset($dados['atividade']) ? $dados['atividade']->getNomeAtividade() : "");
                        ?>" />
                </div>
                <div class="form-group">
                    <label for="descricaoAtividade">Descrição</label>
                    <textarea class="form-control" id="descricaoAtividade" name="descricao" rows="3"><?php echo (isset($dados['atividade']) ? $dados['atividade']->getDescricao(): "");?></textarea>
                </div>
                <input type="file" id="img_form_atv" name="imagem" id="picture__input" data-image-input accept=".png, .jpg, .jpeg"/>
                
                <input type="hidden" id="input_img" name="imagem_atividade" value="<?=isset($dados['atividade']) ? $dados['atividade']->getImagem() : "" ?>" />

<br>
                <input type="hidden" id="hddId" name="id_atividade" value="<?= $dados['id_atividade']; ?>" />
                
                <button type="submit" class="btn_gravar">Gravar</button>
                <button type="reset" class="btn_limpar">Limpar</button>
                
            </form>
        
       
                   <a href="<?= BASEURL ?>/controller/AcessoController.php?controller=Atividade&action=listAtividades">Voltar</a>

        <div class="row">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>

    </div>

</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>