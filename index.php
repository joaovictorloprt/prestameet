<?php

require_once 'config.php';
require_once 'functions.php';
require_once DBAPI;
$db = open_database();

if (isset($_GET['page'])) {
    $_SESSION['pagina'] = $_GET['page'];
} else {
    if ($_COOKIE['tipo_conta'] == 1) {
        $_SESSION['pagina'] = "principal";
    } else {
        $_SESSION['pagina'] = "principalprestador";
    }
    header("Location: index?page=" . $_SESSION['pagina']);
}

if (!isset($_COOKIE['email']) || !isset($_COOKIE['password']) || !isset($_COOKIE['tipo_conta'])) {
    header("Location: logout");
} else {
    if ($_COOKIE['tipo_conta'] == 1) {
        $contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");
        $user = select("clientes", " WHERE id = " . $contas['id_cliente']);
    } else if ($_COOKIE['tipo_conta'] == 2) {
        $contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");
        $user = select("prestador", " WHERE id = " . $contas['id_cliente']);
    }
}


if (isset($_GET['status'])) {
    if ($_GET['status'] = "online") {
        $sqlstatus = "UPDATE contas SET online = '1' WHERE id = " . $contas['id'];
        $status = $db->query($sqlstatus);
    } else if ($_GET['status'] = "ofline") {
        $sqlstatus = "UPDATE contas SET online = '0' WHERE id = " . $contas['id'];
        $status = $db->query($sqlstatus);
    }
}


if ($_COOKIE['tipo_conta'] == 1) {
    $contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");
    $user = select("clientes", " WHERE id = " . $contas['id_cliente']);
} else if ($_COOKIE['tipo_conta'] == 2) {
    $contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");
    $user = select("prestador", " WHERE id = " . $contas['id_cliente']);
}

if (isset($_GET['amigo'])) {
    if ($_GET['amigo'] == "aceitar") {
        if (!empty($_GET['id_amz'])) {
            if ($contas['tipo_conta'] == 1) {
                $sql_act = "UPDATE amigos_cliente SET aceito='1' WHERE id=" . $_GET['id_amz'];
                $db->query($sql_act);
                $sql_act1 = "UPDATE amigos_prestador SET aceito='1' WHERE id_amigo='" . $contas['id'] . "' AND id_prestador='" . $_GET['id_amigo'] . "'";
                $db->query($sql_act1);
            } else {
                $sql_act = "UPDATE amigos_prestador SET aceito='1' WHERE id=" . $_GET['id_amz'];
                $db->query($sql_act);
                $sql_act1 = "UPDATE amigos_cliente SET aceito='1' WHERE id_amigo=" . $contas['id'] . " AND id_cliente='" . $_GET['id_amigo'] . "'";
                $db->query($sql_act1);
            }
        }
        echo "<script>window.location='?page=" . $_GET['page'] . "';</script>";
    } else if ($_GET['amigo'] == "recusar") {
        if (!empty($_GET['id_amz'])) {
            if ($contas['tipo_conta'] == 1) {
                $sql_act = "DELETE FROM amigos_cliente WHERE id=" . $_GET['id_amz'];
                $db->query($sql_act);
                $sql_act1 = "DELETE FROM amigos_prestador WHERE id_amigo=" . $contas['id'] . " AND id_prestador='" . $_GET['id_amigo'] . "'";
                $db->query($sql_act1);
            } else {
                $sql_act = "DELETE FROM amigos_prestador WHERE id=" . $_GET['id_amz'];
                $db->query($sql_act);
                $sql_act1 = "DELETE FROM amigos_cliente WHERE id_amigo=" . $contas['id'] . " AND id_cliente='" . $_GET['id_amigo'] . "'";
                $db->query($sql_act1);
            }
        }
        echo "<script>window.location='?page=" . $_GET['page'] . "';</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>PrestaMeet</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="./dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./plugins/iCheck/flat/red.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="./plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="./plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="./plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<!-- ./wrapper -->
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9&appId=342124799505455";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- jQuery 2.2.3 -->
    <script src="./plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="./plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="./plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="./plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="./plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="./plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="./plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="./plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="./plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="./plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="./plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="./dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js"></script>
    <script>
        $(document).ready(function() {

            $("#cep").blur(function() {
                var cep = $(this).val().replace(/\D/g, '');

                $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {

                        $("#rua").val(dados.logradouro);

                        $("#bairro").val(dados.bairro);

                        $("#cidade").val(dados.localidade);

                        $("#estado").val(dados.uf);

                    }
                });
            });


            $("#numero").blur(function() {
                $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + $(this).val() + "&key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY", function(data) {
                    latitude = data.results[0].geometry.location.lat;
                    longitude = data.results[0].geometry.location.lng;

                    $("#lat").val(latitude);
                    $("#lng").val(longitude);
                });
            });
        });
    </script>
    <style>
        .loader1 {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            background-color: #ecf0f1;
            background-image: url('./img/preloader.gif');
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>
    <script>
        $(function() {
            $('#datepicker').datepicker({
                language: 'pt-BR',
                autoclose: true
            });
            //Timepicker
            $(".timepicker").timepicker({
                language: 'pt-BR',
                showInputs: false,
                showMeridian: false
            });
            $("[data-mask]").inputmask();
            $("#datemask").inputmask("dd/mm/yyyy", {
                "placeholder": "dd/mm/yyyy"
            });
        });
    </script>
    <script type="text/javascript">
        function mascara(src, mascara) {
            var campo = src.value.length;
            var saida = mascara.substring(0, 1);
            var texto = mascara.substring(campo);

            if (texto.substring(0, 1) != saida) {
                src.value += texto.substring(0, 1);
            }
        }
    </script>
    <![endif]-->
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <script type="text/javascript">
		function fotoInserida(inp, id) {
			if (inp.files.length == 0) {
				console.log("no files selected");
			} else {
				document.getElementById(id).classList.remove("btn-primary");
				document.getElementById(id).classList.add("btn-success");

			};
		}
        function scroll() {
            var objScrDiv = document.getElementById("conversas_chat");
            objScrDiv.scrollTop = objScrDiv.scrollHeight;
        }
        function id(el) {
            return document.getElementById(el);
        }
        function hide(el) {
            id(el).style.display = 'none';//escondendo tudo
        }
        window.onload = function() {
            id('content').style.display = 'block';//liberando qndo terminar
            hide('loader');
        }
    </script>

</head>
<body class="hold-transition skin-purple-light sidebar-mini" onLoad="scroll();">
    <div style="display:block;">
        <div id="loader" class="loader1"></div>
            <div id="content" style="overflow: hidden;">
        <div id="logout-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><span class="fa fa-warning"></span>&nbsp;Opss...</h4>
                    </div>
                    <div class="modal-body">
                        <p>Desejas realmente sair desta conta ?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-default pull-left btn-block" data-dismiss="modal">NAO</button>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <a href="logout"><button type="button" class="btn btn-danger btn-block">SIM</button></a>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <?php if ($_GET['page'] == "chamar") { ?>
				<div id="casa-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title"><span class="fa fa-home"></span>&nbsp;Registrar Uma Casa</h4>
                        </div>
                        <div class="modal-body">
                            <form style = "font-size:12px" class="form-group" method="post">
                                <div class="form-group col-md-3">
                                    <label for="cep">CEP (Números):</label>
                                    <input type="text" name="cep" required class="form-control" id="cep" maxlength="9" value="<?php if (isset($_REQUEST['cep'])) {
                                                                                                                                    echo $_REQUEST['cep'];
                                                                                                                                } ?>"/>
                                </div>

                                <div class="form-group col-md-9">
                                    <label for="rua">Rua:</label>
                                    <input type="text" name="rua" class="form-control" id="rua" size="45" value = "<?php if (isset($_REQUEST['rua'])) {
                                                                                                                        echo $_REQUEST['rua'];
                                                                                                                    } ?>"/>
                                </div>


                                <div class="form-group col-md-2">
                                    <label for="numero">Número:</label>
                                    <input type="text" name="numero" required class="form-control" id="numero" size="5" value="<?php if (isset($_REQUEST['numero'])) {
                                                                                                                                    echo $_REQUEST['numero'];
                                                                                                                                } ?>"/>
                                </div>


                                <div class="form-group col-md-5">
                                    <label for="bairro">Bairro:</label>
                                    <input type="text" name="bairro" class="form-control" id="bairro" size="25" value = "<?php if (isset($_REQUEST['bairro'])) {
                                                                                                                                echo $_REQUEST['bairro'];
                                                                                                                            } ?>"/>
                                </div>


                                <div class="form-group col-md-5">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" name="cidade" class="form-control" id="cidade" size="25" value = "<?php if (isset($_REQUEST['cidade'])) {
                                                                                                                                echo $_REQUEST['cidade'];
                                                                                                                            } ?>"/>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="estado">Estado:</label>
                                    <input type="text" name="estado" class="form-control" id="estado" size="2" value = "<?php if (isset($_REQUEST['estado'])) {
                                                                                                                            $_REQUEST['estado'];
                                                                                                                        } ?>"/>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="estado">Telefone:</label>
                                    <input type="text" name="telefone" class="form-control" id="telefone" value = "<?php if (isset($_REQUEST['estado'])) {
                                                                                                                        $_REQUEST['estado'];
                                                                                                                    } ?>"/>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="complemento">Complemento:</label>
                                    <input type="text" name="complemento" class="form-control" required id="complemento" placeholder="Ex: Casa, Ap. 24-A" value = "<?php if (isset($_REQUEST['complemento'])) {
                                                                                                                                                                        echo $_REQUEST['complemento'];
                                                                                                                                                                    } ?>"/>
                                </div>

                                <div class="form-group col-md-3">
                                    <input type="text" name="lat" style="display: none;" class="form-control" required id="lat" placeholder="Latitude" size="25" value = "<?php if (isset($_REQUEST['lat'])) {
                                                                                                                                                                                echo $_REQUEST['lat'];
                                                                                                                                                                            } ?>"/>
                                </div>

                                <div class="form-group col-md-3">
                                    <input type="text" name="lng" style="display: none;" class="form-control" required id="lng" placeholder="Longitude" size="25" value = "<?php if (isset($_REQUEST['lng'])) {
                                                                                                                                                                                echo $_REQUEST['lng'];
                                                                                                                                                                            } ?>"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">CANCELAR</button>
                                    <input type="submit" class="btn btn-primary pull-right" name = "salvar" value="REGISTRAR" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
<?php } ?>

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.php?page=principal" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>Meet</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Presta</b>Meet</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <?php
            $i = 0;
            $sql = "SELECT * FROM chat WHERE id_u1 = '" . $contas['id'] . "' OR id_u2 = '" . $contas['id'] . "' ORDER BY id ASC";
            $result123 = $db->query($sql);
            $count_mensagens = $result123->rowCount();
            ?>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success"><?php echo $count_mensagens; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Você tem <?php echo $count_mensagens; ?> Mensagens</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php
                                    foreach ($result123->fetchAll() as $amigo1) {
                                        if ($amigo1['id_u2'] != $contas['id']) {
                                            $id_c = $amigo1['id_u2'];
                                        } else {
                                            $id_c = $amigo1['id_u1'];
                                        }
                                        $u_chat = select("contas", "WHERE id = " . $id_c);
                                        $sqlchat = "SELECT * FROM conversas WHERE id_chat=" . $amigo1['id'] . " AND id_envia != " . $id_c . " ORDER BY id DESC";
                                        $querychat = $db->query($sqlchat);
                                        $chat = $querychat->fetch();
                                        $i++;
                                    ?>


                                        <li>
                                            <a href="?page=<?php echo $_GET['page']; ?>&chat=<?php echo $amigo1['id']; ?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo $u_chat['foto']; ?>" class="img-circle" alt="Foto do Usuário">
                                                </div>
                                                <h4>
                                                    <?php echo $u_chat['nome']; ?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo date("d/M. Y", strtotime($chat['data'])); ?></small>
                                                </h4>
                                                <p><?php echo substr_replace($chat['texto'], ($chat['texto'] > 35 ? '...' : ''), 25); ?></p>
                                            </a>
                                        </li>

                                    <?php } ?>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <?php
                    $sqlnotifica = "SELECT * FROM notificacoes WHERE id_referencia=" . $contas['id'];
                    $querynotifica = $db->query($sqlnotifica);
                    $count_notifica = $querynotifica->rowCount();
                    $i = 0;
                    ?>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning"><?php echo $count_notifica; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Você tem <?php echo $count_notifica; ?> notificações</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php
                                    foreach ($querynotifica->fetchAll() as $notificacoes) {
                                        $i++;
                                        $recebe = select("contas", " WHERE id = " . $notificacoes['id_usuario']);
                                    ?>
                                        <li>
                                            <a href="<?php echo $notificacoes['url']; ?>">
                                                <i class="fa fa-users text-aqua"></i>&nbsp;<b><?php echo $recebe['nome']; ?></b> - <?php echo $notificacoes['data']; ?>
												<br><?php echo $notificacoes['conteudo']; ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo $user['foto']; ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $user['nome'] . " " . $user['sobrenome']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo $user['foto']; ?>" class="img-circle" alt="User Image">

                                <p>
                                    <?php echo $user['nome'] . " " . $user['sobrenome']; ?> <?php if ($contas['admin'] == 1) {
                                                                                                echo "- Administrador";
                                                                                            } else if ($contas['tipo_conta'] == 1) {
                                                                                                echo "<br />Cliente";
                                                                                            } else {
                                                                                                echo "<br />Prestador de Serviços";
                                                                                            } ?>
                                    <small>Membro desde <?php echo date("M. Y", strtotime($contas['data_criado'])); ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-5 text-center" style="margin-left:-15px">

                                        <div class="box-tools">
                                            <div class="btn-group">

                                                <a href="?page=<?php echo $_REQUEST['page']; ?>&status=online"><button data-toggle="tooltip" title="ONLINE" type="button" class="btn btn-default btn-sm <?php if ($contas['online'] == 1) {
                                                                                                                                                                                                            echo "active";
                                                                                                                                                                                                        } ?>"><i class="fa fa-square text-green"></i></button>
                                                </a>
                                                <a href="?page=<?php echo $_REQUEST['page']; ?>&status=ofline">
                                                    <button type="button" data-toggle="tooltip" title="OFLINE" class="btn btn-default btn-sm <?php if ($contas['online'] == 0) {
                                                                                                                                                    echo "active";
                                                                                                                                                } ?>"><i class="fa fa-square text-red"></i></button>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-4 text-center" style="margin-left:-10px">
                                        <div style="color:gold">
                                            <?php
                                            if ($_COOKIE['tipo_conta'] == 2) {
                                                $sql = "SELECT * FROM prestador WHERE id = " . $contas['id_cliente'];
                                                $sql2 = "SELECT IFNULL(SUM(avaliacoes), 0) AS tot FROM prestador WHERE id = " . $contas['id_cliente'];
                                            } else {
                                                $sql = "SELECT * FROM clientes WHERE id = " . $contas['id_cliente'];
                                                $sql2 = "SELECT IFNULL(SUM(avaliacoes), 0) AS tot FROM clientes WHERE id = " . $contas['id_cliente'];
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
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-3 text-center">
                                        <a href=""><span class="glyphicon glyphicon-user"></span> &nbsp;Amigos</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Meu Perfil</a>
                                </div>

                                <div class="pull-right">
                                    <a data-toggle="modal" data-target="#logout-modal" class="btn btn-default btn-flat">Sair</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i data-toggle="tooltip" title="Amigos Online" class="fa fa-users"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image" style="max-width:50px; max-height: 50px">
                    <img src="<?php echo $user['foto']; ?>" style="max-width:50px; max-height: 50px" class="img-circle" alt="Foto de Perfil">
                </div>
                <div class="pull-left info">
                    <p><?php echo $user['nome'] . " " . $user['sobrenome']; ?></p>
                    <?php if ($contas['online'] == 0) {
                        echo '<a><i class="fa fa-circle text-warning"></i> Ofline</a>';
                    } else {
                        echo '<a><i class="fa fa-circle text-success"></i> Online</a>';
                    } ?>
                </div>
            </div>
            <!-- search form -->
            <div class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="palavra" id="palavra" class="form-control" placeholder="Pesquisar Perfil...">
                    <span class="input-group-btn">
                    <button type="button" name="palavra" id="buscar" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <div id="dados"></div>
            </div>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MENU DE NAVEGAÇÃO</li>
                <?php if ($_COOKIE['tipo_conta'] == 1) { ?>

                    <li class="treeview">
                        <a href="?page=principal">
                            <i class="glyphicon glyphicon-home"></i>
                            <span>PRINCIPAL</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=perfil&user=<?php echo $contas['login']; ?>">
                            <i class="glyphicon glyphicon-user"></i>
                            <span>MEU PERFIL</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=chamar">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                            <span>CHAMAR</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=meus_chamados">
                            <i class="fa fa-th"></i> <span>MEUS CHAMADOS</span>
                            <span class="pull-right-container">
                            <small class="label pull-right bg-orange">todos</small>
                        </span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="?page=gastos">
                            <i class="ion ion-cash"></i>
                            <span>MEUS GASTOS</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="?page=config">
                            <i class="glyphicon glyphicon-wrench"></i>
                            <span>CONFIGURAÇÕES</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#logout-modal" >
                            <i class="glyphicon glyphicon-share"></i>
                            <span>SAIR</span>
                        </a>
                    </li>

                <?php } else { ?>

                    <li class="treeview">
                        <a href="?page=principalprestador">
                            <i class="glyphicon glyphicon-home"></i>
                            <span>PRINCIPAL</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=perfil&user=<?php echo $contas['login']; ?>">
                            <i class="glyphicon glyphicon-user"></i>
                            <span>MEU PERFIL</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=chamados">
                            <i class="fa fa-th"></i> <span>CHAMADOS</span>
                            <span class="pull-right-container">
                            <small class="label pull-right bg-orange">todos</small>
                        </span>
                        </a>
                    </li>
                   <!--  <li>
                        <a href="?page=ganhos">
                            <i class="ion ion-cash"></i>
                            <span>RENDIMENTO</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="?page=config">
                            <i class="glyphicon glyphicon-wrench"></i>
                            <span>CONFIGURAÇÕES</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#logout-modal" >
                            <i class="glyphicon glyphicon-share"></i>
                            <span>SAIR</span>
                        </a>
                    </li>

                <?php } ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="col-md-3" style="position:fixed;
float: right;
margin-bottom: 0;
z-index: 4;
right: 0px;
bottom: 0px;
 max-width: 100%;">

        <div class="box box-primary direct-chat direct-chat-primary direct-chat-contacts-open collapsed-box">

            <div class="box-header with-border" style="min-width: 30%;">
                <h3 class="box-title" data-widget="collapse">CONVERSAS</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:purple;"><i class="fa fa-plus"></i>
                    </button>
                    <?php if (isset($_GET['chat'])) { ?>
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contatos" data-widget="chat-pane-toggle" style="color:purple;">
                            <i class="fa fa-comments"></i></button>
                    <?php } ?>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" style="color:red;"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="direct-chat-messages">
                    <div id="conversas_chat" name="conversas_chat">
                        <?php
                        if (!isset($_GET['chat'])) {
                        } else {
                            $sql = "SELECT * FROM chat WHERE id=" . $_GET['chat'];
                            $query2 = $db->query($sql);
                            $amigo1 = $query2->fetchAll();
                            $sqlconversas = "SELECT * FROM conversas WHERE id_chat = " . $_GET['chat'];
                            $queryconversas = $db->query($sqlconversas);
                            $i = 0;
                            foreach ($queryconversas->fetchAll() as $conversas) {
                                $i++;
                                if ($conversas['id_envia'] != $user['id']) {
                                    $recebe = select("contas", "WHERE id = " . $conversas['id_envia']);
                        ?>


                                    <div class="direct-chat-msg" style=" word-wrap: break-word;">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"><?php echo ($recebe['nome']); ?></span>
                                            <span class="direct-chat-timestamp pull-right"><?php $dataa = new DateTime($conversas['data']);
                                                                                            echo $dataa->format("d/m h:s"); ?></span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="<?php echo $recebe['foto']; ?>" alt="Foto do Usuário"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            <?php echo ($conversas['texto']); ?>
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>


                                <?php } else { ?>

                                    <div class="direct-chat-msg right" style=" word-wrap: break-word;">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right"><?php echo ($contas['nome']); ?></span>
                                            <span class="direct-chat-timestamp pull-left"><?php $dataa = new DateTime($conversas['data']);
                                                                                            echo $dataa->format("d/m h:s"); ?></span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="<?php echo $contas['foto']; ?>" alt="Minha Foto"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            <?php echo ($conversas['texto']); ?>
                                        </div>
                                    </div>
                                <?php }
                            }
                        } ?>
                    </div>
                    <div id="chat" style="margin-bottom:-20px;"></div>
                </div>
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <?php
                        $i = 0;
                        $sql = "SELECT * FROM chat WHERE id_u1 = '" . $contas['id'] . "' OR id_u2 = '" . $contas['id'] . "' ORDER BY id ASC";
                        $result = $db->query($sql);
                        if ($result->rowCount() == 0) {
                            echo "&nbsp;&nbsp;Você ainda não enviou mensagens...";
                        } else {
                            foreach ($result->fetchAll() as $amigo1) {
                                if ($amigo1['id_u2'] != $contas['id']) {
                                    $id_c = $amigo1['id_u2'];
                                } else {
                                    $id_c = $amigo1['id_u1'];
                                }
                                $recebe = select("contas", "WHERE id = " . $id_c);

                                $sqlchat = "SELECT * FROM conversas WHERE id_chat=" . $amigo1['id'] . " AND id_envia != " . $id_c . " ORDER BY id DESC";
                                $querychat = $db->query($sqlchat);
                                $chat = $querychat->fetch();
                                $i++;
                        ?>

                                <li>
                                    <a href="?page=<?php echo $_GET['page']; ?>&chat=<?php echo $amigo1['id']; ?>">
                                        <img class="contacts-list-img" src="<?php echo $recebe['foto']; ?>" alt="User Image">

                                        <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              <?php echo $recebe['nome']; ?>
                                <small class="contacts-list-date pull-right"><?php echo $chat['data']; ?></small>
                            </span>
                                            <span class="contacts-list-msg"><?php echo substr_replace($chat['texto'], ($chat['texto'] > 35 ? '...' : ''), 25); ?></span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>

                            <?php }
                        } ?>
                    </ul>
                    <!-- /.contatcts-list -->
                </div>
            </div>
            <?php
            $i = 0;
            if (isset($_GET['chat'])) { ?>
            <script>
			$(document).ready(function() {
				$('#chat').attr({scrollTop: $('#chat').attr('scrollHeight')});
			});
			</script>
            <script>
				
				setInterval(function () {
					$.ajax({
						method: "GET", //GET OU POST
						url: "conversas.php?recebedor=" + <?php echo $_GET['chat']; ?> //LOCAL DO ARQUIVO

					}).done(function (answer) {
						$('#chat').html(answer);
                    	$("#conversas_chat").hide();

					}).fail(function (jqXHR, textStatus) {
						console.log("Request search failed: " + textStatus); //executa se falhar 
					});
				}, 2000);
			</script>
                <div class="box-footer">
                    <div class="input-group">
                        <input type="text" id="mensagem" required name="mensagem" placeholder="Escreva uma mensagem ..." class="form-control">
                        <input type="text" id="id_chat" name="id_chat" style="display: none;" value="<?php echo $_GET['chat']; ?>" class="form-control">
                        <span class="input-group-btn">
                        <button type="button" id="enviarchat" name="enviarchat" class="btn btn-primary btn-flat">Enviar</button>
                      </span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <aside class="control-sidebar control-sidebar-light control-sidebar">
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">PEDIDOS DE AMIZADE</h3>
                <ul class="control-sidebar-menu">
				<?php
                $i = 0;
                if ($_COOKIE['tipo_conta'] == 1) {
                    $sql = "SELECT *,id_cliente AS id_conta FROM amigos_cliente WHERE aceito='0' AND id_cliente = " . $contas['id'];
                    $result = $db->query($sql);
                } else {
                    $sql = "SELECT *,id_prestador AS id_conta FROM amigos_prestador WHERE aceito='0' AND id_prestador = " . $contas['id'];
                    $result = $db->query($sql);
                }
                if ($result->rowCount() == 0) {
                    echo "Você não tem pedidos pendentes...";
                } else {
                    foreach ($result->fetchAll() as $amigo1) {
                        $amigo = select("clientes", "WHERE id = " . $amigo1['id_amigo']);
                        $amigoC = select("contas", "WHERE id = " . $amigo1['id_amigo']);
                        $i++;
                ?>
                                <li>
									<div class="menu-info">
										<img class="img-circle img-sm" style="margin-left:-10px;" src="<?php echo $amigoC['foto']; ?>">
										<a href="?page=perfil&user=<?php echo $amigoC['login']; ?>"><h4 class="control-sidebar-subheading"><?php echo ($amigoC['nome']); ?></h4></a>
										<a class="label label-primary" href="?page=principal&amigo=aceitar&id_amz=<?php echo $amigo1['id']; ?>">CONFIRMAR</a> &nbsp; <a class="label label-danger" href="?page=principal&amigo=recusar&id_amz=<?php echo $amigo1['id']; ?>&id_amigo=<?php echo $amigo1['id_conta']; ?>">X</a>
									</div>
                                </li><hr>
                            <?php }
                    } ?>
                </ul>
                <h3 class="control-sidebar-heading">AMIGOS ONLINE</h3>
                <ul class="control-sidebar-menu">
					
                    <?php
                    $i = 0;
                    if ($_COOKIE['tipo_conta'] == 1) {
                        $sql = "SELECT * FROM amigos_cliente WHERE aceito='1' AND id_cliente = " . $contas['id'] . " OR id_amigo = " . $contas['id'];
                        $result = $db->query($sql);
                    } else {
                        $sql = "SELECT * FROM amigos_prestador WHERE aceito='1' AND id_prestador = " . $contas['id'] . " OR id_amigo = " . $contas['id'];
                        $result = $db->query($sql);
                    }
                    if ($result->rowCount() == 0) {
                        echo "Você ainda não tem amigos...";
                    } else {
                        foreach ($result->fetchAll() as $amigo1) {
                            $amigo = select("clientes", "WHERE id = " . $amigo1['id_amigo']);
                            $amigoC = select("contas", "WHERE id = " . $amigo1['id_amigo']);
                            $i++;

                            $sql22 = "SELECT * FROM chat WHERE id_u1 = " . $amigo1['id_amigo'] . " OR id_u2 = " . $amigo1['id_amigo'];
                            $result22 = $db->query($sql22);
                            if ($result22->rowCount() > 0) {
                                $chat = select("chat", "WHERE id_u1 = " . $amigo1['id_amigo'] . " OR id_u2 = " . $amigo1['id_amigo']);
                            } else {
                                $sql = "INSERT INTO chat VALUES (NULL, '" . $contas['id'] . "', '" . $amigo1['id_amigo'] . "')";
                                $result = $db->query($sql);
                                $chat = select("chat", "WHERE id_u1 = " . $amigo1['id_amigo'] . " OR id_u2 = " . $amigo1['id_amigo']);
                            }
                            if ($amigoC['online'] == 1) {
                    ?>
                                <li>
                                    <a href="?page=<?php echo $_GET['page']; ?>&chat=<?php echo $chat['id']; ?>">
                                        <div class="menu-info">
                                            <img class="img-circle img-sm" style="margin-left:-10px;" src="<?php echo $amigoC['foto']; ?>">
                                            <h4 class="control-sidebar-subheading"><?php echo ($amigoC['nome']); ?></h4>
                                            <p><i class="fa fa-circle text-success"></i> Online</p>
                                        </div>
                                    </a>
                                </li><hr>
                            <?php } else {
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;Não há pessoas online!";
                            }
                        }
                    } ?>

                </ul>
                <!-- /.control-sidebar-menu -->
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>

    

    <div class="content-wrapper">

        <?php
        if ($contas['novato'] == 1) {

            if (isset($_POST['salvar'])) {
                $cep = $_POST['cep'];
                $num = $_POST['numero'];
                $rg = $_POST['rg'];
                $bairro = $_POST['bairro'];
                $rua = $_POST['rua'];
                $cidade = $_POST['cidade'];
                $estado = $_POST['estado'];
                $complemento = $_POST['complemento'];
                $tel = $_POST['telefone'];
                $cpf = $_POST['cpf'];

                $sql = "INSERT INTO casa VALUES (NULL,'" . $tel . "','" . $rua . "','" . $bairro . "','" . $num . "','" . $cidade . "','" . $estado . "','" . $cep . "','" . $complemento . "','" . $contas['id'] . "','" . $_POST['lat'] . "','" . $_POST['lng'] . "')";

                if ($contas['tipo_conta'] == 1) {
                    $sql2 = "UPDATE clientes SET telefone='" . $tel . "',cpf='" . $cpf . "',rg='" . $rg . "' WHERE id = '" . $contas['id_cliente'] . "'";
                } else {
                    $sql2 = "UPDATE prestador SET telefone='" . $tel . "',cpf='" . $cpf . "',rg='" . $rg . "' WHERE id = '" . $contas['id_cliente'] . "'";
                }
                $sql3 = "UPDATE contas SET novato = '0' WHERE id = '" . $contas['id'] . "'";

                if ($db->query($sql)) {
                    if (isset($_POST['cpf'])) {
                        if ($db->query($sql2)) {
                            if ($db->query($sql3)) {
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index?page=" . $_SESSION['pagina'] . "'>";
                            } else {
                                echo "<center>OCORREU UM ERRO AO SALVAR OS DADOS! TENTE NOVAMENTE MAIS TARDE...</center>";
                            }
                        } else {
                            echo "<center>OCORREU UM ERRO AO SALVAR OS DADOS! TENTE NOVAMENTE MAIS TARDE...</center>";
                        }
                    } else {
                        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index?page=" . $_SESSION['pagina'] . "'>";
                    }
                } else {
                    echo "<center>OCORREU UM ERRO AO SALVAR OS DADOS! TENTE NOVAMENTE MAIS TARDE...</center>";
                }
            }

        ?>
            <section style="margin-left:15px" class="col-md-12 content">
                <div class="box box-default row">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>

                        <h3 class="box-title">Alerta!</h3>
                    </div>
                    <div class="col-md-8 box-body">
                        <form style = "font-size:12px" class="form-group" method="post">
                            <div class="form-group col-md-3">
                                <label for="cep">CEP (Números):</label>
                                <input type="text" name="cep" required class="form-control" id="cep" maxlength="9" value="<?php if (isset($_REQUEST['cep'])) {
                                                                                                                                echo $_REQUEST['cep'];
                                                                                                                            } ?>"/>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="rua">Rua:</label>
                                <input type="text" name="rua" required class="form-control" id="rua" size="45" value = "<?php if (isset($_REQUEST['rua'])) {
                                                                                                                            echo $_REQUEST['rua'];
                                                                                                                        } ?>"/>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="numero">Número:</label>
                                <input type="text" name="numero" required class="form-control" id="numero" size="5" value="<?php if (isset($_REQUEST['numero'])) {
                                                                                                                                echo $_REQUEST['numero'];
                                                                                                                            } ?>"/>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="bairro">Bairro:</label>
                                <input type="text" name="bairro" required class="form-control" id="bairro" size="25" value = "<?php if (isset($_REQUEST['bairro'])) {
                                                                                                                                    echo $_REQUEST['bairro'];
                                                                                                                                } ?>"/>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="cidade">Cidade:</label>
                                <input type="text" name="cidade" required class="form-control" id="cidade" size="25" value = "<?php if (isset($_REQUEST['cidade'])) {
                                                                                                                                    echo $_REQUEST['cidade'];
                                                                                                                                } ?>"/>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="estado">Estado:</label>
                                <input type="text" name="estado" required class="form-control" id="estado" size="2" value = "<?php if (isset($_REQUEST['estado'])) {
                                                                                                                                    $_REQUEST['estado'];
                                                                                                                                } ?>"/>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="complemento">Complemento:</label>
                                <input type="text" name="complemento" class="form-control" required id="complemento" placeholder="Ex: Casa, Ap. 24-A" value = "<?php if (isset($_REQUEST['complemento'])) {
                                                                                                                                                                    echo $_REQUEST['complemento'];
                                                                                                                                                                } ?>"/>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="telefone">Telefone Celular:</label>
                                <input type="text" name="telefone" class="form-control" required id="telefone" placeholder="Ex: (31) 9 9999-9999" size="25" value = "<?php if (isset($_REQUEST['telefone'])) {
                                                                                                                                                                            echo $_REQUEST['telefone'];
                                                                                                                                                                        } ?>"/>
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="lat" style="display: none;" class="form-control"  id="lat" placeholder="Latitude" size="25" value = "<?php if (isset($_REQUEST['lat'])) {
                                                                                                                                                                    echo $_REQUEST['lat'];
                                                                                                                                                                } ?>"/>
                            </div>

                            <div class="form-group col-md-3">
                                <input type="text" name="lng" style="display: none;" class="form-control"  id="lng" placeholder="Longitude" size="25" value = "<?php if (isset($_REQUEST['lng'])) {
                                                                                                                                                                    echo $_REQUEST['lng'];
                                                                                                                                                                } ?>"/>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" name = "salvar" id = "salvar" class="form-control btn btn-success" value="SALVAR INFORMAÇÕES" />
                            </div>
                    </div>


                    <div class="col-md-4">
                        <h4><i class="icon fa fa-warning"></i> Atenção!</h4>
                        <div class="col-md-12">
                            Seja bem vindo ao nosso site!<br />
                            Sua conta acaba de ser cadastrada, porém você deve salvar o seu endereço principal! <br/>
                            <b>Preencha o formulário ao lado com as informações legais do seu endereço principal e suas informações pessoais ( SEUS SADOS ESTÃO 100% SEGURO AQUI!)</b>
                        </div>
                        <div class="form-group col-md-6">
                            <label style="color: black;" for="cpf">CPF:</label>
                            <input type="text" name="cpf" class="form-control" required id="cpf" placeholder="Ex: 000.000.000-00" value = "<?php if (isset($_REQUEST['cpf'])) {
                                                                                                                                                echo $_REQUEST['cpf'];
                                                                                                                                            } ?>"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label style="color: black;" for="rg">RG:</label>
                            <input type="text" name="rg" class="form-control" required id="rg" placeholder="Ex: XX.000.000-0" value = "<?php if (isset($_REQUEST['rg'])) {
                                                                                                                                            echo $_REQUEST['rg'];
                                                                                                                                        } ?>"/>
                        </div>
                        </form>
                    </div>

                </div>
            </section>
        <?php } else {
            if (isset($_POST['salvar'])) {
                $cep = $_POST['cep'];
                $num = $_POST['numero'];
                $bairro = $_POST['bairro'];
                $rua = $_POST['rua'];
                $cidade = $_POST['cidade'];
                $estado = $_POST['estado'];
                $tel = $_POST['telefone'];
                $complemento = $_POST['complemento'];

                $sql = "INSERT INTO casa VALUES (NULL,'" . $tel . "','" . $rua . "','" . $bairro . "','" . $num . "','" . $cidade . "','" . $estado . "','" . $cep . "','" . $complemento . "','" . $contas['id'] . "','" . $_POST['lat'] . "','" . $_POST['lng'] . "')";

                if ($db->query($sql)) {
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index?page=" . $_SESSION['pagina'] . "'>";
                } else {
                    echo "<center>OCORREU UM ERRO AO SALVAR OS DADOS! TENTE NOVAMENTE MAIS TARDE...</center>";
                }
            }
        } ?>
        <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <?php

        if (isset($_GET['page'])) {
            $filename = './paginas/' . $_GET['page'] . '.php';
            if (file_exists($filename)) {
                include($filename);
            } else {
                include('./paginas/error-pagina.php');
            }
        } else {
            include('./paginas/error-pagina.php');
        }
        ?>

    </div>
    <!-- /.content-wrapper -->
    <script>
		$("#palavra").keypress(function (e){
			buscar($("#palavra").val());
		});
        function buscar(palavra)
        {
            var page = "caixa-de-pesquisa.php";
            $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function () {
                    $("#dados").html("Carregando...");
                },
                data: {palavra: palavra},
                success: function (msg)
                {
                    $("#dados").html(msg);
                }
            });
        }

        $('#buscar').click(function () {
            buscar($("#palavra").val())
        });
		
		
        function enviar(mensagem, recebedor)
        {
            var page = "conversas.php?mensagem="+mensagem+"&recebedor="+recebedor;
            $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function () {
                    $("#chat").html("Carregando...");
                },
                data: {mensagem: mensagem, recebedor: recebedor},
                success: function (msg)
                {
                    $("#chat").html(msg);
                    $("#conversas_chat").hide();
                }
            });
        }

        $('#enviarchat').click(function () {
            enviar($("#mensagem").val(), $("#id_chat").val());
        });


        function busca(palavra)
        {
            var page = "buscar_chamado.php";
            $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function () {
                    $("#resultado").html("Carregando...");
                },
                data: {pesquisa: palavra},
                success: function (msg)
                {
                    $("#resultado").html(msg);
                }
            });
        }

        $('#busca').click(function () {
            busca($("#campo_pesquisa").val())
        });
    </script>
    <div id="fb-root"></div>

    <footer class="main-footer" style="z-index: 5;">
        <div class="pull-right hidden-xs">
            <div class="btn bg-grey-50 padding-10-20 no-border color-grey-600 border-radius-25 hidden-xs no-shadow"><i class="fa fa-calendar-o"></i> Hoje é <?php setlocale(LC_TIME, "portuguese");
                                                                                                                                                            echo (date('l d \d\e F \d\e Y')); ?></div>
            <a href="#"><span class="glyphicon glyphicon-arrow-up"</a>
        </div>
        <strong>Copyright &copy; 2024 <a href="https://PrestaMeet.kinghost.net/">PrestaMeet</a> &nbsp; </strong> Todos os direitos reservados.
    </footer>

    <script type="text/javascript">
        hide('content');
        $("#content").fadeIn();
        $("#content").fadeIn("slow");
        $("#content").fadeIn(1000);
    </script>
</div></div>
</div>
</body>
</html>