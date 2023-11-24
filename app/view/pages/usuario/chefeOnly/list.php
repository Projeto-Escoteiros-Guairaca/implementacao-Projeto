<?php

require_once(__DIR__ . "/../../../include/header.php");
require_once(__DIR__ . "/../../../include/menu.php");
require_once(__DIR__ . "/../../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../../dao/MatilhaDAO.php");
require_once(__DIR__ . "/../../../../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../../matilha/selectMatilha.php");
require_once(__DIR__ . "/../selectPapeis.php");
require_once(__DIR__ . "/../../../../model/Usuario.php");
if($_SESSION['chefeMatilha'] != null) {
    $chefe = 1;
}
else {
    $chefe = 0;
}
?>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/list.css" />
    <h3 class='text-center'>Usuários</h3>

    <div class=" col-12 container">
            <div  class="col-3 filtro_usu">
                 <label> Buscar usuário</label>
                 <input type="text" name="buscar" id="buscar" oninput="findUsuario('<?= BASEURL ?>', <?= $_SESSION[SESSAO_USUARIO_ID] ?>)">
             </div>
            <div class="row">
                <div class="col-9">
                    <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
                </div>
             </div>
        <div class="row col-12" >
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
                                <p class="card-text"><?php echo $usu->getContato()->getEmail();?></p>
                                <p class="card-text">
                                    <?php
                                    if($_SESSION['chefeMatilha'] == null) {
                                        $usuario = new Usuario();
                                        $papeis = new UsuarioPapel();
                                        $arrayPapeis = $papeis->getAllAsArray();
                                        $usuario->setPapeisAsArray($arrayPapeis);
                                    
                                        SelectPapeis::desenhaSelect($usu, $usuario->getPapeisAsArray(), "papel_usuario");
                                    }
                                    ?>
                                </p>
                                <p>
                                <?php
                                    if ($usu->getStatus() == 'ATIVO') {
                                        echo "<a id='status".$usu->getId()."' class='btn btn-outline-success' onclick='sendChange(1, ".$usu->getId().");' >ATIVO</a>";
                                    } else {
                                        echo "<a id='status".$usu->getId()."' class='btn btn-outline-danger' onclick='sendChange(0, ".$usu->getId().")'>INATIVO</a>";
                                    }
                                    ?>
                                </p>
                                <?php
                                    if($_SESSION['chefeMatilha'] == null) {
                                    $idUsu = $usu->getId();
                                        if($usu->getMatilha()) { 
                                            $class = "btn_gravar";
                                            $nomeMatilha = $usu->getMatilha()->getNomeMatilha();
                                        } else { 
                                            $class = "btn_limpar";
                                            $nomeMatilha = "sem matilha";
                                        }
                                        if($usu->getIdMatilha()) {$idMatilha = $usu->getIdMatilha();} else {$idMatilha = 0;}
                                        echo <<<END
                                            <button class="$class" id="$idUsu" onclick="findTheMatilhas($idMatilha, 'getAlcateiasAndMatilhas', $idUsu);"> 
                                            $nomeMatilha
                                            </button> 
                                        END;
                                    }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>     
        </div>
    </div>
    <script> CHEFE = '<?= $chefe ?>';</script>
    <script src="<?= BASEURL ?>/view/js/usuario.js"></script> 
    <script src="<?= BASEURL ?>/view/js/findUsuario.js"></script>
    
    <?php  
    require_once(__DIR__ . "/../../../include/footer.php");
    ?> 