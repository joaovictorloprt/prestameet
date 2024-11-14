<?php
require_once ("inc/header.php");
require_once('functions.php');
$db = open_database();
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todas as Casas
                <small>Ações disponíveis para as Casas</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Listar</a></li>
                <li class="active">Casas</li>
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
                            <th width="15%">Telefone</th>
                            <th width="5%">Número</th>
                            <th width="25%">CEP</th>
                            <th width="25%">Complemento</th>
                            <th width="25%">ID do Cliente</th>
                            <th><center>---</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql="SELECT * FROM casa";
                        $query=$db->query($sql);
                        if ($query->rowCount() != 0) { ?>
                            <?php foreach($query->fetchAll() as $customer){ ?>
                                <tr class="ui-sortable">
                                    <td><?php echo $customer['id']; ?></td>
                                    <td><?php echo $customer['telefone']; ?></td>
                                    <td><?php echo $customer['numero']; ?></td>
                                    <td><?php echo $customer['cep']; ?></td>
                                    <td><?php echo $customer['complemento']; ?></td>
                                    <td><?php echo $customer['id_cliente']; ?></td>
                                    <td style="min-width:65px;">
                                        <a href="view_casa.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-eye"></i></a>
                                        <a href="edit_casa.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-edit"></i></a>
                                        <a href="delete_casa.php?id=<?php echo $customer['id']; ?>"><i class="fa fa-trash-o"></i></a>
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