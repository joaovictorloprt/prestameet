<?php
require_once ("inc/header.php");
require_once('functions.php');

$db = open_database();

if(isset($_GET['id'])){
    if($_GET['id'] == null) {echo "Nenhum dado encontrado com este id..."; }else{
    $query = $db->query("SELECT * FROM casa WHERE id = ".$_GET['id']);
    if($query->rowCount() == 0){echo "Nenhum dado encontrado com este id..."; } else {
    $customers = $query->fetchAll();
        if(isset($_POST['id'])){
            atualizar("casa"," `telefone`='".$_POST['telefone']."',`rua`='".$_POST['rua']."',`bairro`='".$_POST['bairro']."',
            `numero`='".$_POST['numero']."',`cidade`='".$_POST['cidade']."',`cep`='".$_POST['cep']."',`complemento`='".$_POST['complemento']."',
            `id_cliente`='".$_POST['id_cliente']."',`latitude`='".$_POST['latitude']."',`longitude`='".$_POST['longitude']."' WHERE id = ".$_POST['id']);
        }
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
                <li><a href="#">Casas</a></li>
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
                            <label>Telefone:</label>
                            <input type="text" name="telefone" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['telefone']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Rua:</label>
                            <input type="text" name="rua" required class="form-control" placeholder="Enter ..." value="<?php echo ($customers['rua']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input type="text" name="bairro" required class="form-control" placeholder="Enter ..." value="<?php echo ($customers['bairro']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Número:</label>
                            <input type="text" name="numero" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['numero']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Cidade:</label>
                            <input type="text" name="cidade" required class="form-control" placeholder="Enter ..." value="<?php echo ($customers['cidade']); ?>">
                        </div>
                        <div class="form-group">
                            <label>CEP:</label>
                            <input type="text" name="cep" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['cep']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Complemento:</label>
                            <input type="text" name="complemento" required class="form-control" placeholder="Enter ..." value="<?php echo ($customers['complemento']); ?>">
                        </div>
                        <div class="form-group">
                            <label>ID do Cliente:</label>
                            <input type="text" name="id_cliente" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_cliente']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Latitude:</label>
                            <input type="text" name="latitude" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['latitude']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Longitude:</label>
                            <input type="text" name="longitude" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['longitude']; ?>">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">SALVAR</button>
                    </form>
                </div>
            </div>

        </section>
    </div>

<?php }}} ?>
<?php require_once ("inc/footer.php"); ?>