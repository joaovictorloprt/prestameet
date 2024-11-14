<?php
require_once ("inc/header.php");
require_once('functions.php');

$db = open_database();

if(isset($_GET['id'])){
    if($_GET['id'] == null) {echo "Nenhum dado encontrado com este id..."; }else{
    $query = $db->query("SELECT * FROM contas WHERE id = ".$_GET['id']);
    if($query->rowCount() == 0){echo "Nenhum dado encontrado com este id..."; } else {
    $customers = $query->fetchAll();
        if(isset($_POST['id'])){
            atualizar("contas","`nome`='".$_POST['nome']."',`login`='".$_POST['login']."',`id_cliente`='".$_POST['id_cliente']."',
        `tipo_conta`='".$_POST['tipo_conta']."',`admin`='".$_POST['admin']."',`data_criado`='".$_POST['data_criado']."',
        `online`='".$_POST['online']."',`foto`='".$_POST['foto']."',`novato`='".$_POST['novato']."',
        `biografia`='".$_POST['biografia']."',`informacoes`='".$_POST['informacoes']."',`id_casa`='".$_POST['id_casa']."' WHERE id = ".$_POST['id']);
        }
?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Todas as Contas
                <small>Ações disponíveis para as contas de usuários</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li><a href="#">Listar</a></li>
                <li><a href="#">Contas</a></li>
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
                            <label>Login</label>
                            <input type="text" name="login" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['login']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="text" disabled class="form-control" placeholder="Enter ..." value="<?php echo $customers['senha']; ?>">
                        </div>
                        <div class="form-group">
                            <label>ID Pessoal</label>
                            <input type="text" name="id_cliente" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_cliente']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tipo de Conta</label>
                            <input type="text" name="tipo_conta" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['tipo_conta']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Administrador</label>
                            <input type="text" name="admin" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['admin']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Data de Criação</label>
                            <input type="text" name="data_criado" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['data_criado']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Online</label>
                            <input type="text" name="online" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['online']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="text" name="foto" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['foto']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Novato</label>
                            <input type="text" name="novato" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['novato']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Biografia</label>
                            <textarea class="form-control" required placeholder="Enter ..." name="biografia"><?php echo $customers['biografia']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Informações</label>
                            <textarea class="form-control" required placeholder="Enter ..." name="informacoes"><?php echo $customers['informacoes']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>ID da Casa</label>
                            <input type="text" name="id_casa" required class="form-control" placeholder="Enter ..." value="<?php echo $customers['id_casa']; ?>">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">SALVAR</button>
                    </form>
                </div>
            </div>

        </section>
    </div>

<?php }}} ?>
<?php require_once ("inc/footer.php"); ?>