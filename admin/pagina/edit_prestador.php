<?php
require_once ("inc/header.php");
require_once('functions.php');

$db = open_database();

if(isset($_GET['id'])){
    if($_GET['id'] == null) {echo "Nenhum dado encontrado com este id..."; }else{
    $query = $db->query("SELECT * FROM prestador WHERE id = ".$_GET['id']);
    if($query->rowCount() == 0){echo "Nenhum dado encontrado com este id..."; } else {
    $customers = $query->fetchAll();
        if(isset($_POST['id'])){
            atualizar("prestador","`nome`='".$_POST['nome']."',`sobrenome`='".$_POST['sobrenome']."',`email`='".$_POST['email']."',`telefone`='".$_POST['telefone']."',
            `cpf`='".$_POST['cpf']."',`rg`='".$_POST['rg']."',`avaliacoes`='".$_POST['avaliacoes']."',`foto`='".$_POST['foto']."' WHERE id = ".$_POST['id']);
        }
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todos os Clientes
                <small>Ações disponíveis para os prestadores</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Listar</a></li>
                <li><a href="#">Prestadores</a></li>
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
                            <input type="text" disabled name="id" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['nome']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Sobrenome</label>
                            <input type="text" name="sobrenome" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['sobrenome']; ?>">
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="text" required name="email" class="form-control" placeholder="Enter ..." value="<?php echo $customers['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['telefone']; ?>">
                        </div>
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" name="cpf" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['cpf']; ?>">
                        </div>
                        <div class="form-group">
                            <label>RG</label>
                            <input type="text" name="rg" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['rg']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Avaliações</label>
                            <input type="text" name="avaliacoes" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['avaliacoes']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="text" name="foto" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['foto']; ?>">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">SALVAR</button>
                    </form>
                </div>
            </div>

        </section>
    </div>

<?php }}} ?>
<?php require_once ("inc/footer.php"); ?>