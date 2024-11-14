<?php
require_once ("inc/header.php");
require_once('functions.php');

$db = open_database();

if(isset($_GET['id'])){
    if($_GET['id'] == null) {echo "Nenhum dado encontrado com este id..."; }else{
    $query = $db->query("SELECT * FROM postagem WHERE id = ".$_GET['id']);
    if($query->rowCount() == 0){echo "Nenhum dado encontrado com este id..."; } else {
    $customers = $query->fetchAll();
        if(isset($_POST['id'])){
            atualizar("postagem"," `id_conta`='".$_POST['id_conta']."',`conteudo`='".$_POST['conteudo']."',
            `curtidas`='".$_POST['curtidas']."',`data`='".$_POST['data']."',`tipo`='".$_POST['tipo']."' WHERE id = ".$_POST['id']);
        }
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
                <li><a href="#">Chamados</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>

        <section class="content">
            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php clear_messages(); ?>
            <?php endif; ?>
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar</h3>
                </div>
                <div class="box-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="text" disabled name="id" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label>ID da Conta:</label>
                            <input type="text" name="servicos" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_conta']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Conteúdo:</label>
                            <textarea name="comentario" required class="form-control" placeholder="Enter ..."><?php echo $customers['conteudo']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Curtidas:</label>
                            <input type="text" name="id_prestador" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['curtidas']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Data:</label>
                            <input type="text" name="id_cliente" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['data']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tipo:</label>
                            <input type="text" name="inicio" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['tipo']; ?>">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">SALVAR</button>
                    </form>
                </div>
            </div>

        </section>
    </div>

<?php }}} ?>
<?php require_once ("inc/footer.php"); ?>