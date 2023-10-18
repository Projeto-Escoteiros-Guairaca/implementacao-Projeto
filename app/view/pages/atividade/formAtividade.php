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

<div class="container">

    <div class="row">
        <div class="col-6">
            <form id="formatividade" method="POST" enctype="multipart/form-data" action="<?= BASEURL ?>/controller/AcessoController.php?controller=Atividade&action=save">
                
                <h2 class="text-center">
                    <?php if(isset($dados["id_atividade"])): ?>
                        Alterar atividade
                    <?php else: ?>
                        Criar uma nova atividade
                    <?php endif; ?>
                </h2>

                <div class="form-group col-6">
                    <label for="txtNomeatividade">Nome:</label>
                    <input class="form-control" type="text" id="txtNomeAtividade" name="nomeAtividade" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php
                            echo (isset($dados['atividade']) ? $dados['atividade']->getNomeAtividade() : "");
                        ?>" />
                </div>
                <div class="form-group col-6">
                    <label for="descricaoAtividade">Descrição</label>
                    <textarea class="form-control" id="descricaoAtividade" name="descricao" rows="3"><?php echo (isset($dados['atividade']) ? $dados['atividade']->getDescricao(): "");?></textarea>
                </div>
                <input type="file" id="img" name="imagem" id="picture__input" data-image-input accept=".png, .jpg, .jpeg"/>
                <input type="hidden" id="hddId" name="imagem_atividade" value="<?=isset($dados['atividade']) ? $dados['atividade']->getImagem() : "" ?>" />

<br>
                <input type="hidden" id="hddId" name="id_atividade" value="<?= $dados['id_atividade']; ?>" />
                
                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
                
            </form>
            <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Atividade&action=listAtividades">Voltar</a>
        </div>
       

        <div class="col-9">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>

    </div>

</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>