<?php
$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");

if($contas['novato'] == 1){
?>
<section class="content-header">
    <h1>
        Chamar Prestador
        <small>Local onde a pessoa está atual?</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?page=principal"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Chamar</li>
    </ol>

</section>
<?php } ?>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

         

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h1 class="box-title"> Meu Perfil </h1>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body"> 
        <div class="container">
  <div class="row">
    
   
   
  </div>
</div>

      </div>
</section>          
  </div>





    </div>

</section>