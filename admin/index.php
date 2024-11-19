<?php
require_once 'config.php';
require_once 'functions.php';
if(!isset($_COOKIE['email']) || !isset($_COOKIE['password'])){
    header("Location: logout");
}
if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['admin'])){
    header("Location: pagina/index");
}

$contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "'");
if(isset($_POST['password'])){
    login($_COOKIE['email'],$_POST['password']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PrestaMeet: Login - Painel Administrativo</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body class="hold-transition lockscreen">

<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="../index"><b>Presta</b>Meet</a>
    </div>
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php clear_messages(); ?>
    <?php endif; ?>
    <div class="lockscreen-name"><?php echo $contas['nome']; ?></div>


    <div class="lockscreen-item">

        <div class="lockscreen-image">
            <img src="<?php echo $contas['foto']; ?>" alt="User Image">
        </div>

        <form class="lockscreen-credentials" method="post">
            <div class="input-group">
                <input type="password" class="form-control" name="password" required placeholder="Palavra-Passe">

                <div class="input-group-btn">
                    <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>


    </div>

    <div class="help-block text-center">
        Entre com sua senha para o painel administrativo
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; 2024 <b><a href="https://PrestaMeet.kinghost.net" class="text-black">PrestaMeet</a></b><br>
        Todos os direitos reservados
    </div>
</div>


<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
