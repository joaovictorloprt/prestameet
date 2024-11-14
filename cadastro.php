<?php

require_once 'config.php';

require_once 'functions.php';

require_once DBAPI;

$db = open_database();





if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['re-senha']) && isset($_POST['tipo_conta'])){

    if(empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['tipo_conta'])){

        $_SESSION['message'] = "NÃO DEIXE CAMPOS EM BRANCO...";

        $_SESSION['type'] = 'danger';

    } else {

        if($_POST['senha'] != $_POST['re-senha']){

            $_SESSION['message'] = "AS SENHAS NÃO CORRESPONDEM...";

            $_SESSION['type'] = 'danger';

        }else {

            if ($_POST['tipo_conta'] == 2) {

                cadastroPrestador($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['senha']);

            } else {

                cadastroCliente($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['senha']);

            }

        }

        }

}



if(isset($_SESSION['email'])){

    header("Location: index?page=principal");

}

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PrestaMeet &raquo; Cadastro</title>

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

    <a href="login" class="logo">

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

            <p class="login-box-msg">Cadastre-se para acessar o painel do usuário</p>


			<div id="status">
            <?php if (!empty($_SESSION['message'])) : ?>

                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">

                    <?php echo $_SESSION['message']; ?>

                </div>

                <?php clear_messages(); ?>

            <?php endif; ?>
			</div>


            <form method="post">



                <?php if (!empty($_SESSION['message'])) : ?>

                    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">

                        <?php echo $_SESSION['message']; ?>

                    </div>

                    <?php clear_messages(); ?>

                <?php endif; ?>



                <div class="form-group has-feedback">

                    <input type="text" class="form-control" name="nome" required id="nome" placeholder="Nome">

                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                </div>

                <div class="form-group has-feedback">

                    <input type="text" class="form-control" name="sobrenome" required id="sobrenome" placeholder="Sobrenome">

                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                </div>

                <div class="form-group has-feedback">

                    <input type="email" class="form-control" name="email" required id="email" placeholder="Email">

                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                </div>

                <div class="form-group has-feedback">

                    <input type="password" class="form-control" name="senha" required id="senha" placeholder="Senha">

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                </div>

                <div class="form-group has-feedback">

                    <input type="password" class="form-control" name="re-senha" required id="re-senha" placeholder="Repita a senha">

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                </div>

                <div class="row">

                    <div class="col-xs-8">

                        <label>

                            <input type="radio" class="minimal" checked name="tipo_conta" value="1" style="position: absolute; opacity: 0;">

                            &nbsp;SOU CLIENTE

                        </label>

                        <label>

                            <input type="radio" class="minimal" name="tipo_conta" value="2" style="position: absolute; opacity: 0;">

                            &nbsp;SOU PRESTADOR

                        </label>

                    </div>

                    <!-- /.col -->

                    <div class="col-xs-4" style="margin-left:-19%;">

                        <button type="submit" class="btn btn-primary btn-lg">CRIAR CONTA</button>

                    </div>

                    <!-- /.col -->

                </div>

            </form>



				<!-- /.social-auth-links -->


			<!-- /.login-box-body -->
		</div>
	</div>
</div>

<div class="col-md-8">
	<div class="row">
	  <div class="col-lg-12 text-center">
		<h2 class="section-heading">Como Funciona</h2>
		<h3 class="section-subheading text-muted">Queremos ser a solução do seu problema!</h3>
	  </div>
	</div>
	<div class="col-lg-12 text-center">
	   <b><h3>Profissional</h3></b>
	</div>
	<div class="row text-center">
	  <div class="col-md-6">
		<span class="fa-stack fa-4x">
		  <i class="fa fa-circle fa-stack-2x text-primary"></i>
		  <i class="fa fa-money fa-stack-1x fa-inverse"></i>
		</span>
		<h4 class="service-heading">Lucro</h4>
		<p class="text-muted">Seu lucro independe da quantidade de serviços prestados, nossa politica de monetização retira uma porcentagem mínima sobre o preço líquido cobrado por você profissinal para visar cada vez mais seu crescimento e lucro!</p>
	  </div>
	  <div class="col-md-6">
		<span class="fa-stack fa-4x">
		  <i class="fa fa-circle fa-stack-2x text-primary"></i>
		  <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
		</span>
		<h4 class="service-heading">Visibilidade</h4>
		<p class="text-muted">Ganhe uma visibilidade maior no mercado da estética feminina, ganhando destaque nos comentários e no rankeamento de acordo com o seu atendimento e serviço prestado!</p>
	  </div>
		<div class="col-lg-12 text-center">
	   <b><h3>Cliente</h3></b>
		</div>
	   <div class="col-md-6">
		<span class="fa-stack fa-4x">
		  <i class="fa fa-circle fa-stack-2x text-primary"></i>
		  <i class="fa fa-space-shuttle fa-stack-1x fa-inverse"></i>
		</span>
		<h4 class="service-heading">Rapidez</h4>
		<p class="text-muted">Chame profissionais capacitados para lhe atender onde você quiser com apenas 4 toques na tela! Os profissionais chegarão o mais rápido possível para lhe atender! </p>
	  </div>
	  <div class="col-md-6">
		<span class="fa-stack fa-4x">
		  <i class="fa fa-circle fa-stack-2x text-primary"></i>
		  <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
		</span>
		<h4 class="service-heading">Praticidade</h4>
		<p class="text-muted">Tenha profissionais qualificados e capacitados prontos para lhe atender no lugar onde você desejar, pague pelo aplicativo via cartão e tenha a rapidez de ser atendida na hora que desejar!</p>
	  </div>
	</div>
</div>



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