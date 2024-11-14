<?php

require_once 'config.php';
require_once 'functions.php';
require_once DBAPI;
$db = open_database();

$palavra = $_POST['palavra'];
if(empty($_POST['palavra'])){ echo "Informe o nome de um usuário..."; }else{
$sql = "SELECT * FROM contas WHERE nome LIKE '%$palavra%' LIMIT 5";
$query = $db->query($sql);
$qtd = $query->rowCount();
?>
<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="./dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="./dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="./plugins/iCheck/flat/red.css">
<link rel="stylesheet" href="./plugins/morris/morris.css">
<link rel="stylesheet" href="./plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="./plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


    <?php
    if($qtd>0){
        echo "<ul>";
    foreach($query->fetchAll() as $linha){
    ?>
    <a href="?page=perfil&user=<?php echo $linha['login']; ?>">
        <div class="menu-info">
            <img class="img-circle img-sm" style="margin-left:-10px;" src="<?php echo $linha['foto']; ?>">
            <h4 class="control-sidebar-subheading">&nbsp;<?php echo $linha['nome'];?></h4>
        </div><hr>
    </a>
    <?php
    }echo "</ul>";}else{?>
        Nao foram encontrados registros com este nome.
    <?php }}?>