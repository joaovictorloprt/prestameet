<?php

$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");


if($contas['novato'] != 1){

    ?>

    <section class="content-header">

        <h1>

            Meus Chamados

            <small>Todos os chamados feitos por você</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>

            <li class="active">Meus Chamados</li>

        </ol>



    </section>

<?php } ?>



<section class="content">

    <div class="row">

        <div class="col-md-12">
            <?php
			$sql_3 = "SELECT IFNULL(SUM(proposta), 0) AS total FROM propostas INNER JOIN chamados ON chamados.id = propostas.id_chamado INNER JOIN contas ON contas.id = propostas.id_cliente WHERE contas.id = ".$contas['id']." AND chamados.ativo = '0' AND chamados.data_fim BETWEEN '".date("Y-m-", strtotime('-1 month',strtotime(date("Y-m-d"))))."31' AND '".date("Y-m-")."31'";
			$query_3=$db->query($sql_3);
			$fetch_3 = $query_3->fetch();
			$sql_4 = "SELECT IFNULL(SUM(proposta), 0) AS total FROM propostas INNER JOIN chamados ON chamados.id = propostas.id_chamado INNER JOIN contas ON contas.id = propostas.id_cliente WHERE contas.id = ".$contas['id']." AND chamados.ativo = '0'";
			$query_4=$db->query($sql_4);
			$fetch_4 = $query_4->fetch();
			?>
			<div ui-view="" class="ng-scope">
				<div ng-if="!loadingBills" class="col-md-6 text-info ng-scope pull-right">
					<div class="ibox float-e-margins">
						<div class="ibox-content text-right">
						  <h1 class="no-margins ng-binding">TOTAL GASTO: R$<?php echo str_replace(".",",",$fetch_4['total']); ?></h1>
						  <!--<small class="ng-binding">R$<?php //if($fetch_3['total'] != ""){ echo $fetch_3['total']; } else { echo "0,00"; } ?> pago neste mês</small>-->
						</div>
					</div>
				</div>
			</div>
			<br />
			<?php
            $sql_chamado = "SELECT * FROM chamados WHERE id_cliente = ".$contas['id']." ORDER BY id DESC";

            $result_chamado = $db->query($sql_chamado);

            if($result_chamado->rowCount() == 0){ echo "&nbsp;&nbsp;Não há chamados realizado...<br><br><a href='?page=chamar'><button class='btn btn-info btn-lg btn-block' >Realizar Chamado</button></a>"; } else {

            foreach ($result_chamado->fetchAll() as $chamado) {

            $casa = select("casa"," WHERE id = " . $chamado['id_casa']);

            ?>

            <div class="col-md-12 small-box bg-purple">

                <!-- small box -->

                <div class="inner">

                    <p>

                    <h4>
						
				<?php 
				if($chamado['ativo'] == 0){
					$prestador = select("contas", "WHERE id = ".$chamado['id_prestador']);
					echo "<center><i>*Atendimento Realizado*</i></center><br /><b>Atendido pelo prestador:</b> ".$prestador['nome']."<br /><br />";
				}
				?>
                        <b>Serviços: </b><br />

                        <?php

                        $servicos = $chamado['id_servicos'];

                        $sql = "SELECT * FROM servicos_prestados";

                        $result= $db->query($sql);

                        foreach ($result->fetchAll() as $id_servico) {

                            $service = $id_servico['id'];

                            if (strpos($servicos, $service) !== false) {

                                echo "• " . ($id_servico['nome']) . "<br />";

                            }

                        }



                            ?><br />

                        <b>Data & Hora: </b> <?php echo $chamado['data_aberto']; ?><br /></h4>

                    <h5><?php echo ($casa['estado']." - ".$casa['cidade'].", ".$casa['bairro']); ?><br />

                        <?php echo ($casa['rua'].", n ".$casa['numero']); ?><br /></h5>

                    </p>



                </div>

                <div class="icon">
				<?php if($chamado['ativo'] == 1)
                    	  echo '<i class="fa fa-bullhorn"></i>';
					  else
						  echo '<i class="fa fa-calendar-check-o"></i>';
				?>
                </div>

                <a href="?page=perfil_chamado&id=<?php echo $chamado['id']; ?>" style="text-align:center" class="small-box-footer">

                    <h4><i class="fa fa-map-marker"></i> VER CHAMADO</h4>

                </a><Br>

            </div><hr>

    <?php }} ?>

        </div>

    </div>

</section>

