<?php
require_once ("inc/header.php");
require_once('functions.php');

$db = open_database();

if(isset($_GET['id'])){
    if($_GET['id'] == null) {echo "Nenhum dado encontrado com este id..."; }else{
    $query = $db->query("SELECT * FROM chamados WHERE id = ".$_GET['id']);
    if($query->rowCount() == 0){echo "Nenhum dado encontrado com este id..."; } else {
    $customers = $query->fetchAll();
        if(isset($_POST['salvar'])){
            $query2 = $db->query("UPDATE chamados SET `comentario`='".$_POST['comentario']."',`id_servicos`='".$_POST['id_servicos']."',`id_casa`='".$_POST['id_casa']."',
            `id_prestador`='".$_POST['id_prestador']."',`id_cliente`='".$_POST['id_cliente']."',`data_aberto`='".$_POST['data_aberto']."',
            `data_fim`='".$_POST['data_fim']."',`avaliacao`='".$_POST['avaliacao']."',`ativo`='".$_POST['ativo']."',`adicionais`='".$_POST['adicionais']."' WHERE id = ".$_GET['id']);
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
                            <label>ID</label>
                            <input type="text" name="id" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Comentário</label>
                            <textarea name="comentario" class="form-control" placeholder="Enter ..."><?php echo $customers['comentario']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Serviços</label>
                            <input type="text" name="id_servicos" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_servicos']; ?>">
                        </div>
                        <div class="form-group">
                            <label>ID da Casa</label>
                            <input type="text" name="id_casa" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_casa']; ?>">
                        </div>
                        <div class="form-group">
                            <label>ID do Prestador</label>
                            <input type="text" name="id_prestador" class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_prestador']; ?>">
                        </div>
                        <div class="form-group">
                            <label>ID do Cliente</label>
                            <input type="text" name="id_cliente" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_cliente']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Adicionais</label>
                            <textarea name="adicionais" class="form-control" placeholder="Enter ..."><?php echo $customers['adicionais']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Avaliação</label>
                            <input type="text" name="avaliacao" class="form-control" placeholder="Enter ..." value="<?php echo $customers['avaliacao']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Ativo</label>
                            <input type="text" name="ativo" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['ativo']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Data Aberto</label>
                            <input type="text" name="data_aberto" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['data_aberto']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Data Fim</label>
                            <input type="text" name="data_fim" class="form-control" placeholder="Enter ..." value="<?php echo $customers['data_fim']; ?>">
                        </div>

                        <button type="submit" name="salvar" class="btn btn-success btn-block">SALVAR</button>
                    </form>
                </div>
            </div>

        </section>
    </div>

<?php }}} ?>
<?php require_once ("inc/footer.php"); ?>