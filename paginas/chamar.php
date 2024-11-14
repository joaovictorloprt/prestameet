<?php

$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");



if(isset($_POST['chamar'])) {

    if(!empty($_POST['servicos'])) {

        $tipo = $_POST['servicos'];

        $valores = '';

        foreach ($tipo as $k => $v) {

            $valores .= $v . ";";

        }

        if (!empty($_POST['endereco']) && !empty($contas['id']) && !empty($valores)) {
    		$data = date('Y-m-d', strtotime($_POST["data"]));
            $sql = "INSERT INTO `chamados` VALUES (NULL,'" . $contas['id'] . "',NULL,'" . $valores . "','" . $_POST['endereco'] . "','" . $_POST['adicional'] . "','0',NULL,'1','".$data." ".$_POST['hora']."',NULL)";

            $query = $db->query($sql);

            if ($query) {

                echo "<script>alert('Chamado realizado! Aguarde um profissional contata-lo!');</script>";

                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index?page=meus_chamados'>";



            } else {

                $error1 = "Erro!";

                $error2 = "Ocoreu um erro ao iniciar o seu chamado...";

                $error_type = "danger";

            }

        } else {

            $error1= "Opss";

            $error2= "Você se esqueceu de preencher algum campo...";

            $error_type= "warning";

        }

    } else {

        $error1= "Opss";

        $error2= "Você se esqueceu de preencher algum campo...";

        $error_type= "warning";

    }

}

if($contas['novato'] != 1){

    ?>

    <section class="content-header">

        <h1>

            Iniciar Chamado

            <small>Chamar</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>

            <li class="active">Chamar</li>

        </ol>



    </section>

<?php } ?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- bootstrap datepicker -->

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY&callback=initMap"></script>

<style>

    #map{

        height: 400px;

        width: 100%;

    }

    .selecionada {

        opacity: 0.3;

    }

</style>

<script>

    $('input').on('change', function () {

        $('label[for="' + this.id + '"]')[this.checked ? 'addClass' : 'removeClass']('selecionada');

    });

</script>

<script>

    var latitude = -18.5246561, longitude = -49.949694, zoom = 4;



    $(document).ready(function() {

        var e = document.getElementById("endereco");

        $("#endereco").blur(function() {

            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + e.options[e.selectedIndex].text +

                "&key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY", function(data) {

                latitude = data.results[0].geometry.location.lat;

                longitude = data.results[0].geometry.location.lng;

                zoom = 18;



                initMap();



                $("#lat").val(latitude);

                $("#lng").val(longitude);

            });

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





<section class="content">

    <div class="row">



        <div class="col-md-8">

            <?php if(isset($error_type) && isset($error1) && isset($error2)){  ?>

                <div class="alert alert-<?php echo $error_type; ?> alert-dismissable">

                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                    <strong class="fa fa-info-circle"> <?php echo $error1; ?></strong> <?php echo $error2; ?>

                </div>

            <?php } ?>
			<script>
			
				$('#datepicker').datepicker();
				
				$(".timepicker").timepicker({
				  showInputs: false
				});
			</script>
            <form method="post">
            	<div class="margin">
                    <label for="endereco"><span class="fa fa-calendar"></span> Selecione a Data e Hora:</label> <i style="color:red;">* Obrigatório</i>
                    <div class="form-inline">
                        <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker" onkeyup="mascara(this,'99/99/9999')" name="data" maxlength="10" required>
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
                <div class="input-group margin">

                    <label for="endereco"><span class="fa fa-home"></span> Selecione a Casa:</label> <i style="color:red;">* Obrigatório</i>

                    <select class="form-control input-lg" id="endereco" name="endereco">

                        <option selected disabled>Selecione a casa</option>

                        <?php

                        $result = $db->query("SELECT * FROM casa WHERE id_cliente = '". $contas['id'] ."'");

                        foreach($result->fetchAll() as $casa){ ?>

                            <option value="<?php echo $casa['id']; ?>"><?php echo $casa['rua']." ".$casa['numero'].", ".$casa['bairro'].", ".$casa['cidade']." - ".$casa['estado']; ?></option>

                        <?php } ?>

                    </select>

                    <span class="input-group-btn">

                        <input type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#casa-modal" value="PESQUISAR" style="margin-top:25px;"/>

                    </span>

                </div>

                    <input type="hidden" class="form-control input-lg" id="lat" readonly>

                    <input type="hidden" class="form-control input-lg" id="lng" readonly>



                <div class="form-group margin">

                    <label for="sel1"><span class="fa fa-plus"></span> Selecione o(s) tipo(s) de serviço(s):</label> <i style="color:red;">* Obrigatório</i>

                    <center><div class="checkbox">

                        <?php

                        $result = $db->query("SELECT * FROM servicos_prestados");

                        foreach($result->fetchAll() as $servico){ ?>

                            <label for="servicos<?php echo $servico['id']; ?>">

                                <img src="<?php echo $servico['imagem']; ?>" alt="<?php echo $servico['nome']; ?>" width="100" class="img-responsive img-thumbnail">

                                <center><b><i><?php echo $servico['nome']; ?></i></b></center>

                            </label>

                            <input type="checkbox" id="servicos<?php echo $servico['id']; ?>" name="servicos[]" value="<?php echo $servico['id']; ?>" />



                        <?php } ?>

                    </div></center>

                </div>



                <div class="form-group margin">

                    <label for="sel1"><span class="fa fa-info"></span> Alguma preferência adicional?</label>

                    <textarea class="form-control" rows="4" style="resize: none;" name="adicional" placeholder="Descreva-a aqui..." cols="10"></textarea><Br>

                    <input type="submit" name="chamar" class="btn btn-success btn-lg btn-block" value="CHAMAR"/>

                </div>

            </form>

        </div>



        <div class="col-md-4">

            <center><label><span class="fa fa-home"></span> CASA NO GOOGLE MAPS</label><small> (APROXIMADO)</small></center>

            <div id="map"></div>

        </div>



    </div>

</section>