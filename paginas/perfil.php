<?php

if (isset($_POST['informacoes']) || isset($_POST['biografia'])) {
    $db->query("UPDATE contas SET biografia = '" . $_POST['biografia'] . "', informacoes = '" . $_POST['informacoes'] . "' WHERE id = " . $contas['id']);
}
if (isset($_GET['user'])) {
    $perfil = select("contas", " WHERE login = '" . $_GET['user'] . "'");

    if(!empty($perfil)){
        if ($perfil['tipo_conta'] == 1) {
            $perfil_conta = select("clientes", " WHERE id = " . $perfil['id_cliente']);
        } else if ($perfil['tipo_conta'] == 2) {
            $perfil_conta = select("prestador", " WHERE id = " . $perfil['id_cliente']);
        }

        if (isset($_GET['amigo_act'])) {
            if ($_GET['amigo_act'] == "adicionar") {
                if ($perfil['tipo_conta'] == 1) {
                    $sql_act = "INSERT INTO amigos_cliente VALUES (NULL, '" . $perfil['id'] . "', '" . $contas['id'] . "', '0')";
                    $db->query($sql_act);
                } else {
                    $sql_act = "INSERT INTO amigos_prestador VALUES (NULL, '" . $perfil['id'] . "', '" . $contas['id'] . "', '0')";
                    $db->query($sql_act);
                }
                echo "<script>window.location='?page=perfil&user=" . $perfil['login'] . "';</script>";
            } else if ($_GET['amigo_act'] == "remover") {
                if (!empty($_GET['id_amz'])) {
                    if ($perfil['tipo_conta'] == 1) {
                        $sql_act = "DELETE FROM amigos_cliente WHERE id=" . $_GET['id_amz'];
                        $db->query($sql_act);
                    } else {
                        $sql_act = "DELETE FROM amigos_prestador WHERE id=" . $_GET['id_amz'];
                        $db->query($sql_act);
                    }
                }
                echo "<script>window.location='?page=perfil&user=" . $perfil['login'] . "';</script>";
            } else if ($_GET['amigo_act'] == "cancelar") {
                if (!empty($_GET['id_amz'])) {
                    if ($perfil['tipo_conta'] == 1) {
                        $sql_act = "DELETE FROM amigos_cliente WHERE id=" . $_GET['id_amz'];
                        $db->query($sql_act);
                    } else {
                        $sql_act = "DELETE FROM amigos_prestador WHERE id=" . $_GET['id_amz'];
                        $db->query($sql_act);
                    }
                }
                echo "<script>window.location='?page=perfil&user=" . $perfil['login'] . "';</script>";
            }
        }

        $casa = select("casa", " WHERE id_cliente = " . $perfil_conta['id']);
        if ($contas['novato'] != 1) {
    ?>
            <section class="content-header">
                <h1>
                    Página de Perfil
                    <small>Veja a página de perfil do usuário que você pesquisou...</small>
                </h1>

                <ol class="breadcrumb">
                    <li><a href="?page=principal"><i class="fa fa-dashboard"></i> Início</a></li>
                    <li class="active">Perfil do Usuário</li>
                </ol>

            </section>
        <?php } ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black" style="background: url('<?php echo $perfil['foto']; ?>') center center;">
                            <h3 class="widget-user-username"><?php echo $perfil['nome']; ?></h3>
                            <h5 class="widget-user-desc"><?php if ($perfil['tipo_conta'] == 1) {
                                                                echo "Cliente";
                                                            } else {
                                                                echo "Prestador";
                                                            }; ?></h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="<?php echo $perfil['foto']; ?>" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <?php
                                        if ($perfil['tipo_conta'] == 1) {
                                            $sql = "SELECT * FROM amigos_cliente WHERE id_cliente = " . $perfil_conta['id'];
                                            $result = $db->query($sql);
                                        } else {
                                            $sql = "SELECT * FROM amigos_prestador WHERE id_prestador = " . $perfil_conta['id'];
                                            $result = $db->query($sql);
                                        }
                                        ?>
                                        <h5 class="description-header"><?php echo $result->rowCount(); ?></h5>
                                        <span class="description-text">AMIGOS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <?php
                                        if ($perfil['tipo_conta'] == 2) {
                                            $sql = "SELECT * FROM prestador WHERE id = " . $perfil['id_cliente'];
                                            $sql2 = "SELECT IFNULL(SUM(avaliacoes), 0) AS tot FROM prestador WHERE id = " . $perfil['id_cliente'];
                                        } else {
                                            $sql = "SELECT * FROM clientes WHERE id = " . $perfil['id_cliente'];
                                            $sql2 = "SELECT IFNULL(SUM(avaliacoes), 0) AS tot FROM clientes WHERE id = " . $perfil['id_cliente'];
                                        }
                                        $result = $db->query($sql);
                                        $result2 = $db->query($sql2);
                                        $fetch_ava = $result2->fetch();
                                        $soma_ava = $fetch_ava['tot'];
                                        $total_ava = $result->rowCount();
                                        $ava = $soma_ava / $total_ava;
                                        if ($ava >= 5) { ?>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                        <?php } else if ($ava >= 4) { ?>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        <?php } else if ($ava >= 3) { ?>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        <?php } else if ($ava >= 2) { ?>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        <?php } else if ($ava >= 1) { ?>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        <?php } else { ?>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        <?php } ?><br />
                                        <span class="description-text">AVALIAÇÃO</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <?php
                                        if ($perfil['tipo_conta'] == 2) {
                                            $sql = "SELECT * FROM chamados WHERE id_prestador = " . $perfil['id'];
                                            $result = $db->query($sql);
                                        ?>
                                            <h5 class="description-header"><?php echo $result->rowCount(); ?></h5>
                                            <span class="description-text">Serviços Prestados</span>
                                        <?php } else {
                                            $sql = "SELECT * FROM chamados WHERE id_cliente = " . $perfil['id'];
                                            $result = $db->query($sql); ?>
                                            <h5 class="description-header"><?php echo $result->rowCount(); ?></h5>
                                            <span class="description-text">Chamados</span>
                                        <?php } ?>
                                    </div>
                                    <!-- /.description-block -->
                                </div>

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <div class="col-md-3">
                    <?php
                    if ($contas['id'] != $perfil['id']) {
                        if ($perfil['tipo_conta'] == 1) {
                            $sql_a = "SELECT * FROM amigos_cliente WHERE id_cliente = '" . $perfil['id'] . "' AND id_amigo = '" . $contas['id'] . "'";
                        } else {
                            $sql_a = "SELECT * FROM amigos_prestador WHERE id_prestador = '" . $perfil['id'] . "' AND id_amigo = '" . $contas['id'] . "'";
                        }
                        $result_a = $db->query($sql_a);
                        $fetch_a = $result_a->fetch();
                        if (empty($fetch_a)) {
                    ?>

                            <a href="?page=perfil&user=<?php echo $perfil['login']; ?>&amigo_act=adicionar" class="btn btn-primary btn-block"><b>ENVIAR PEDIDO DE AMIZADE</b></a>

                        <?php } else if ($fetch_a['aceito'] == '1') { ?>
                            <a href="?page=perfil&user=<?php echo $perfil['login']; ?>&amigo_act=remover&id_amz=<?php echo $fetch_a['id']; ?>" class="btn btn-danger btn-block"><b>REMOVER AMIGO</b></a>
                        <?php } else { ?>
                            <a href="?page=perfil&user=<?php echo $perfil['login']; ?>&amigo_act=cancelar&id_amz=<?php echo $fetch_a['id']; ?>" class="btn btn-warning btn-block"><b>CANCELAR SOLICITAÇÃO</b></a>
                    <?php }
                    } ?>
                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sobre mim</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Biografia</strong>

                            <p class="text-muted">
                                <?php echo ($perfil['biografia']); ?>
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Localiação</strong>
                            <?php
                            if(empty($casa)){
                                echo '<p class="text-muted"> Nenhum endereço cadastrado. </p><hr>';
                            }else{

                            ?>
                            <p class="text-muted"> <?php echo ($casa['cidade']); ?>: &nbsp;
                                <?php echo ($casa['bairro']); ?>, &nbsp;
                                <?php echo ($casa['rua']); ?>
                            </p>

                            <hr>
                            <?php 
                            }

                            if ($perfil['tipo_conta'] == 2) { ?>
                                <strong><i class="fa fa-pencil margin-r-5"></i> Serviços Prestados</strong>

                                <p>

                                    <?php
                                    $sql = "SELECT * FROM chamados WHERE id_prestador = " . $perfil['id'];
                                    $result = $db->query($sql);
                                    if ($result->rowCount() == 0) {
                                        echo "Nenhum serviço";
                                    } else {

                                        $result = $db->query("SELECT * FROM servicos_prestados");
                                        foreach ($result->fetchAll() as $servico_prestador) {
                                            $i++; ?>
                                            <span class="label label-<?php if ($i == 1) {
                                                                            echo "danger";
                                                                        } else if ($i == 2) {
                                                                            echo "success";
                                                                        } else if ($i == 3) {
                                                                            echo "info";
                                                                        } else if ($i == 4) {
                                                                            echo "warning";
                                                                        } else {
                                                                            echo "primary";
                                                                            $i == 0;
                                                                        } ?>">
                                                <?php echo ($servico_prestador['nome']); ?>
                                            </span>&nbsp;
                                    <?php }
                                    } ?>
                                </p>

                                <hr>
                            <?php } ?>
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Mais Informações...</strong>

                            <p><?php echo ($perfil['informacoes']); ?></p>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#linha_do_tempo" data-toggle="tab">LINHA DO TEMPO</a></li>
                            <?php if ($perfil['login'] == $contas['login']) { ?> <li><a href="#configuracoes" data-toggle="tab">EDITAR PERFIL</a></li> <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="linha_do_tempo">
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

                                        <div id="comentarioid_<?php echo $postagem['id']; ?>" class="fade collapse" aria-expanded="false">
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
                        </div>
                        <?php if ($perfil['login'] == $contas['login']) { ?>
                            <div class="tab-pane" id="configuracoes">
                                <form class="form-horizontal" method="post">
                                    <div class="form-group">
                                        <label for="informacoes" class="col-sm-2 control-label">Mais Informações</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" required id="informacoes" name="informacoes" placeholder="Mais Informações"><?php echo $contas['informacoes']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="biografia" class="col-sm-2 control-label">Biografia</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" required id="biografia" name="biografia" placeholder="Sobre mim..."><?php echo $contas['biografia']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">SALVAR</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
            </div>
            <!-- /.col -->

        </section>
    <?php } else { ?>
        <br />
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><i class="fa fa-warning text-yellow"></i> Oops!</span>
                    <span class="info-box-number">Perfil não foi encontrado...</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    <?php } 
    } else { ?>
    <br />
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><i class="fa fa-warning text-yellow"></i> Oops!</span>
                <span class="info-box-number">Perfil não foi encontrado...</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

<?php } ?>