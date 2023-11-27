<?php

    require_once(__DIR__ . "/../../include/header.php");
    require_once(__DIR__ . "/../../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/tabelas.css" />
<link rel="stylesheet" href="<?= BASEURL ?>/view/styles/main.css" />

<div class="container">
    <div class="col-12">

        <div class="row" style="margin-top: 10px;">
    
            <h2 class='titulos'>
            <?php echo"encontro do dia " . $dados['encontro']->getDataEncontroFormated(); ?>
            </h2>
            
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
                                        if ($freq->getFrequencia() == 1) {
                                            echo "<a class='btn btn-outline-success' href='". BASEURL .
                                            "/controller/AcessoController.php?controller=Frequencia&action=updateToFalse&id=". $freq->getIdFrequencia() .
                                            "&idMatilha=". $freq->getUsuario()->getIdMatilha() ."&idEncontro=". $freq->getIdEncontro() ."'>C</a>";
                                        } else {
                                            echo "<a class='btn btn-outline-danger' href='". BASEURL .
                                            "/controller/AcessoController.php?controller=Frequencia&action=updateToTrue&id=". $freq->getIdFrequencia() .
                                            "&idMatilha=". $freq->getUsuario()->getIdMatilha() ."&idEncontro=". $freq->getIdEncontro() ."'>F</a>";
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
</div>
<div class="row">
     <div class="">
         <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
     </div>
 </div>
        
<br><br><br><br><br><br>

<?php
    require_once(__DIR__ . "/../../include/footer.php");
?>