<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../matilha/selectMatilha.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/atividade.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />


    <div class="row r_listATV"> <!-- Adicionando a div com classe "row" -->
        <div class="col-12">
         
                <?php
                if ($isLobinho == 2) {
                    echo '
                   
                    <a class="btn_inserir card my-2 mx-2 Card" style="width: 18rem;" 
                    href="' . BASEURL . '/controller/AcessoController.php?controller=Atividade&action=create">
                        <div class= "div_icon_inseriri">
                            <i class="icon_inserir bi bi-plus"></i>
                        </div>

                        <div class="div_titulo_inserir">
                            <h5 class="titulo_btn_inserir">Inserir Atividades</h5>
                        </div>  
                    </a>
                   
                    ';
                }
                ?>

            <?php foreach ($dados["lista"] as $ativ) : ?>
                <div class="card my-2 mx-2 Card" style="width: 18rem;">
                    <?php if ($isLobinho == 2) {
                        echo '<a id= "editar_atv" class= "principais_btn_cards_atv" href="' . BASEURL . '/controller/AcessoController.php?controller=Atividade&action=edit&id=' . $ativ->getIdAtividade() . '"><i class="bi bi-pencil"><span id= p_editar_atv >Editar</span></i></a>
                              <a id= "deletar_atv" class= "principais_btn_cards_atv" href="' . BASEURL . '/controller/AcessoController.php?controller=Atividade&action=delete&id=' . $ativ->getIdAtividade() . '"> <i class="bi bi-trash3"><span id= p_deletar_atv >Deletar</span></i> </a>';
                    }
                    ?>

                    <img style="height: 225px;" class="card-img-top" src="<?= BASEURL ?><?php echo $ativ->getImagem(); ?>" alt="INSERE IMAGEM AQUI LOL">
                    <div class="card-body">
                        <h5 class="titulos_atv"><?php echo $ativ->getNomeAtividade(); ?></h5>
                        <hr>
                        <p class="card-text">
                            <?php echo $ativ->getDescricaoAtividade(); ?></p>
                        <a class="btn_cards" style="text-decoration: none" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Tarefa&action=listTarefas&idAtividade=<?php echo $ativ->getIdAtividade(); ?>">Mostrar Tarefas
                        </a>

                        <?php
                        if ($isLobinho == 2) {
                            echo '<a class="btn_cards" style="text-decoration: none" href="' . BASEURL . '/controller/AcessoController.php?controller=Tarefa&action=create&idAtividade=' . $ativ->getIdAtividade() . '">Criar Tarefas</a>';
                        }
                        ?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div> <!-- Fim da div com class="row" -->
    <div class="col-9">
        <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
    </div>

</div>
<script src="<?= BASEURL ?>/view/js/usuario.js"> </script>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>
