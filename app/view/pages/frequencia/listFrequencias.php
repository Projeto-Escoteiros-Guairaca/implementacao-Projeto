<?php

    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
?>

<div class="container">
    <div class="row">
     
        <div class="col-9">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
            <div class="col-12">
            <div class="col-12">
            <h2>     <?php    
            foreach($dados["encontro"] as $enc):
            ?> 
            <?php echo"encontro do dia " . $enc->getDataFormated(); ?>
            <?php endforeach;?>
            </h2>
            </div>
                <table id="tabfrequencias" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>frequencia</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados["lista"] as $freq): ?>
                            <tr>
                                <td><?php echo $freq->getUsuario()->getNome(); ?></td>
                                <td>
                                    <?php 
                                    if ($freq->getFrequencia() == 1) {
                                        echo "<a class='btn btn-outline-success' href='". BASEURL .
                                         "/controller/FrequenciaController.php?action=updateToFalse&id=". $freq->getId_frequencia() .
                                         "&idAlcateia=". $freq->getUsuario()->getIdAlcateia() ."&idEncontro=". $freq->getId_encontro() ."'>C</a>";
                                    } else {
                                        echo "<a class='btn btn-outline-danger' href='". BASEURL .
                                         "/controller/FrequenciaController.php?action=updateToTrue&id=". $freq->getId_frequencia() .
                                         "&idAlcateia=". $freq->getUsuario()->getIdAlcateia() ."&idEncontro=". $freq->getId_encontro() ."'>F</a>";
                                    }
                                    ?>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="btn btn-success" href="<?= BASEURL ?>/controller/EncontroController.php?action=list">Voltar</a>
            </div>
        </div>
</div>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>