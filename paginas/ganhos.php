<?php
$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");

if($contas['novato'] == 1){
?>
<section class="content-header">
    <h1>
        Meus Ganhos
        <small>Veja o quanto você Ganhou no mês</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?page=principalprestador"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Principal</li>
    </ol>

</section>
<?php } ?>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

         

<div ui-view="" class="ng-scope"><!-- ngIf: !loadingBills --><div ng-if="!loadingBills" class="col-md-4 text-danger ng-scope">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Total a pagar</h5>
    </div>
    <div class="ibox-content text-right">
      <h1 class="no-margins ng-binding">R$ 0,00</h1>
      <small class="ng-binding">R$ 0,00 pago neste mês</small>
    </div>
  </div>
</div><!-- end ngIf: !loadingBills -->
<!-- ngIf: !loadingBills --><div ng-if="!loadingBills" class="col-md-4 text-info ng-scope">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Total a receber</h5>
    </div>
    <div class="ibox-content text-right">
      <h1 class="no-margins ng-binding">R$ 0,00</h1>
      <small class="ng-binding">R$ 0,00 recebido neste mês</small>
    </div>
  </div>
</div><!-- end ngIf: !loadingBills -->
<!-- ngIf: !loadingBills --><div ng-if="!loadingBills" class="col-md-4 text-success ng-scope">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Saldo do mês</h5>
    </div>
    <div class="ibox-content text-right">
      <h1 class="no-margins ng-binding">R$ 0,00</h1>
      <small class="ng-binding">Saldo previsto para o final do mês R$ 0,00</small>
    </div>
  </div>
</div><!-- end ngIf: !loadingBills -->

<!-- ngIf: loadingBills -->

<!-- ngIf: !loadingBills --><div class="col-md-12 ng-scope" ng-if="!loadingBills">
  <div class="tabs-container">
    <ul class="nav nav-tabs">
      <li class="active" ng-init="active = 2">
        <a data-toggle="tab" href="#tab-2" aria-expanded="true">Contas do mês atual</a>
      </li>
      <li class="">
        <a data-toggle="tab" href="#tab-0" aria-expanded="false">Contas a pagar</a>
      </li>
      <li>
        <a data-toggle="tab" href="#tab-1">Contas a receber</a>
      </li>
      
    </ul>
    <div class="tab-content">
      <!-- ngRepeat: group in allBills --><div id="tab-0" ng-repeat="group in allBills" class="tab-pane ng-scope" ng-class="{ active: (active == $index) }">
        <div class="panel-body">
          <h2  style="margin: 0">
            Total de contas a pagar: R$ 0,00
          </h2>
          <br><br><br><br>
          <div class="clearfix"></div>
          <!-- ngIf: !group.bills.length --><div ng-if="!group.bills.length" class="alert alert-info m-b-0 text-center ng-scope">
            <!-- ngIf: $index === 0 --><span ng-if="$index === 0" class="ng-scope">Sem contas a pagar</span><!-- end ngIf: $index === 0 -->
            <!-- ngIf: $index === 1 -->
            <!-- ngIf: $index === 2 -->
          </div><!-- end ngIf: !group.bills.length -->
          <!-- ngIf: group.bills.length -->
        </div>
      </div><!-- end ngRepeat: group in allBills --><div id="tab-1" ng-repeat="group in allBills" class="tab-pane ng-scope" ng-class="{ active: (active == $index) }">
        <div class="panel-body">
          <h2  style="margin: 0">
            Total de contas a receber: R$ 0,00
          </h2>
          <br><br><br><br>
          <div class="clearfix"></div>
          <!-- ngIf: !group.bills.length --><div ng-if="!group.bills.length" class="alert alert-info m-b-0 text-center ng-scope">
            <!-- ngIf: $index === 0 -->
            <!-- ngIf: $index === 1 --><span ng-if="$index === 1" class="ng-scope">Sem contas a receber</span><!-- end ngIf: $index === 1 -->
            <!-- ngIf: $index === 2 -->
          </div><!-- end ngIf: !group.bills.length -->
          <!-- ngIf: group.bills.length -->
        </div>
      </div><!-- end ngRepeat: group in allBills --><div id="tab-2" ng-repeat="group in allBills" class="tab-pane ng-scope active" ng-class="{ active: (active == $index) }">
        <div class="panel-body">
          <h2 class="pull-left ng-binding" ng-class="{ 'text-info': (($index === 1) || (($index === 2) &amp;&amp; (group.total > 0))), 'text-danger': (($index === 0) || (($index === 2) &amp;&amp; (group.total < 0))) }" style="margin: 0">
            Saldo parcial: R$ 0,00
          </h2><br><br><br><br>
          
          
          <div class="clearfix"></div>
          <!-- ngIf: !group.bills.length --><div ng-if="!group.bills.length" class="alert alert-info m-b-0 text-center ng-scope">
            <!-- ngIf: $index === 0 -->
            <!-- ngIf: $index === 1 -->
            <!-- ngIf: $index === 2 --><span ng-if="$index === 2" class="ng-scope">Nenhuma conta neste mês</span><!-- end ngIf: $index === 2 -->
          </div><!-- end ngIf: !group.bills.length -->
          <!-- ngIf: group.bills.length -->
        </div>
      </div><!-- end ngRepeat: group in allBills -->
    </div>
  </div>
</div><!-- end ngIf: !loadingBills -->

</div>



    </div>

</section>