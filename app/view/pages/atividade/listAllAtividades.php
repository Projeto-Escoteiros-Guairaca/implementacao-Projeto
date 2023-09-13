<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../alcateia/selectAlcateia.php");

?>
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/atividade.css" />

    <h3 class='text-center'>Atividades</h3>

    <div class='container'>
        <div class="row">
            <div class="col-3">
                <a class="btn btn-success" href="<?= BASEURL ?>/controller/AtividadeController.php?action=create">Inserir</a>
            </div>
            <div class="col-9">
                <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php foreach($dados["lista"] as $ativ):?>
                    <div class="card my-2 mx-2" style="width: 18rem;">
                        <img style="height: 225px;" class="card-img-top" src="<?= BASEURL?><?php echo $ativ->getImagem();?>" alt="INSERE IMAGEM AQUI LOL">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $ativ->getNomeAtividade();?></h5>
                            <hr>
                            <p class="card-text">
                            <?php echo $ativ->getDescricao();?></p>
                            <a href="<?= BASEURL?>/controller/TarefaController.php?action=listByIdAtiv&id=<?php echo $ativ->getIdAtividade()?>" 
                            class="btn btn-primary">Mostrar Tarefas</a>
                            <a href="<?= BASEURL?>/controller/AtividadeController.php?action=edit&id=<?php echo $ativ->getIdAtividade()?>" 
                            class="btn btn-primary my-2">alterar</a>
                            <a href="<?= BASEURL?>/controller/TarefaController.php?action=createTarefaAtiv&id=<?php echo $ativ->getIdAtividade()?>" 
                            class="btn btn-success my-2">Criar Tarefas</a>
                            <a class="btn btn-danger" href="<?= BASEURL?>/controller/AtividadeController.php?action=delete&id=<?php echo $ativ->getIdAtividade()?>"
                            > deletar </a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <a class="btn btn-success my-2" 
                href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
    </div>
    <script src="<?= BASEURL ?>/view/js/usuario.js"> </script> 

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>