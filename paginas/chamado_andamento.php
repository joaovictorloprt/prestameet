<?php
$db = open_database();
$chamado = select("chamados"," WHERE id = " . $_GET['id']);
$perfil = select("contas", " WHERE id = ".$chamado['id_cliente']);
$casa = select("casa"," WHERE id = ".$chamado['id_casa']);
$conta_prestador = select("contas"," WHERE id = ".$chamado['id_prestador']);
$conta_cliente = select("contas"," WHERE id = ".$chamado['id_cliente']);
$endereco = ($casa['rua']." ".$casa['numero'].", ".$casa['bairro'].", ".$casa['cidade']." - ".$casa['estado']);
if(isset($_POST['finalizar'])){
    $data = date('Y-m-d', strtotime($_POST["data_fim"]));
	if(!isset($_POST['nota_cliente'])){
		if($_POST['nota_cliente'] == "5"){
			$nota_cliente == 5;
		} else if($_POST['nota_cliente'] == "4"){
			$nota_cliente == 4;
		} else if($_POST['nota_cliente'] == "3"){
			$nota_cliente == 3;
		} else if($_POST['nota_cliente'] == "2"){
			$nota_cliente == 2;
		} else if($_POST['nota_cliente'] == "1"){
			$nota_cliente == 1;
		} else {
			$nota_cliente == 0;
		}
	}else{
		$nota_cliente = 0;
	}
    $db->query("UPDATE chamados SET data_fim='".$data." ".$_POST['hora']."' WHERE id=".$_GET['id']);
	$db->query("UPDATE clientes SET avaliacoes=avaliacoes+".$nota_cliente." WHERE id=".$conta_cliente['id_cliente']);
    echo "<script>alert('Atendimento finalizado!'); document.location = 'index?page=chamados';</script>";
}

if(isset($_POST['avaliar'])){
	if(!isset($_POST['nota'])){
		if($_POST['nota'] == "5"){
			$nota == 5;
		} else if($_POST['nota'] == "4"){
			$nota == 4;
		} else if($_POST['nota'] == "3"){
			$nota == 3;
		} else if($_POST['nota'] == "2"){
			$nota == 2;
		} else if($_POST['nota'] == "1"){
			$nota == 1;
		} else {
			$nota == 0;
		}
	}else{
		$nota = 0;
	}
	if(!isset($_POST['nota_atendente'])){
		if($_POST['nota_atendente'] == "5"){
			$nota_atendente == 5;
		} else if($_POST['nota_atendente'] == "4"){
			$nota_atendente == 4;
		} else if($_POST['nota_atendente'] == "3"){
			$nota_atendente == 3;
		} else if($_POST['nota_atendente'] == "2"){
			$nota_atendente == 2;
		} else if($_POST['nota_atendente'] == "1"){
			$nota_atendente == 1;
		} else {
			$nota_atendente == 0;
		}
	}else{
		$nota = 0;
	}
	$db->query("UPDATE chamados SET comentario='".$_POST['comentario']."',avaliacao='".$nota."' WHERE id=".$_GET['id']);
	$db->query("UPDATE prestador SET avaliacoes=avaliacoes+".$nota_atendente." WHERE id=".$conta_prestador['id_cliente']);
    echo "<script>alert('Avaliação realizada!'); document.location = 'index?page=meus_chamados';</script>";
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
<style>
    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
</style>

<script>

	$('#datepicker').datepicker();

	$(".timepicker").timepicker({
	  showInputs: false
	});
</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY&callback=initMap"></script>

<script>	
    var latitude = null, longitude = null, zoom = 15;

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

<script>

	function estrela(valor){
		alert(valor);
		if(valor == 5){
			document.getElementById("estrelas").innerHTML = '
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			';
		} else if(valor == 4){
			document.getElementById("estrelas").innerHTML = '
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			';
		} else if(valor == 3){
			document.getElementById("estrelas").innerHTML = '
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			';
		} else if(valor == 2){
			document.getElementById("estrelas").innerHTML = '
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star"></span>
			<span class="glyphicon glyphicon-star"></span>
			';
		} else if(valor == 1){
			document.getElementById("estrelas").innerHTML = '
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star"></span>
			';
		} else {
			document.getElementById("estrelas").innerHTML = '
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			<span class="glyphicon glyphicon-star-empty"></span>
			';
		}
	}
</script>

<section class="content row">
        <div class="col-md-6">
        <h2>Atendimento #<?php echo $_GET['id']; ?></h2>
        <hr>
        <form method="post">
			<?php if($contas['tipo_conta'] == 2){
					if($chamado['data_fim'] == null){
			?>
			<div class="form-group">
				<label for="data_fim">DATA FINALIZADO</label>
				<div class="form-inline">
                        <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker" onkeyup="mascara(this,'99/99/9999')" name="data_fim" maxlength="10" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="bootstrap-timepicker">         
                                <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control timepicker" onkeyup="mascara(this,'99:99')" name="hora" maxlength="5" required>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
			<div class="form-group">
				<label for="nota">Avalie o cliente</label>
				<select class="form-control" id="nota" OnClick="estrela(this)" name="nota_cliente">
					<option value="0">Péssimo</option>
					<option value="1">Muito Ruim</option>
					<option value="2">Ruim</option>
					<option value="3">Bom</option>
					<option value="4">Muito Bom</option>
					<option value="5">Ótimo</option>
				</select>
				<center><div id="estrelas">
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					</div></center>
			</div>
				<input type ="submit" value="FINALIZAR" name="finalizar" class="btn btn-primary"/>
			<?php } else { echo "<center><b><h3>Este chamado foi finalizado! <a href='?page=chamados'>Voltar</a></h3></b></center>"; }} else { 
					if($chamado['avaliacao'] == null){
			?>
			<div class="form-group">
				<label for="comentario">Comentário</label>
				<textarea name="comentario" id="comentario" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label for="nota">Avalie o serviço</label>
				<select class="form-control" id="nota" OnClick="estrela(this)" name="nota">
					<option value="0">Péssimo</option>
					<option value="1">Muito Ruim</option>
					<option value="2">Ruim</option>
					<option value="3">Bom</option>
					<option value="4">Muito Bom</option>
					<option value="5">Ótimo</option>
				</select>
				<center><div id="estrelas">
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					</div></center>
			</div>
			<div class="form-group">
				<label for="nota">Avalie o atendente</label>
				<select class="form-control" id="nota" OnClick="estrela(this)" name="nota_atendente">
					<option value="0">Péssimo</option>
					<option value="1">Muito Ruim</option>
					<option value="2">Ruim</option>
					<option value="3">Bom</option>
					<option value="4">Muito Bom</option>
					<option value="5">Ótimo</option>
				</select>
				<center><div id="estrelas">
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					</div></center>
			</div>
				<input type ="submit" value="AVALIAR SERVIÇO" name="avaliar" class="btn btn-primary"/>
			<?php } else { echo "<center><b><h3>Você já avaliou este chamado! <a href='?page=meus_chamados'>Voltar</a></h3></b></center>"; }} ?>
        </form>
        </div>
        <div class="col-md-6">
            <div id="map"></div>
        </div>
</section>