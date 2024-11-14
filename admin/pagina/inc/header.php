<?php

require_once('../../functions.php');

$admin = select("contas", " WHERE login = '" . $_SESSION['email'] . "' AND senha = '".$_SESSION['password']."'");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PrestaMeet: Painel Administrativo</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="index" class="logo">
            <span class="logo-mini"><b>P</b>Meet</span>
            <span class="logo-lg"><b>Presta</b>Meet</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li><a href="../logout"><i class="glyphicon glyphicon-share"></i>&nbsp;Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo $admin['foto']; ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $admin['nome']; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Administrador</a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">MENU DE NAVEGAÇÃO</li>
                <li class="treeview active">
                    <a href="index"><i class="fa fa-dashboard"></i> <span>INÍCIO</span></a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i>
                        <span>Contas Cadastradas</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="contas.php"><i class="fa fa-circle-o"></i> Todas as Contas</a></li>
                        <li><a href="clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                        <li><a href="prestadores.php"><i class="fa fa-circle-o"></i> Prestadores</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="chamados.php">
                        <i class="fa fa-calendar"></i>
                        <span>Chamados</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="casas.php">
                        <i class="fa fa-home"></i>
                        <span>Casas</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="postagens.php">
                        <i class="fa fa-comments"></i>
                        <span>Postagens</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>