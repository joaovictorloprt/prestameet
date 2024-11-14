<?php
require_once ("inc/header.php");
require_once('functions.php');
$db = open_database();
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todos os Chamados
                <small>Ações disponíveis para os Chamados</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Listar</a></li>
                <li class="active">Chamados</li>
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
                    <h3 class="box-title">Todos os Chamados</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="40%">Comentário</th>
                            <th width="20%">Serviços</th>
                            <th width="15%">Adicionais</th>
                            <th width="5%">ID Prestador</th>
                            <th width="5%">ID Cliente</th>
                            <th width="40%">Início</th>
                            <th><center>---</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql="SELECT * FROM chamados";
                        $query=$db->query($sql);
                        if ($query->rowCount() != 0) { ?>
                            <?php foreach($query->fetchAll() as $customer){ ?>
                                <tr class="ui-sortable">
                                    <td><?php echo $customer['id']; ?></td>
                                    <td><?php echo $customer['comentario']; ?></td>
                                    <td><?php echo $customer['id_servicos']; ?></td>
                                    <td><?php echo $customer['adicionais']; ?></td>
                                    <td><?php echo $customer['id_prestador']; ?></td>
                                    <td><?php echo $customer['id_cliente']; ?></td>
                                    <td><?php echo $customer['data_aberto']; ?></td>
                                    <td style="min-width:65px;">
                                        <a href="view_chamado.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-eye"></i></a>
                                        <a href="edit_chamado.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-edit"></i></a>
                                        <a href="delete_chamado.php?id=<?php echo $customer['id']; ?>"><i class="fa fa-trash-o"></i></a>
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