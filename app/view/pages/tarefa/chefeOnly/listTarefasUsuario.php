<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema
require_once(__DIR__ . "/../../../include/header.php");
require_once(__DIR__ . "/../../../include/menu.php");
require_once(__DIR__ . "/../../../../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../../../../dao/AlcateiaDAO.php");
require_once(__DIR__ . "/../../alcateia/selectAlcateia.php");

?>
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/list.css" />
    <br>
    <h3 class='text-center'>Estado da tarefa "<?php echo $dados['tarefa']->getNomeTarefa(); ?>"</h3>

    <div class='container'>
        <div class="row">
            <div class="col-9">
                <?php require_once(__DIR__ . "/../../../include/msg.php"); ?>
            </div>
        </div>

        <div id="pinto" class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabUsuarios" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>       
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($dados["lista"]) == 0) : ?>
                            <tr>
                                <td colspan="6">Nenhum usuário encontrado, tente novamente.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($dados["lista"] as $usu): 
                                if($usu->getId() == $_SESSION[SESSAO_USUARIO_ID]) {
                                    continue;
                                }
                                ?>
                                <tr>
                                    <td><?= $usu->getNome(); ?></td>
                                    <?php if($usu->getTarefaEnviada() == true) {
                                        echo '<td>
                                        <a class="btn btn-success" 
                                        href="'.BASEURL.'/Controller/TarefaController.php?action=openTarefaUsuario&id='.$dados["tarefa"]->getIdTarefa().'"> tarefa enviada </a>
                                        </td> ';
                                    }
                                    else {
                                        echo '<td>
                                        <a class="btn btn-danger" 
                                        > Tarefa sem enviar </a>
                                        </td> ';
                                    }
                                    
                                    ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?= BASEURL ?>/view/js/usuario.js"> </script> 

<?php  
require_once(__DIR__ . "/../../../include/footer.php");
?>