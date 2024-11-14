<?php
require_once ("inc/header.php");
require_once('functions.php');
view_prestador($_GET['id']);
$db = open_database();
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todos os Prestadores
                <small>Ações disponíveis para os Prestadores</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Ver</a></li>
                <li><a href="#">Prestadores</a></li>
                <li class="active"><?php echo $customer['nome']." ".$customer['sobrenome']; ?></li>
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
                <dt>Sobrenome:</dt>
                <dd><?php echo $customer['sobrenome']; ?></dd>
                <dt>Foto:</dt>
                <dd><?php echo $customer['foto']; ?></dd>
                <dt>E-Mail:</dt>
                <dd><?php echo $customer['email']; ?></dd>
                <dt>Telefone:</dt>
                <dd><?php echo $customer['telefone']; ?></dd>
                <dt>CPF:</dt>
                <dd><?php echo $customer['cpf']; ?></dd>
                <dt>RG:</dt>
                <dd><?php echo $customer['rg']; ?></dd>
                <dt>Avaliações:</dt>
                <dd><?php echo $customer['avaliacoes']; ?></dd>
            </dl>
            <div id="actions" class="row">
                <div class="col-md-12">
                    <a href="edit_prestador.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="clientes.php" class="btn btn-default">Voltar</a>
                </div>
            </div>


        </section>
    </div>
<?php require_once ("inc/footer.php"); ?>