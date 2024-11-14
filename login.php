<?php
require_once 'config.php';
require_once 'functions.php';

require_once DBAPI;
$db = open_database();

if(isset($_REQUEST['email_login']) && isset($_REQUEST['pwd_login'])){
    login($_REQUEST['email_login'], $_REQUEST['pwd_login']);
}
if(isset($_COOKIE['facebook'])){
	if($_COOKIE['facebook'] == "true"){
		$sqlSelect123 = "SELECT * FROM clientes WHERE nome = '".$_COOKIE['first_name']."' AND sobrenome = '".$_COOKIE['last_name']."' AND email = '".$_COOKIE['email']."'";

		$result123 = $db->query($sqlSelect123);

		$account = $result123->fetchAll();
		
		setcookie('tipo_conta', $account['tipo_conta'], time() + 3e+7);
	}else{
		if (isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['tipo_conta'])) {
			if($_COOKIE['tipo_conta'] == 1){
				header("Location: index?page=principal");
			}else{
				header("Location: index?page=principalprestador");
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PrestaMeet &raquo; Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <![endif]-->
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=342124799505455';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    
    
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<header class="main-header">
    <!-- Logo -->
    <a class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>P</b>Meet</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Presta</b>Meet</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
        </div>
    </nav>

</header>
<style>
	.tranparente{
		background-color: rgba(255,255,255,0.6);
		border-radius: 5px;
	  }
	 body{
		background-image: url(./img/background.jpg);
  	 }
</style>
<?php if ($db) : ?>
<div class="col-md-4">
    <div class="login-box">
        <div class="login-box-body tranparente">
            <p class="login-box-msg">Faça login para acessar o painel do usuário</p>
			<div id="status">
            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php clear_messages(); ?>
            <?php endif; ?>
			</div>
            <form method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" required name="email_login" id="email_login" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" required name="pwd_login" id="pwd_login" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <label>
                            <input type="checkbox" disabled name = "conectado" id = "conectado" class="minimal" checked style="position: absolute; opacity: 0;">
                            &nbsp;Continuar Conectado
                        </label>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ENTRAR</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!--<div class="social-auth-links text-center">
                <div class="fb-login-button" data-width="320" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" scope="public_profile,email" onlogin="checkLoginState();"></div>
            </div>-->
            <!-- /.social-auth-links -->

            <a href="#">Esqueci a senha</a><br>
            <a href="cadastro" class="text-center">Novo por aqui? Cadastre-se</a>

        </div>
        <!-- /.login-box-body -->
    </div>
</div>

<div class="col-md-8">
		
	</div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="./plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="./plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>




<?php else : ?>
    <div class="alert alert-danger" role="alert">
        <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
    </div>
<?php endif; ?>



</body>
</html>