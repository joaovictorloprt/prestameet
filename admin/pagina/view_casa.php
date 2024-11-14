<?php
require_once ("inc/header.php");
require_once('functions.php');
view_casa($_GET['id']);
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
                <li><a href="#">Ver</a></li>
                <li class="active"><a href="#">Casa</a></li>
            </ol>
        </section>

        <section class="content">
            <hr>
            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
            <?php endif; ?>
            <dl class="dl-horizontal">
                <dt>ID:</dt>
                <dd><?php echo $customer['id']; ?></dd>
                <dt>Telefone:</dt>
                <dd><?php echo $customer['telefone']; ?></dd>
                <dt>Rua:</dt>
                <dd><?php echo ($customer['rua']); ?></dd>
                <dt>Bairro:</dt>
                <dd><?php echo ($customer['bairro']); ?></dd>
                <dt>Número:</dt>
                <dd><?php echo ($customer['numero']); ?></dd>
                <dt>Cidade:</dt>
                <dd><?php echo ($customer['cidade']); ?></dd>
                <dt>CEP:</dt>
                <dd><?php echo $customer['cep']; ?></dd>
                <dt>Complemento:</dt>
                <dd><?php echo ($customer['complemento']); ?></dd>
                <dt>ID do Cliente:</dt>
                <dd><?php echo $customer['id_cliente']; ?></dd>
                <dt>Latitude:</dt>
                <dd><?php echo $customer['latitude']; ?></dd>
                <dt>Longitude:</dt>
                <dd><?php echo $customer['longitude']; ?></dd>
            </dl>
            <div id="actions" class="row">
                <div class="col-md-12">
                    <a href="edit_casa.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="postagens.php" class="btn btn-default">Voltar</a>
                </div>
            </div>


        </section>
    </div>
<?php require_once ("inc/footer.php"); ?>