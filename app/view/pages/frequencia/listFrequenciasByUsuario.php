<?php

    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");
    $i = 0;
?>


    <div class="row">
     
        <div class="col-9">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
            <div class="col-12">
            <div class="col-12">
            <h2>
                <?php echo $dados["usuario"]->getNome();?>
            </h2>
            </div>
                <table id="tabfrequencias" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Encontro</th>
                            <th>frequencia</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($dados["lista"]) == 0) : ?>
                            <tr>
                                <td colspan="6">Nenhum usuário encontrado para registro, tente novamente.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($dados["lista"] as $freq): ?>
                                <tr>
                                    <td><?php echo $dados['encontros'][$i]->getDataEncontroFormated(); ?>
                                </td>
                                    <td>
                                        <?php if($freq->getFrequencia() == 1) {
                                            echo "<h5> Presente </h5>";
                                        }
                                        else {
                                            echo "<h5> Faltou </h5";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php 
                            $i++;
                        endforeach; 
                        ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>