<section class="content-header">
    <h1>
        Meus Gastos
        <small>Veja o quanto você gastou</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?page=principal"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Chamar</li>
    </ol>

</section>

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
<!-- ngIf: !loadingBills -->

</div>



    </div>

</section>