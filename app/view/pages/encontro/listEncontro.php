<?php
    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
    require_once(__DIR__ . "/../../../dao/MatilhaDAO.php");
    require_once(__DIR__ . "/../matilha/selectMatilha.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/listEncontro.css" />

<h3 class='titulos'>Encontros</h3>

<div class="container">
    <div class="col-12">
        <div class="row row_ferramentas">

            <a class="btn_inserir" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=create">
            <div class= "div_icon_inseriri">
                <i class="icon_inserir bi bi-plus"></i>
            </div>
            <div class="div_titulo_inserir">
                <h5 class="titulo_btn_inserir">Inserir Encontro</h5>
            </div>
            </a>

            <div class="div_filtro">

                <form method="POST" action="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&filtered=true&isForm=true">

                    <h6>Desde</h6>
                    <input class=" form-control" type="date" placeholder="De" name="desde" 
                    value="<?php
                            echo (isset($dados['desde']) ? $dados['desde'] : "");
                        ?>">
                    <h6>Até</h6>
                    <input class=" form-control" type="date" placeholder="Até" name="ate"
                    value="<?php
                            echo (isset($dados['ate']) ? $dados['ate'] :  "");
                        ?>">
                    <div class="form-group">
                        <label for="somMatilha">Matilha:</label>
                        <?php
                        $alcDao = new MatilhaDAO();
                        $matilhas = $alcDao->list();

                        SelectMatilha::desenhaSelect($matilhas, "matilhaEncontro", "somMatilha", isset($dados['id_matilha']) ? $dados['id_matilha'] : 0);
                        ?>
                    </div>

                        <button class="btn_verde" type="submit"> Filtrar </button>
                        
                        <button class="btn_vermelho">
                        <a class= "a_bugs"href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=listEncontros"  type="reset" > Limpar </a>
                        </button>

                </form>

            </div>
        </div>

            <div class="">
                <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
            </div>
    

        <div class="row row_cards_pequenos" style=" margin-top: 10px;">
        
            <?php if (count($dados["lista"]) == 0) : ?>
                <center colspan="6">Nenhum encontro encontrado, tente novamente.</center>
            <?php else: ?>
                <?php foreach($dados["lista"] as $enc): ?>
                    <div class="card my-2 mx-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $enc->getDataEncontroFormated();?></h5>
                            <hr>
                            <h4 class="card-text"><?php echo $enc->getMatilha()->getAlcateia()->getNomeAlcateia() ?> </h4>
                            <h5 class="card-text"><?php echo $enc->getMatilha()->getNomeMatilha();?></h5>
                            <p class="card-text"><?php echo $enc->getDescricaoEncontro();?></p>
                            <a class="btn_cards" 
                                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Encontro&action=edit&id=<?= $enc->getIdEncontro() ?>">
                                Alterar</a> 
                                <br><br>
                            <a class="btn_cards" 
                                href="<?= BASEURL ?>/controller/AcessoController.php?controller=Frequencia&action=createFrequencias&idEncontro=<?= 
                                    $enc->getIdEncontro()?>&idMatilha=<?= $enc->getIdMatilha()?>">Registrar Frequência</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>           
</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>