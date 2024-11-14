<?php
require_once ("inc/header.php");
require_once('functions.php');

$db = open_database();


$contas=$db->query("SELECT * FROM contas WHERE login = '".$_COOKIE['email']."' AND senha = '".$_COOKIE['password']."'")->fetchAll();

if(isset($_REQUEST['editor1'])){
    $sql = "INSERT INTO postagem VALUES (NULL, '".$contas['id']."','".$_REQUEST['editor1']."','0',NOW(),'3')";
    $result = $db->query($sql);
}

?>


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Página Principal
                <small>Relatórios</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li class="active">Relatórios</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $db->query("SELECT id FROM chamados;")->rowCount(); ?></h3>

                            <p>Chamados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="chamados.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $db->query("SELECT id FROM postagem;")->rowCount(); ?></sup></h3>

                            <p>Postagens</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="postagens.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $db->query("SELECT id FROM contas;")->rowCount(); ?></h3>

                            <p>Usuários Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="contas.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $db->query("SELECT id FROM prestador WHERE avaliacoes <> 0;")->rowCount(); ?></h3>

                            <p>Prestadores Avaliados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="prestadores.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?php echo $db->query("SELECT id FROM clientes WHERE avaliacoes <> 0;")->rowCount(); ?></h3>

                            <p>Clientes Avaliados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="prestadores.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-white">
                        <div class="inner">
                            <h3><?php echo $db->query("SELECT id FROM casa;")->rowCount(); ?></h3>

                            <p>Casas Cadastradas</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <a href="casas.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>R$ <?php //$TOT = $db->query("SELECT IFNULL(SUM(valor), 0) as soma FROM servicos;")->fetchAll(); echo $tot['soma']; ?></h3>

                            <p>Dinheiro Arrecadado</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="chamados.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">TOP 3 CHAMADOS</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <?php
                        $sql="SELECT * FROM `chamados` INNER JOIN `contas` ON chamados.id_cliente = contas.id_cliente WHERE tipo_conta = '1'";
                        $query=$db->query($sql);
                        $i = 0;
                        if ($query->rowCount() != 0) { ?>
                            <?php foreach($query->fetchAll() as $customer){
                                $sql2="SELECT * FROM `chamados` WHERE id_cliente = '".$customer['id_cliente']."'";
                                $query2=$db->query($sql2);
                                $fetch = $query2->rowCount();

                                ?>
                                <div style="display: block; <?php if($i > 0){ echo 'margin-top:-15px;'; } ?>">
                                    <div class="info-box bg-gray">
                                        <span class="info-box-icon"><img style="margin-top: -10px" src="<?php echo $customer['foto']; ?>"> </span>

                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo $customer['nome']; ?></span>
                                            <span class="info-box-number"><?php echo $fetch; ?></span>
                                            <span class="progress-description">
                                        Curtidas
                                    </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <?php $i++; }} ?>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">TOP 3 ATENDIMENTOS</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <?php
                        $sql="SELECT * FROM `chamados` INNER JOIN `contas` ON chamados.id_prestador = contas.id_cliente WHERE tipo_conta = '2'";
                        $query=$db->query($sql);
                        $i = 0;
                        if ($query->rowCount() != 0) { ?>
                            <?php foreach($query->fetchAll() as $customer){
                                $sql2="SELECT * FROM `chamados` WHERE id_prestador = '".$customer['id_prestador']."'";
                                $query2=$db->query($sql2);
                                $fetch = $query2->rowCount();

                                ?>
                                <div style="display: block; <?php if($i > 0){ echo 'margin-top:-15px;'; } ?>">
                                    <div class="info-box bg-purple">
                                        <span class="info-box-icon"><img style="margin-top: -10px" src="<?php echo $customer['foto']; ?>"> </span>

                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo $customer['nome']; ?></span>
                                            <span class="info-box-number"><?php echo $fetch; ?></span>
                                            <span class="progress-description">
                                        Curtidas
                                    </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <?php $i++; }} ?>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">TOP 3 POSTAGENS</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <?php
                        $sql="SELECT * FROM postagem ORDER BY curtidas DESC LIMIT 3;";
                        $query=$db->query($sql);
                        $i = 0;
                        if ($query->rowCount() != 0) { ?>
                        <?php foreach($query->fetchAll() as $customer){
                            $user = select("contas", " WHERE id = ".$customer['id_conta']);
                            ?>
                        <div style="display: block; <?php if($i > 0){ echo 'margin-top:-15px;'; } ?>">
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><img style="margin-top: -10px" src="<?php echo $user['foto']; ?>"> </span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo $user['nome']; ?></span>
                                    <span class="info-box-number"><?php echo $customer['curtidas']; ?></span>
                                    <span class="progress-description">
                                        Curtidas
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <?php $i++; }} ?>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <div class="box box-info collapsed-box">
                <div class="box-header">
                    <i class="fa fa-edit"></i>

                    <h3 class="box-title">Publicação de Avisos</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body">
                    <form method="post">
                        <textarea id="editor1" name="editor1" rows="10" cols="80">

                    </textarea>
                </div>
                <div class="box-footer clearfix">
                    <input type="submit" class="pull-right btn btn-default" id="sendEmail" value="PUBLICAR"/>
                    </form>
                </div>
            </div>
<?php
$i=0;
$sql = "SELECT * FROM postagem WHERE tipo='3' ORDER BY id DESC";
$result = $db->query($sql);

if($result->rowCount() == 0){} else {
    foreach ($result->fetchAll() as $postagem) {
        $contas_post = $db->query("SELECT * FROM contas WHERE id = ". $postagem['id_conta'])->fetchAll();
        $i++;
        ?>

        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img class="img-circle" src="<?php echo $contas_post['foto']; ?>" alt="Minha Foto">
                    <span class="username"><a href="#"><?php echo utf8_decode($contas_post['nome']); ?></a></span>
                    <span class="description">AVISO - <?php echo date("d/M. Y h:i", strtotime($postagem['data'])); ?></span>
                </div>
                <!-- /.user-block -->
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php echo $postagem['conteudo']; ?>
            </div>
        </div>
<?php }}?>

        </section>
    </div>

    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
<?php require_once ("inc/footer.php"); ?>