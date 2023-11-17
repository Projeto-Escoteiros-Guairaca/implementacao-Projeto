<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
    require_once(__DIR__ . "/../../../../dao/UsuarioDAO.php");
    require_once(__DIR__ . "/../../../../model/Usuario.php");
    require_once(__DIR__ . "/../../../../controller/LinkController.php");
    require_once(__DIR__ . "/../../../../controller/TarefaController.php");
?>

<div class="container">

    <div class="row">
        <div class="col-12">
            <form id="formTarefa" method="POST" enctype="multipart/form-data" action="<?= BASEURL ?>/controller/TarefaController.php?action=save&isForm=true">
                
                <h2 class="text-center">
                    <?php if(isset($dados["id_tarefa"])): ?>
                        Alterar Tarefa
                    <?php else: ?>
                        Criar uma nova Tarefa
                    <?php endif; ?>
                </h2>

                <div class="form-group col-6">
                    <label for="txtNomeTarefa">Nome da Tarefa</label>
                    <input class="form-control" type="text" id="txtNomeTarefa" name="nomeTarefa" 
                        maxlength="70" placeholder="Informe o nome da Tarefa"
                        value="<?php
                            echo (isset($dados['tarefa']) ? $dados['tarefa']->getNomeTarefa() : "");
                        ?>" />
                </div>
                <div class="form-group col-6">
                    <label for="descricaoTarefa">Descrição</label>
                    <textarea class="form-control" id="descricaoTarefa" name="descricaoTarefa" rows="3"><?php echo (isset($dados['tarefa']) ? $dados['tarefa']->getDescricao(): "");?></textarea>
                </div>

                <br>
                <input type="hidden" id="hddId" name="id_atividade" value="<?= $dados['id_atividade']; ?>" />
                
                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-danger">Limpar</button>
                
            </form>
            <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Atividade&action=listAtividades">Voltar</a>
        </div>
    </div>

</div>

<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>