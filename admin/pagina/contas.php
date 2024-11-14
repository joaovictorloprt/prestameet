<?php
require_once ("inc/header.php");
require_once('functions.php');
$db = open_database();
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todas as Contas
                <small>Ações disponíveis para as contas de usuários</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Listar</a></li>
                <li class="active">Contas</li>
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
                    <h3 class="box-title">Todas as Contas</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="40%">Nome</th>
                            <th width="10%">Login</th>
                            <th width="15%">ID Dados Pessoais</th>
                            <th width="15%">Tipo de Conta</th>
                            <th width="30%">Data</th>
                            <th width="20%">Foto</th>
                            <th>Novato</th>
                            <th>Casa</th>
                            <th><center>---</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql="SELECT * FROM contas";
                        $query=$db->query($sql);
                        if ($query->rowCount() != 0) { ?>
                            <?php foreach($query->fetchAll() as $customer){ ?>
                                <tr class="ui-sortable">
                                    <td><?php echo $customer['id']; ?></td>
                                    <td><?php echo $customer['nome']; ?></td>
                                    <td><?php echo $customer['login']; ?></td>
                                    <td><?php echo $customer['id_cliente']; ?></td>
                                    <td><?php
                                    if($customer['admin']==1) {
                                        echo '<span class="label label-danger">Administrador</span>';
                                    }else{
                                        if ($customer['tipo_conta'] == 2) {
                                            echo '<span class="label label-warning">Prestador</span>';
                                        }else{
                                            echo '<span class="label label-primary">Cliente</span>';
                                        }
                                    }?></td>
                                    <td><?php echo $customer['data_criado']; ?></td>
                                    <td><?php echo $customer['foto']; ?></td>
                                    <td><?php echo $customer['novato']; ?></td>
                                    <td><?php echo $customer['id_casa']; ?></td>
                                    <td style="min-width:65px;">
                                        <a href="view_contas.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-eye"></i></a>
                                        <a href="edit_contas.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-edit"></i></a>
                                        <a href="delete_contas.php?id=<?php echo $customer['id']; ?>"><i class="fa fa-trash-o"></i></a>
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