<?php
require_once ("inc/header.php");
require_once('functions.php');
view_postagem($_GET['id']);
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
                <li><a href="#">Ver</a></li>
                <li class="active"><a href="#">Postagens</a></li>
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
                <dt>ID da Conta:</dt>
                <dd><?php echo $customer['id_conta']; ?></dd>
                <dt>Conteúdo:</dt>
                <dd><?php echo $customer['conteudo']; ?></dd>
                <dt>Curtidas:</dt>
                <dd><?php echo $customer['curtidas']; ?></dd>
                <dt>Data:</dt>
                <dd><?php echo $customer['data']; ?></dd>
                <dt>Tipo:</dt>
                <dd><?php echo $customer['tipo']; ?></dd>
            </dl>
            <div id="actions" class="row">
                <div class="col-md-12">
                    <a href="edit_postagem.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="postagens.php" class="btn btn-default">Voltar</a>
                </div>
            </div>


        </section>
    </div>
<?php require_once ("inc/footer.php"); ?>