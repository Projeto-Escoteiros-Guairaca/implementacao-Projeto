<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../alcateia/selectAlcateia.php");
?>
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/atividade.css" />

    <div class='container'>
        <div class="row">
            <div class="col-3">
                <a id="btn_inserir_atv" href="<?= BASEURL ?>/controller/AtividadeController.php?action=create"><i id= "icon_inserir_atv"class="bi bi-plus"></i></a>
            </div>
            <div class="col-9">
                <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php foreach($dados["lista"] as $ativ):?>
                    <div  class="card my-2 mx-2 Card" style="width: 18rem;"> 
                    <a id= "editar_atv" class= "principais_btn_cards_atv" href="<?= BASEURL?>/controller/AtividadeController.php?action=edit&id=<?php echo $ativ->getIdAtividade()?>"><i class="bi bi-pencil"><span id= p_editar_atv >Editar</span></i></a>

                    <a id= "deletar_atv"class= "principais_btn_cards_atv" href="<?= BASEURL?>/controller/AtividadeController.php?action=delete&id=<?php echo $ativ->getIdAtividade()?>"> <i class="bi bi-trash3"><span id= p_deletar_atv >Deletar</span></i> </a>
                        <img style="height: 225px;" class="card-img-top" src="<?= BASEURL?><?php echo $ativ->getImagem();?>" alt="INSERE IMAGEM AQUI LOL">
                        <div class="card-body">
                            <h5 class="titulos_atv"><?php echo $ativ->getNomeAtividade();?></h5>
                            <hr>
                            <p class="card-text">
                            <?php echo $ativ->getDescricao();?></p>
                            <a class= "btn_cards_atv" style="text-decoration: none" href="<?= BASEURL?>/controller/AcessoController.php?controller=Tarefa&action=listTarefas&idAtividade=<?php echo $ativ->getIdAtividade()?>">Mostrar Tarefas</a>
                           
                            <a class= "btn_cards_atv" style="text-decoration: none" href="<?= BASEURL?>/controller/AcessoController.php?controller=Tarefa&action=createTarefaAtiv&idAtividade=<?php echo $ativ->getIdAtividade()?>">Criar Tarefas</a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        
    </div>
    <script src="<?= BASEURL ?>/view/js/usuario.js"> </script> 

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>