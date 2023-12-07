<?php

    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/tabelas.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />

<h2 class='titulos'>
            <?php echo"encontro do dia " . $dados['encontro']->getDataEncontroFormated(); ?>
            </h2>

    <div class="col-12">

        <div class="row" style="margin-top: 10px;">
    
            
            
                <table id="tabfrequencias">
                    <thead>
                        <tr>
                            <th>Usuario</th>
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
                                    <td><?php echo $freq->getUsuario()->getNome(); ?></td>
                                    <td>
                                        <?php 
                                        $idFrequencia = $freq->getIdFrequencia();
                                        if ($freq->getFrequencia() == 1) {
                                            echo    <<<END
                                                <button class="btn btn-outline-success" id="frequencia$idFrequencia" onclick="changeFrequencia('$idFrequencia', '0')"> C </button>
                                            END;
                                        }
                                        else {
                                            echo    <<<END
                                                <button class="btn btn-outline-danger" id="frequencia$idFrequencia" onclick="changeFrequencia('$idFrequencia', '1')"> F </button>
                                            END;
                                        }
                                        ?>
                                    </td>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                
            
        </div>
    </div>

<div class="row">
     <div class="">
         <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
     </div>
 </div>
        
<br><br><br><br><br><br>
<script src="<?= BASEURL ?>/view/js/encontro.js"></script> 

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>