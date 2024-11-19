<?php
$db = open_database();
$chamado = select("chamados"," WHERE id = " . $_GET['id']);
$perfil = select("contas", " WHERE id = ".$chamado['id_cliente']);
$casa = select("casa"," WHERE id = ".$chamado['id_casa']);
$endereco = ($casa['rua']." ".$casa['numero'].", ".$casa['bairro'].", ".$casa['cidade']." - ".$casa['estado']);

if($contas['tipo_conta'] == 2 && $chamado['ativo'] == 0){
	$sql_1 = "SELECT * FROM propostas WHERE aceito = '1' AND id_chamado = '".$chamado['id']."' AND id_prestador = '".$contas['id']."'";
	$query_1 = $db->query($sql_1);
	$fetch_1 = $query_1->fetch();
	if($contas['id'] == $fetch_1['id_prestador']){
		echo "<script>window.location = '?page=chamado_andamento&id=".$chamado['id']."';</script>";
	}
}

if(isset($_POST['enviar_proposta'])){
    if($contas['tipo_conta']==2 && $chamado['ativo'] == '1'){
		$query_pro = $db->query("INSERT INTO propostas VALUES (NULL, '".$chamado['id']."', '".$chamado['id_cliente']."','".$contas['id']."','".$_POST['proposta']."','".$_POST['comentario_proposta']."','0')");
        $query = $db->query("INSERT INTO notificacoes VALUES (NULL, '".$contas['id']."','".$chamado['id_cliente']."','"."Você recebeu uma proposta!"."','index?page=perfil_chamado&id=".$chamado['id']."',NOW())");
        echo "<script>alert('Sua proposta foi enviada, caso o usuário aceite, você será notificado...'); </script>";
    }
}

if(isset($_POST['aceitar_proposta'])){
	if($contas['tipo_conta']==1 && $chamado['ativo'] == '1'){
		$query_pro = $db->query("UPDATE propostas SET aceito = '1' WHERE id = '".$_POST['idproposta']."'");
		
		$query_pro2 = $db->query("UPDATE chamados SET ativo = '0', id_prestador = '".$_POST['id_prestador_chamado']."' WHERE id = '".$chamado['id']."'");
		
        $query = $db->query("INSERT INTO notificacoes VALUES (NULL, '".$contas['id']."','".$_POST['id_prestador_chamado']."','"."Sua proposta foi aceita!"."','index?page=perfil_chamado&id=".$chamado['id']."',NOW())");
		
        echo "<script>alert('Você acaba de aceitar o serviço! Em breve o prestador irá entrar em contato com você, ou até mesmo aparecer na sua casa!...'); window.location = '?page=chamado_andamento&id=".$chamado['id']."';</script>";
    }
}

if($contas['novato'] != 1){
    ?>
    <section class="content-header">
        <h1>
            Chamado
            <small>Perfil do Chamado</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
            <li class="">Chamado</li>
            <li class="active">Perfil</li>
        </ol>

    </section>
<?php } ?>
<div id="proposta_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<form method="post">
		<input type="hidden" id = "id_prestador_chamado" name = "id_prestador_chamado" />
		<input type="hidden" id = "idproposta" name="idproposta" />
		<input type="hidden" id = "nome_prestador" name="nome_prestador" />
		<input type="hidden" id = "proposta_prestador" name="proposta_prestador" />
		<input type="hidden" id = "comentario_prestador" name="comentario_prestador" />
        <h4 class="modal-title">Prestador: <label id="nome_prestadorr">NOME</label></h4>
      </div>
      <div class="modal-body">
		  <div class="col-sm-4">
			  <img src="img/atendimento.png" style="width: 100%">
		  </div>
		  <div class="col-sm-8">
			  
			  <h3 style="color: purple;">R$ <label id="proposta_prestadorr" name="proposta_prestadorr">0.00</label></h3>	 
			  <b>Comentário:</b><br />
			  <p id="comentario_prestadorr" name="comentario_prestadorr">COMENTÁRIO</p>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="aceitar_proposta"><i class="fa fa-check"></i> ACEITAR PROPOSTA</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
	</form>
  </div>
</div>


<style>
    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY&callback=initMap"></script>

<script>
    var latitude = null, longitude = null, zoom = 15;
	
	function definir(id_prestador_chamado, idproposta, nome_prestador, proposta_prestador, comentario_prestador){
		document.getElementById("id_prestador_chamado").value = id_prestador_chamado;
		document.getElementById("idproposta").value = idproposta;
		document.getElementById("nome_prestador").value = nome_prestador;
		document.getElementById("proposta_prestador").value = proposta_prestador;
		document.getElementById("comentario_prestador").value = comentario_prestador;
		document.getElementById("nome_prestadorr").innerHTML = nome_prestador;
		document.getElementById("proposta_prestadorr").innerHTML = proposta_prestador;
		document.getElementById("comentario_prestadorr").innerHTML = comentario_prestador;
	}

    $(document).ready(function() {
            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address="+ $("#endereco").val() +"&key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY", function(data) {
                    latitude = data.results[0].geometry.location.lat;
                    longitude = data.results[0].geometry.location.lng;
                    zoom = 18;

                    initMap();

                    $("#lat").val(latitude);
                    $("#lng").val(longitude);
        });
    });

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoom,
            center: {lat: latitude, lng: longitude},
            scrollwheel: false,
        });

        var marker = new google.maps.Marker({
            position: {lat: latitude, lng: longitude},
            zoom: zoom,
            map: map
        });
    }
</script>
<input type="hidden" class="form-control input-lg" id="lat" readonly>
<input type="hidden" class="form-control input-lg" id="lng" readonly>
<input type="hidden" class="form-control input-lg" id="endereco" value="<?php echo $endereco; ?>" readonly>

<section class="content row">
    <!-- Small boxes (Stat box) -->
        <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('<?php echo $perfil['foto']; ?>') center center;">
                    <h3 class="widget-user-username"><?php echo $perfil['nome']; ?></h3>
                    <h5 class="widget-user-desc"><?php if($perfil['tipo_conta']==1){echo "Cliente";} else {echo"Prestador";}; ?></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="<?php echo $perfil['foto']; ?>" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <?php
                                if($perfil['tipo_conta']==1){
                                    $sql = "SELECT * FROM amigos_cliente WHERE id_cliente = " . $perfil['id'];
                                    $result = $db->query($sql);
                                }else{
                                    $sql = "SELECT * FROM amigos_prestador WHERE id_prestador = " . $perfil['id'];
                                    $result = $db->query($sql);
                                }
                                ?>
                                <h5 class="description-header"><?php echo $result->rowCount(); ?></h5>
                                <span class="description-text">AMIGOS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <?php
                                    $sql = "SELECT * FROM clientes WHERE id = " . $contas['id_cliente'];
                                    $sql2="SELECT IFNULL(SUM(avaliacoes), 0) AS tot FROM clientes WHERE id = " . $contas['id_cliente'];
                                
                                $result = $db->query($sql);
                                $result2= $db->query($sql2);
                                $fetch_ava = $result2->fetch();
                                $soma_ava= $fetch_ava['tot'];
                                $total_ava = $result->rowCount();
                                $ava=$soma_ava/$total_ava;
                                if($ava >= 5){ ?>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                <?php } else if($ava >=4 ) { ?>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                <?php } else if($ava>=3 ) { ?>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                <?php } else if($ava>= 2) { ?>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                <?php } else if($ava>= 1) { ?>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                <?php } else { ?>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                <?php } ?><br />
                                <span class="description-text">AVALIAÇÃO</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <?php
                                if($perfil['tipo_conta']==2){
                                    $sql = "SELECT * FROM chamados WHERE id_prestador = " . $perfil['id'];
                                    $result = $db->query($sql);
                                    ?>
                                    <h5 class="description-header"><?php echo $result->rowCount(); ?></h5>
                                    <span class="description-text">Serviços Prestados</span>
                                <?php } else {
                                    $sql = "SELECT * FROM chamados WHERE id_cliente = " . $perfil['id'];
                                    $result = $db->query($sql);?>
                                    <h5 class="description-header"><?php echo $result->rowCount(); ?></h5>
                                    <span class="description-text">Chamados</span>
                                <?php } ?>
                            </div>
                            <!-- /.description-block -->
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>

            <div class="row bg-purple">
                <div class="col-md-12"><center><b><h2><i class="fa fa-home"></i> Casa do Cliente</h2></b></center><div id="map"></div></div>
                <div class="col-md-12 small-box">
                    <!-- small box -->
                    <div class="inner">
                    	<div class="col-md-8">
						<p> <h4>
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
                    <?php if($contas['tipo_conta']==2 && $chamado['ativo'] == "1"){ 
							$query_proposta = $db->query("SELECT* FROM propostas WHERE id_chamado = '".$chamado['id']."' AND id_prestador = '".$contas['id']."'");		$num_propostas = $query_proposta->rowCount();
							if($num_propostas == 0){
					?>
					<script>
						var mask = {
						   money: function() {
							  var el = this
							  ,exec = function(v) {
								 v = v.replace(/\D/g,"");
								 v = new String(Number(v));
								 var len = v.length;
								 if (1== len)
									v = v.replace(/(\d)/,"0.0$1");
								 else if (2 == len)
									v = v.replace(/(\d)/,"0.$1");
								 else if (len > 2) {
									v = v.replace(/(\d{2})$/,'.$1');
								 }
								 return v;
							  };

							  setTimeout(function(){
								 el.value = exec(el.value);
							  },1);
						   }
						}

						$(function(){
							$('#proposta').bind('keypress',mask.money);
							$('#proposta').bind('keyup',mask.money);
						});
					</script>
					<div class="col-md-4">
						<form method="post">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
								  <label>R$</label>
								</div>
								<input type="text" maxlength="15" class="form-control" id="proposta" name="proposta" placeholder="0,00"/>
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="comentario_proposta" placeholder="Deseja informar algo ao cliente?"></textarea>
						</div>
							<div class="form-group small-box">
								<button type="submit" name="enviar_proposta" class="btn btn-lg btn-block small-box-footer">
										<i class="fa fa-send"></i> Enviar Proposta
								</button>
							</div>
						</form>
					 </div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
                    <?php }else{ $proposta = $query_proposta->fetch();
						if($proposta['aceito'] == '0'){
					?>
					<div class="col-md-4">
						<div class="alert alert-info">
							 <strong>Atenção!</strong> Você enviou uma proposta para este cliente no valor de <label style="color:#FF0000;">R$ <?php echo $proposta['proposta']; ?></label>
							<br>
							<b>Comentário postado:</b>
							<p><?php echo $proposta['comentario']; ?></p>
						</div>
					</div>
					<?php } else { ?>
					<div class="col-md-4">
						<div class="alert alert-success">
							 <center><strong>O Cliente aceitou a sua proposta!</strong></center> <br /> Você enviou uma proposta para este cliente no valor de <label style="color:#FF0000;">R$ <?php echo $proposta['proposta']; ?></label>
							<br>
							<b>Comentário postado:</b>
							<p><?php echo $proposta['comentario']; ?></p>
						</div>
					</div>
					<?php } ?>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
				<?php }} else if ($contas['tipo_conta'] == 1 && $chamado['ativo'] == '1' && $contas['id'] == $chamado['id_cliente']){ ?>
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header with-border">
							  <h3 class="box-title">Todas as Propostas</h3>

							  <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
							  <ul class="products-list product-list-in-box">
								<?php 
									$query_proposta = $db->query("SELECT* FROM propostas WHERE id_chamado = '".$chamado['id']."' AND id_cliente = '".$contas['id']."'");		$num_propostas = $query_proposta->rowCount();
									if($num_propostas == 0){
										echo '<center style="color: #363636;">Nenhuma proposta feita...</center>';
									}else{
										foreach($query_proposta->fetchAll() as $proposta){
											$prestador = select("contas","WHERE id = '".$proposta['id_prestador']."'");
								?>
								<li class="item">
								  <div class="product-img">
									<img src="<?php echo $prestador['foto']; ?>" alt="Product Image">
								  </div>
								  <div class="product-info">
									<a href="?page=perfil&user=<?php echo $prestador['login']; ?>" class="product-title"><?php echo $prestador['nome']; ?></a>
									  <span class="pull-right">
										  <span class="label label-success pull-right">R$ <?php echo $proposta['proposta']; ?></span>  <?php if ($proposta['aceito'] == '1') { ?><span class="label label-primary pull-right">ACEITO</span> <?php } ?><br />
										  <button class="btn btn-info pull-right" id="<?php echo $proposta['id']; ?>" data-toggle="modal" data-target="#proposta_modal" onclick="definir('<?php echo $proposta['id_prestador']; ?>', this.id, '<?php echo $prestador['nome']; ?>', '<?php echo $proposta['proposta']; ?>', '<?php echo $proposta['comentario']; ?>')"><i class="fa fa-info"></i></button>
									  </span>
										<span class="product-description">
										   <?php
												$sql = "SELECT * FROM prestador WHERE id = " . $prestador['id_cliente'];
												$sql2="SELECT IFNULL(SUM(avaliacoes), 0) AS tot FROM prestador WHERE id = " . $prestador['id_cliente'];

											$result = $db->query($sql);
											$result2= $db->query($sql2);
											$fetch_ava = $result2->fetch();
											if($fetch_ava['tot'] > 0){
												$soma_ava= $fetch_ava['tot'];
												$total_ava = $result->rowCount();
												$ava=$soma_ava/$total_ava;
											}else{
												$total_ava = $result->rowCount();
												$ava=0;
											}
											if($ava >= 5){ ?>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
											<?php } else if($ava >=4 ) { ?>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
											<?php } else if($ava>=3 ) { ?>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
											<?php } else if($ava>= 2) { ?>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
											<?php } else if($ava>= 1) { ?>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
											<?php } else { ?>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
											<?php } ?>
										</span>
								  </div>
								</li>
								  <?php }} ?>
							  </ul>
							</div>
							<!-- /.box-footer -->
						  </div>
				
                    </div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
					<?php } else if ($contas['tipo_conta'] == 1 && $chamado['ativo'] == '0' && $chamado['data_fim'] != NULL){ ?>
						<div class="col-md-4">
							<div class="alert alert-success">
								 <center><strong>Atenção!</strong> <br />Este chamado foi finalizado!</center>
							</div>
						</div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
					<?php } else if ($contas['tipo_conta'] == 1 && $contas['id'] == $chamado['id_cliente'] && $chamado['ativo'] == '0' && $chamado['data_fim'] == NULL){ ?>
						<div class="col-md-4">
							<div class="alert alert-info">
								 <center><strong>Atenção!</strong> <br />Este chamado está sendo realizado!<br> 
								 <a class="small-box" href="?page=chamado_andamento&id=<?php echo $chamado['id']; ?>"><button type="submit" name="enviar_proposta" class="btn btn-lg btn-block small-box-footer">
									 <i class="fa fa-send"></i> Acompanhar
									 </button></a>
								</center>
							</div>
						</div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
					<?php } ?>
                </div>
            </div>
        </div>
</section>