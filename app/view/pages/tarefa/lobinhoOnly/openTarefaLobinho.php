<?php
require_once(__DIR__ . "/../../../include/header.php");
require_once(__DIR__ . "/../../../include/menu.php");
require_once(__DIR__ . "/lobinhoSendedTarefa.php");
require_once(__DIR__ . "/lobinhoDidNotSend.php");
require_once(__DIR__ . "/lobinhoHasToSendAgain.php");

?>

</style>
<style>
    textarea {
        resize: none;
    }
</style>
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/openTarefa.css" />
<a class="btn_cards_atv" href="<?= BASEURL ?>/controller/AcessoController.php?controller=Tarefa&action=listTarefas"> voltar à lista de tarefas </a>


<h2 class='text-center'>Tarefa <?= $dados["tarefa"]->getNomeTarefa(); ?> </h3>

    <div class="tarefa">
        <div id="tarefa-container">
            <h3>Descrição</h3>
            <div id="descricao">
                <hr>
                <?php echo $dados["tarefa"]->getDescricaoTarefa(); ?>
                <hr>
            </div>
            <div id="status">
                <hr>
                <h4>Estado da entrega: </h4>
                <h5 style="color:brown;">

                    <?php
                    if (isset($dados['envioUsuario'])) {
                        echo $dados['envioUsuario']->getStatusEntregaPalavra();
                    } else {
                        echo "Não entregou ainda.";
                    }
                    ?>
                </h5>
                <h3>Data de entrega</h3>
                <div id="descricao">
                    <hr>
                    <h5 style="color:brown;">

                        <?php
                        if (isset($dados['envioUsuario'])) {
                            echo $dados['envioUsuario']->getDataEntregaFormated();
                        } else {
                            echo "Sem data de entrega ainda.";
                        }
                        ?>
                    </h5>
                    <hr>
                </div>
            </div>
        </div>

        <br>
        <br>

        <div class="tarefa">
            <div id="tarefa-container">

                <div id="descricao">

                    <?php
                    if (isset($dados['envioUsuario'])) {
                        if ($dados['envioUsuario']->getStatusEntrega() == 1) {
                            lobinhoHasToSendAgain::MostraTarefa($dados['envioUsuario']);
                        } else {
                            lobinhoSendedTarefa::MostraTarefa($dados['envioUsuario']);
                        }
                    } else {
                        lobinhoDidNotSend::MostraFormulario();
                    }
                    ?>

                </div>
            </div>
        </div>

        <script src="<?= BASEURL ?>/view/js/tarefa.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
        <?php
        require_once(__DIR__ . "/../../../include/footer.php");
        ?>