<?php
require_once 'config.php';
require_once 'functions.php';
require_once DBAPI;
$db = open_database();
if($_COOKIE['tipo_conta'] == 1){
    $contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");
    $user = select("clientes", "WHERE id = " . $contas['id_cliente']);
}else{
    $contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");
    $user = select("prestador", "WHERE id = " . $contas['id_cliente']);
}
?>
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


<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<body>
    <!-- Conversations are loaded here -->

            <!-- Message. Default to the left -->
            <?php

            if(isset($_REQUEST['recebedor'])){
                
                $mensagem =  $_REQUEST['mensagem'];
                $recebedor = $_REQUEST['recebedor'];
                if(isset($_REQUEST['mensagem'])) {
                    $sqlinsert = "INSERT INTO conversas VALUES (NULL,'" . $contas['id'] . "','" . $mensagem . "','" . $recebedor . "',NOW())";
                    if ($db->query($sqlinsert)) {
                    } else {
                        echo "ERRO AO ENVIAR A MENSAGEM...";
                    }
                }
                $sql = "SELECT * FROM chat WHERE id=".$recebedor;
                $query2=$db->query($sql);
                $sqlconversas = "SELECT * FROM conversas WHERE id_chat = ".$recebedor . " ORDER BY id ASC";
                $queryconversas = $db->query($sqlconversas);
                $i=0;
                foreach ($queryconversas->fetchAll() as $conversas) {
                    $i++;
                    if($conversas['id_envia'] != $contas['id']){
                        $recebe = select("contas", " WHERE id = ".$conversas['id_envia']);
                        ?>


                        <div class="direct-chat-msg" style=" word-wrap: break-word;">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left"><?php echo $recebe['nome'];?></span>
                                <span class="direct-chat-timestamp pull-right"><?php $dataa = new DateTime($conversas['data']); echo $dataa->format("d/m h:s"); ?></span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="<?php echo $recebe['foto'];?>" alt="Foto do Usuário"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                <?php echo $conversas['texto'];?>
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>


                    <?php } else { ?>

                        <div class="direct-chat-msg right" style=" word-wrap: break-word;">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right"><?php echo $contas['nome'];?></span>
                                <span class="direct-chat-timestamp pull-left"><?php $dataa = new DateTime($conversas['data']); echo $dataa->format("d/m h:s"); ?></span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="<?php echo $contas['foto'];?>" alt="Minha Foto"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                <?php echo $conversas['texto'];?>
                            </div>
                        </div>
                    <?php }
                }} ?>
</body>
