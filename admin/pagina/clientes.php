<?php
require_once ("inc/header.php");
require_once('functions.php');
$db = open_database();
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todas as Contas
                <small>Ações disponíveis para os clientes</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Listar</a></li>
                <li class="active">Clientes</li>
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
                    <h3 class="box-title">Todos os Clientes</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="20%">Nome</th>
                            <th width="20%">Sobrenome</th>
                            <th width="15%">E-Mail</th>
                            <th width="15%">Telefone</th>
                            <th width="30%">CPF</th>
                            <th width="30%">RG</th>
                            <th>Avaliações</th>
                            <th>Foto</th>
                            <th><center>---</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql="SELECT * FROM clientes";
                        $query=$db->query($sql);
                        if ($query->rowCount() != 0) { ?>
                            <?php foreach($query->fetchAll() as $customer){ ?>
                                <tr class="ui-sortable">
                                    <td><?php echo $customer['id']; ?></td>
                                    <td><?php echo $customer['nome']; ?></td>
                                    <td><?php echo $customer['sobrenome']; ?></td>
                                    <td><?php echo $customer['email']; ?></td>
                                    <td><?php echo $customer['telefone']; ?></td>
                                    <td><?php echo $customer['cpf']; ?></td>
                                    <td><?php echo $customer['rg']; ?></td>
                                    <td><?php echo $customer['avaliacoes']; ?></td>
                                    <td><?php echo $customer['foto']; ?></td>
                                    <td style="min-width:65px;">
                                        <a href="view_cliente.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-eye"></i></a>
                                        <a href="edit_cliente.php?id=<?php echo $customer['id']; ?>">
                                            <i class="fa fa-edit"></i></a>
                                        <a href="delete_cliente.php?id=<?php echo $customer['id']; ?>"><i class="fa fa-trash-o"></i></a>
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