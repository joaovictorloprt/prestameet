<?php
require_once ("inc/header.php");
require_once('functions.php');
view_chamado($_GET['id']);
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
                <li><a href="#">Ver</a></li>
                <li class="active"><a href="#">Chamado</a></li>
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
                <dt>Comentário:</dt>
                <dd><?php echo $customer['comentario']; ?></dd>
                <dt>Serviços:</dt>
                <dd><?php echo $customer['id_servicos']; ?></dd>
                <dt>Adicionais:</dt>
                <dd><?php echo $customer['adicionais']; ?></dd>
                <dt>ID do Prestador:</dt>
                <dd><?php echo $customer['id_prestador']; ?></dd>
                <dt>ID do Cliente:</dt>
                <dd><?php echo $customer['id_cliente']; ?></dd>
                <dt>ID da Casa:</dt>
                <dd><?php echo $customer['id_casa']; ?></dd>
                <dt>Avaliação:</dt>
                <dd><?php echo $customer['avaliacao']; ?></dd>
                <dt>Ativo:</dt>
                <dd><?php echo $customer['ativo']; ?></dd>
                <dt>Data Aberto:</dt>
                <dd><?php echo $customer['data_aberto']; ?></dd>
                <dt>Data Fim:</dt>
                <dd><?php echo $customer['data_fim']; ?></dd>
            </dl>
            <div id="actions" class="row">
                <div class="col-md-12">
                    <a href="edit_chamado.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="chamados.php" class="btn btn-default">Voltar</a>
                </div>
            </div>


        </section>
    </div>
<?php require_once ("inc/footer.php"); ?>