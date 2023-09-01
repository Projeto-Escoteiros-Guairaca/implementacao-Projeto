<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../alcateia/selectAlcateia.php");

?>
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/list.css" />

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

        <div id="pinto" class="row" style="margin-top: 10px;">
            <div class="col-12">

                           <!-- COMIENZO CARD -->

            <?php foreach($dados["lista"] as $ativ):?>
        
                <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?= BASEURL?><?php echo $ativ->getImagem();?>" alt="INSERE IMAGEM AQUI LOL">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $ativ->getNomeAtividade();?></h5>
                    <hr>
                    <p class="card-text">
                    <?php echo $ativ->getDescricao();?></p>
                    <a href="<?= BASEURL?>/controller/TarefaController.php?action=list&id='<?php echo $ativ->getIdAtividade()?>'" 
                    class="btn btn-primary">Mostrar Tarefas</a>
                    <a href="<?= BASEURL?>/controller/AlcateiaController.php?action=update&id='<?php echo $ativ->getIdAtividade()?>'" 
                    class="btn btn-primary">alterar</a>
                </div>
                </div>
                <?php endforeach;?>
<!-- FIN CARD -->

                <a class="btn btn-success my-2" 
                href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
            </div>
        </div>
    </div>
    <script src="<?= BASEURL ?>/view/js/usuario.js"> </script> 

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>