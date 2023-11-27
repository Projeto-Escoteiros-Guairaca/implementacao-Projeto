<?php
    require_once(__DIR__ . "/../../../include/header.php");
    require_once(__DIR__ . "/../../../include/menu.php");
?>

</style>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />

<h2 class='text-center titulos'>Matilha <?= $dados["matilha"]->getNomeMatilha(); ?> </h3>
<div class="container">
    <div class="col-12">
    
        <div class="tarefa">
            <div id="tarefa-container">
                <div id="status">
                    <hr>
                    <h4>Primo: </h4>
                    <h5 class="dados_das_tarefas"><?php 
                    if($dados['matilha']->getIdPrimo() != null) {
                        echo $dados['matilha']->getUsuarioPrimo()->getNome();
                    }  
                    else {
                       echo "O primo ainda não foi selecionado.";
                    }
                    ?></h5>
                    <hr>
                    <h4>Chefe responsável: </h4>
                    <h5 class="dados_das_tarefas">
                    <?php 
                    if($dados['matilha']->getIdChefe() != null) {
                        echo $dados['matilha']->getUsuarioChefe()->getNome();
                    }  
                    else {
                       echo "Esta matilha está sem um chefe. Defina ele na página dos Lobinhos.";
                    }
                    ?>
                </h5 > 
                </div>
            </div>
        </div>
   <br>
    
    
        <div class="tarefa">
            <div id="tarefa-container">
                <h3>Lobinhos: </h3>
                <div id="descricao">
                <hr>
                    <?php foreach ($dados["usuarios"] as $usu):?>
                        <button class=" btn_verde">
                        <a class="a_bugs"href="<?=BASEURL?>/controller/MatilhaController.php?action=definePrimo&isForm&idMatilha=<?=$dados['matilha']->getIdMatilha()?>&id=<?=$usu->getId()?>"> Definir Como primo </a>
                        </button>

                        <?= $usu->getNome();?>
                        <br>
                        <br>
                        
                        <button class="btn_azul">
                        <a class= "a_bugs" href="<?=BASEURL?>/controller/AcessoController.php?controller=Usuario&action=profile&id=<?=$usu->getId() ?>" >Dados do Lobinho</a>
                        </button>
                    <hr>
                    <?php endforeach;?>
                </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
<script src="<?= BASEURL ?>/view/js/matilha.js"> </script> 
<?php
    require_once(__DIR__ . "/../../../include/footer.php");
?>