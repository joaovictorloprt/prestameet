<?php
$chamado = select("chamados"," WHERE id = " . $_GET['id']);
$perfil = select("contas", " WHERE id = ".$chamado['id_cliente']);
$casa = select("casa"," WHERE id = ".$chamado['id_casa']);
$endereco = ($casa['rua']." ".$casa['numero'].", ".$casa['bairro'].", ".$casa['cidade']." - ".$casa['estado']);
if($contas['novato'] != 1){
    ?>
    <section class="content-header">
        <h1>
            Chamado
            <small>Informações</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
            <li class="">Chamado</li>
            <li class="active">Informações</li>
        </ol>

    </section>
<?php } ?>
<style type="text/css">
    * {  margin: 0px; padding: 0px }
</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY&sensor=false&language=pt-BR"></script>
<script type="text/javascript">
    var directionDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var myLatlng = new google.maps.LatLng();

        var myOptions = {
            zoom:7,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: myLatlng
        }

        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directionsPanel"));
    }

    function calcRoute() {
        var start = document.getElementById("enderecoo").value;
        var end = document.getElementById("destino").value;
        var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
                alert(status);
            }

            document.getElementById('mapview').style.visibility = 'visible';
        });
    }
</script>
<!--
<input type="hidden" class="form-control input-lg" id="inicio" readonly>
<input type="hidden" class="form-control input-lg" id="endereco" value="<?php //echo $endereco; ?>" readonly>-->

<body onload="initialize()">
    <section class="content">
        <div class="row">

            <form action="javascript: void(0);" onSubmit="calcRoute()">
                <div>
                    Destino: <input type="text" size="50" value="Rua João Pedroso - SBO" id="destino" />
                </div>

                <div>
                    Origem: <input type="text" size="50" value="americana" id="enderecoo" />
                </div>
                <button type="submit">Como chegar?</button>
            </form>
            <div id="mapview">
                <div id="map_canvas" style="float: left; width: 500px; height: 340px;"></div>
                <div class="direcao" style="float: left; width: 500px; height: 340px; overflow: scroll;">
                    <div id="directionsPanel" style="width: 480px;height 100px"></div>
                </div>
            </div>
        </div>
    </section>
</body>