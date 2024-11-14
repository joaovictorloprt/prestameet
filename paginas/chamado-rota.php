<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <style type="text/css">
        * {  margin: 0px; padding: 0px }
        form input{

        }
        #mapview{ visibility: hidden;}
    </style>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCcdy6fBR6VEeZgXQYfHMxModgRJJ8czSY&sensor=false&language=pt-BR"></script>

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

</head>
<body onload="initialize()">

<form action="javascript: void(0);" onSubmit="calcRoute()">
    <div>
        Destino: <input type="text" size="50" value="Rua João Pedroso - SBO" id="destino" />
    </div>

    <div>
        Origem: <input type="text" size="50" value="americana" id="endereco" />
    </div>
    <button type="submit">Como chegar?</button>
</form>

<div id="mapview">
    <div id="map_canvas" style="float: left; width: 500px; height: 340px;"></div>
    <div class="direcao" style="float: left; width: 500px; height: 340px; overflow: scroll;">
        <div id="directionsPanel" style="width: 480px;height 100px"></div>
    </div>
</div>
</body>
</html>