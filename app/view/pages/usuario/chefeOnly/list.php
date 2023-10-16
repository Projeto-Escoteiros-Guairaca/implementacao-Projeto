<?php

require_once(__DIR__ . "/../../../include/header.php");
require_once(__DIR__ . "/../../../include/menu.php");
require_once(__DIR__ . "/../../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../../../../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../../alcateia/selectAlcateia.php");
require_once(__DIR__ . "/../selectPapeis.php");
require_once(__DIR__ . "/../../../../model/Usuario.php");
?>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/list.css" />

    <h3 class='text-center'>Usuários</h3>

    <div class='container'>
        <div class="row">
            <div class="col-9">
                <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
            </div>
        </div>
        <div>
            <label> Buscar usuário</label>
            <input type="text" name="buscar" id="buscar" oninput="findUsuario('<?= BASEURL ?>', <?= $_SESSION[SESSAO_USUARIO_ID] ?>)">
        </div>
        <div id="bruh" class="row" style="margin-top: 10px;">
            
            <div class="col-12" id="card-pai">
                <?php if (count($dados["lista"]) == 0) : ?>
                    <a style="display: flex;justify-content: center;" colspan="6">|Nenhum encontro encontrado, tente novamente.</a>
                <?php else: ?>
                    <?php foreach($dados["lista"] as $usu): ?>
                        <?php if ($usu->getId() == $_SESSION[SESSAO_USUARIO_ID]) {
                            continue;
                        }
                        ?>
                        <div class="card my-2 mx-2" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $usu->getNome();?></h5>
                                <hr>
                                <p class="card-text"><?php echo $usu->getcontato()->getEmail();?></p>
                                <p class="card-text">
                                    <?php
                                        $usuario = new Usuario();
                                        $papeis = new UsuarioPapel();
                                        $arrayPapeis = $papeis->getAllAsArray();
                                        $usuario->setPapeisAsArray($arrayPapeis);
                                    
                                        SelectPapeis::desenhaSelect($usu, $usuario->getPapeisAsArray(), "papel_usuario");
                                    ?>
                                </p>
                                <p>
                                <?php
                                    if ($usu->getStatus() == 'ATIVO') {
                                        echo "<a id='status' class='btn btn-outline-success' onclick='sendChange(1, ".$usu->getId().");' >ATIVO</a>";
                                    } else {
                                        echo "<a id='status' class='btn btn-outline-danger' onclick='sendChange(0, ".$usu->getId().")'>INATIVO</a>";
                                    }
                                    ?>
                                </p>
                                <button class="<?php if($usu->getAlcateia()) {
                                        echo "btn btn-secondary";
                                    }else {
                                        echo "btn btn-warning";
                                    }?>"
                                    id="<?= $usu->getId();?>" onclick="findTheAlcateias(<?php if($usu->getIdAlcateia()) {echo $usu->getIdAlcateia();} else {echo '0';}?>
                                    , 'list', <?= $usu->getId();?>);"> 
                                    <?php if($usu->getAlcateia()) {
                                        echo $usu->getAlcateia()->getNome();
                                    }else {
                                        echo "sem alcateia";
                                    }?>
                                </button> 
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
          
            
        </div>
    </div>

<br><br><br><br><br>
    <script src="<?= BASEURL ?>/view/js/usuario.js"> </script> 
    <script src="<?= BASEURL ?>/view/js/findUsuario.js"> </script> 

<?php  
require_once(__DIR__ . "/../../../include/footer.php");
?>