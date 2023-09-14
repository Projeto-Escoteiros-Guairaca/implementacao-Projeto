<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../../../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../alcateia/selectAlcateia.php");
require_once(__DIR__ . "/selectPapeis.php");
require_once(__DIR__ . "/../../../model/Usuario.php");

?>
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/list.css" />

    <h3 class='text-center'>Usuários</h3>

    <div class='container'>
        <div class="row">
            <div class="col-9">
                <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
            </div>
        </div>
        <div>
            <label> Buscar usuário</label>
            <input type="text" name="buscar" id="buscar" oninput="findUsuario('<?php echo BASEURL ?>')">
        </div>
        <div id="bruh" class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabUsuarios" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Papeis</th>
                            <th>Status</th>           
                            <th>Mudar Alcateia</th>
                        </tr>
                    </thead>
                    <tbody id="usuarioTable">
                        <?php if (count($dados["lista"]) == 0) : ?>
                            <tr>
                                <td colspan="6">Nenhum usuário encontrado, tente novamente.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($dados["lista"] as $usu): ?>
                                <tr class="usuarioLinha" >
                                    <td class="usuarioColumn"><?= $usu->getNome(); ?></td>
                                    <td class="usuarioColumn"><?= $usu->getLogin(); ?></td>
                                    <td class="usuarioColumn">
                                        <?php
                                            $usuario = new Usuario();
                                            $papeis = new UsuarioPapel();
                                            $arrayPapeis = $papeis->getAllAsArray();
                                            $usuario->setPapeisAsArray($arrayPapeis);
                                        
                                            SelectPapeis::desenhaSelect($usu, $usuario->getPapeisAsArray(), "papel_usuario");
                                        ?>
                                    </td>
                                    <td class="usuarioColumn">
                                        <?php
                                        if ($usu->getStatus() == 'ATIVO') {
                                            echo "<a id='status' class='btn btn-outline-success' onclick='sendChange(1, ".$usu->getId().");' >ATIVO</a>";
                                        } else {
                                            echo "<a id='status' class='btn btn-outline-danger' onclick='sendChange(0, ".$usu->getId().")'>INATIVO</a>";
                                        }
                                        ?>
                                    </td>

                                    <td class="usuarioColumn">   
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
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a class="btn btn-success" 
                href="<?= BASEURL ?>/controller/HomeController.php">Voltar</a>
            </div>
        </div>
    </div>
    <script src="<?= BASEURL ?>/view/js/usuario.js"> </script> 
    <script src="<?= BASEURL ?>/view/js/findUsuario.js"> </script> 

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>