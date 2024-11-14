<?php


$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");

if (isset($_REQUEST['editor1'])) {
    $sql = "INSERT INTO postagem VALUES (NULL, '" . $contas['id'] . "','" . $_REQUEST['editor1'] . "','0',NOW(),'1')";
    $result = $db->query($sql);
}

if (isset($_REQUEST['conteudo_comentario'])) {
    $sql = "INSERT INTO comentarios VALUES (NULL, '" . $contas['id'] . "','" . $_GET['post'] . "','" . $_REQUEST['conteudo_comentario'] . "',NOW())";
    $result = $db->query($sql);
}
if ($contas['tipo_conta'] == 2) {
?>
    <br />
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-info"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><i class="fa fa-warning text-yellow"></i> Oops!</span>
                <span class="info-box-number">Sua conta não é de Cliente...</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <?php
} else {

    if ($contas['novato'] != 1) {
    ?>
        <section class="content-header">
            <h1>
                Principal
                <small>Página inicial</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
                <li class="active">Principal</li>
            </ol>

        </section>
    <?php } ?>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <a href="?page=chamados" class="small-box-footer">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h1> Meus <br>Chamados </h1>

                            <p></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>

                    </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <a href="?page=chamar" class="small-box-footer">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h1> Fazer <br>Chamada </h1>


                        </div>
                        <div class="icon">
                            <i class="ion  ion-location"></i>
                        </div>

                    </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-5 col-xs-12">
                <!-- small box -->
                <a href="?page=perfil&user=<?php echo $contas['login']; ?>" class="small-box-footer">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h1> Minha página <br> de Perfil </h1>

                            <p> </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>

                    </div>
                </a>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Chat box -->

                <!-- quick email widget -->
                <div class="box box-info collapsed-box">
                    <div class="box-header">
                        <i class="fa fa-edit"></i>

                        <h3 class="box-title">Publicação</h3>
                        <!-- tools box -->
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body" style="display: none;">
                        <form method="post">
                            <textarea id="editor1" name="editor1" rows="10" cols="80"></textarea>
                    </div>
                    <div class="box-footer clearfix" style="display: none;">
                        <input type="submit" class="pull-right btn btn-default" id="sendEmail" value="PUBLICAR" />
                        </form>
                    </div>
                </div>
                <!-- /.Left col -->



                <?php
                $i = 0;
                $sql = "SELECT * FROM postagem WHERE id_conta = " . $contas['id'] . " ORDER BY id DESC";
                $result = $db->query($sql);

                if ($result->rowCount() == 0) {
                } else {
                    foreach ($result->fetchAll() as $postagem) {
                        $i++;
                        $sqlc = "SELECT * FROM comentarios WHERE id_postagem = " . $postagem['id'];
                        $resultc = $db->query($sqlc);
                        $cont_c = $resultc->rowCount();
                ?>

                        <!-- Box Comment -->
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <div class="user-block">
                                    <img class="img-circle" src="<?php echo $contas['foto']; ?>" alt="Minha Foto">
                                    <span class="username"><a href="#"><?php echo $contas['nome']; ?></a></span>
                                    <span class="description"><?php if ($postagem['tipo'] == 1) {
                                                                    echo "Postagem Pública";
                                                                } ?> - <?php echo date("d/M. Y h:i", strtotime($postagem['data'])); ?></span>
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
                                <br />
                            </div>
                            <div class="panel-footer">
                                <a href="index?page=principal&amp;like=<?php echo $postagem['id']; ?>" style="color: #919191">
                                    <span class="glyphicon glyphicon-thumbs-up"></span> <span id="likes"><?php echo $postagem['curtidas']; ?></span> Likes</a>
                                &nbsp; &nbsp; <label data-toggle="collapse" data-target="#comentarioid_<?php echo $postagem['id']; ?>" class="" aria-expanded="true"><span class="glyphicon glyphicon-comment"></span> &nbsp;<?php echo $cont_c; ?> Comentário(s)</label>
                                <div id="comentarioid_<?php echo $postagem['id']; ?>" class="fade collapse" aria-expanded="true">
                                    <hr style="margin: 5px 0px 5px 0px; margin-bottom:10px;">

                                    <?php
                                    $i = 0;

                                    if ($cont_c == 0) {
                                        echo '<div class="box-footer box-comments"><center>Nenhum comentário...</center></div>';
                                    } else {
                                        foreach ($resultc->fetchAll() as $comentario) {
                                            $user_comentario = select("contas", " WHERE id = " . $comentario['id_conta']);
                                            $i++;
                                    ?>

                                            <div class="box-comment">
                                                <div class="media" style="margin-top:-10px;">
                                                    <div class="media-left media-top">
                                                        <img class="img-circle img-sm" src="<?php echo $user_comentario['foto']; ?>" alt="User Image">
                                                    </div>
                                                    <div class="media-body" style="max-width:720px"><a href="?page=perfil&amp;pesquisa=Ilco"><?php echo $user_comentario['nome']; ?></a>
                                                        <?php echo $comentario['conteudo']; ?><br>
                                                        <span class="text-muted"><?php echo date("d/M. Y - H:i:s", strtotime($comentario['data'])); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin: 5px 0px 5px 0px; margin-bottom:10px;">
                                            <p style="margin: 0 0 10px;"></p>
                                    <?php }
                                    } ?>
                                </div>
                                <form action="?page=<?php echo $_SESSION['pagina']; ?>&post=<?php echo $postagem['id']; ?>" method="post">
                                    <img class="img-responsive img-circle img-sm" src="<?php echo $contas['foto']; ?>" alt="Foto">

                                    <div class="img-push">
                                        <input type="text" required name="conteudo_comentario" id="conteudo_comentario" class="form-control input-sm" placeholder="Aperte a tecla Enter para comentar...">
                                    </div>
                                </form>
                            </div>

                        </div>

                <?php }
                } ?>



            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
        </div>
        <!-- /.row -->
    </section>
    <!-- right col -->
    <!-- /.row (main row) -->

    </section>
<?php } ?>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>