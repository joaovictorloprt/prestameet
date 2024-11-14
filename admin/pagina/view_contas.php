<?php
require_once ("inc/header.php");
require_once('functions.php');
view($_GET['id']);
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
                <li><a href="#">Ver</a></li>
                <li><a href="#">Conta</a></li>
                <li class="active"><?php echo $customer['nome']; ?></li>
            </ol>
        </section>

        <section class="content">
            <hr>
            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
            <?php endif; ?>
            <dl class="dl-horizontal">
                <dt>Nome:</dt>
                <dd><?php echo $customer['nome']; ?></dd>
                <dt>Login:</dt>
                <dd><?php echo $customer['login']; ?></dd>
                <dt>Foto:</dt>
                <dd><?php echo $customer['foto']; ?></dd>
                <dt>Data de Criação:</dt>
                <dd><?php echo $customer['data_criado']; ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>ID Pessoal:</dt>
                <dd><?php echo $customer['id_cliente']; ?></dd>
                <dt>ID Casa Principal:</dt>
                <dd><?php echo $customer['id_casa']; ?></dd>
                <dt>Tipo de Conta:</dt>
                <dd><?php echo $customer['tipo_conta']; ?></dd>
                <dt>Administrador:</dt>
                <dd><?php echo $customer['admin']; ?></dd>
                <dt>Novato:</dt>
                <dd><?php echo $customer['novato']; ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Biografia:</dt>
                <dd><?php echo $customer['biografia']; ?></dd>
                <dt>Informações:</dt>
                <dd><?php echo $customer['informacoes']; ?></dd>
            </dl>
            <div id="actions" class="row">
                <div class="col-md-12">
                    <a href="edit_contas.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="contas.php" class="btn btn-default">Voltar</a>
                </div>
            </div>


        </section>
    </div>
<?php require_once ("inc/footer.php"); ?>