<?php
$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");

if($contas['novato'] == 0){
?>
<section class="content-header">
    <h1>
        Nome Principal
        <small>Nome Secundario</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Nome Principal</li>
    </ol>

</section>
<?php } ?>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">


    </div>

</section>