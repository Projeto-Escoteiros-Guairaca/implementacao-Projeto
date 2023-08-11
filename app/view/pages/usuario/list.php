<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
require_once(__DIR__ . "/../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../alcateia/selectAlcateia.php");

?>
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/list.css" />

    <h3 class='text-center'>Usuários</h3>

    <div class='container'>
        <div class="row">
            <div class="col-3">
                <a class="btn btn-success" href="<?= BASEURL ?>/controller/UsuarioController.php?action=create">Inserir</a>
            </div>

            <div class="col-9">
                <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
            </div>
        </div>

        <div id="pinto" class="row" style="margin-top: 10px;">
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
                    <tbody>
                        <?php if (count($dados["lista"]) == 0) : ?>
                            <tr>
                                <td colspan="6">Nenhum usuário encontrado, tente novamente.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($dados["lista"] as $usu): ?>
                                <tr>
                                    <td><?= $usu->getNome(); ?></td>
                                    <td><?= $usu->getLogin(); ?></td>
                                    <td><?= $usu->getPapeisStr(); ?></td>
                                    <td>
                                        <?php if($usu->getStatus() == 'ATIVO'): ?>
                                            
                                        <?php else: ?>

                                        <?php endif; ?>


                                        <?php
                                        if ($usu->getStatus() == 'ATIVO') {
                                            echo "<a class='btn btn-outline-success' onclick=\"return confirm('Deseja alterar o status do usuário para INATIVO?')\" href='". BASEURL ."/controller/UsuarioController.php?action=updateToInativo&id=". $usu->getId() ."'>ATIVO</a>";
                                        } else {
                                            echo "<a class='btn btn-outline-danger' onclick=\"return confirm('Deseja alterar o status do usuário para ATIVO?')\" href='". BASEURL ."/controller/UsuarioController.php?action=updateToAtivo&id=". $usu->getId() ."'>INATIVO</a>";
                                        }
                                        ?>
                                    </td>

                                    <td>   
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

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>