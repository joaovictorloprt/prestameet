<?php
require_once ("inc/header.php");
require_once('functions.php');
$db = open_database();
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todas as Postagens
                <small>Ações disponíveis para as Postagens</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Listar</a></li>
                <li class="active">Postagens</li>
            </ol>
        </section>

        <section class="content">

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php clear_messages(); ?>
            <?php endif; ?>
            <hr>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Todas as Postagens</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="15%">ID da Conta</th>
                            <th width="40%">Conteúdo</th>
                            <th width="15%">Curtidas</th>
                            <th width="20%">DATA</th>
                            <th width="5%">Tipo</th>
                            <th><center>---</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql="SELECT * FROM postagem";
                        $query=$db->query($sql);
                        if ($query->rowCount() != 0) { ?>
                            <?php foreach($query->fetchAll() as $customer){ ?>
                                <tr class="ui-sortable">
                                    <td><?php echo $customer['id']; ?></td>
                                    <td><?php echo $customer['id_conta']; ?></td>
                                    <td><?php echo $customer['conteudo']; ?></td>
                                    <td><?php echo $customer['curtidas']; ?></td>
                                    <td><?php echo $customer['data']; ?></td>
                                    <td><?php echo $customer['tipo']; ?></td>
                                    <td style="min-width:65px;">
                                        <a href="view_postagem.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-eye"></i></a>
                                        <a href="edit_postagem.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-edit"></i></a>
                                        <a href="delete_postagem.php?id=<?php echo $customer['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="6">Nenhum registro encontrado.</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
<?php require_once ("inc/footer.php"); ?>