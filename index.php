<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="calendario">
<table class="calendario-top" style="position:absolute">
    <thead>
        <tr class="row-dias">
            <th class="celda"></th>
            <?php
                for($i = 0; $i < 7; $i++){
                    $date = date("d - m - Y", time() + 60*60*24*$i);
                    echo "<th class='celda' data-reserva ='". date("Y-m-d", time() + 60*60*24*$i) ."' colspan='30'> <p>". $date ."</p> </th>";
                    if($i!= 6) echo "<th class='celda disabled separator'></th>";
                }
            ?>
        </tr>
        <tr class="row-horas">
            <th class="celda"></th>
            <?php
                $horas = array();

                for($j = 0; $j < 7 ; $j++){
                    $horas[0] = 8;
                    for($i = 0; $i < 30; $i++){
                        if($i%2 == 0){
                            $horas[1] = ":30";
                        }else{
                            $horas[0]++;
                            $horas[1] = ":00";
                        }
                        echo "<th class='celda'> ". $horas[0] . $horas[1] ." </th>";
                    }
                    if($j!= 6) echo "<th class='celda disabled separator'></th>";
                }
            ?>
        </tr>
    </thead>
</table>
<table class="calendario-desc">
    <?php
        $horas = array();
        for($i = 0; $i < 3; $i++){
            echo "<tr class='pista". ($i+1) ."' data-pista='". ($i+1) ."'>";
            for($z = 0; $z < 7; $z++){
                $date = date("w", time() + 60*60*24*$z);
                $regex = "011111111111000000011111111111";
                if($date == "0" || $date == "6"){
                    $regex = "111111111111110000000000000000";
                }
                for($j = 0; $j <30; $j++){
                    $disabled = $regex[$j] == 1? "" : "disabled";
                    echo "<td class='celda ".$disabled."'></td>";
                }
                if($z!= 6) echo "<th class='celda disabled separator'></th>";
            }
            echo "</tr>";
        }
    ?>
</table>
    <div class="calendario-body">
        <div class="calendario-left">
            <table>
                <tr><td class="celda"></td></tr>
                <tr><td class="celda"></td></tr>
                <tr><td class="celda">PISTA 1</td></tr>
                <tr><td class="celda">PISTA 2</td></tr>
                <tr><td class="celda">PISTA 3</td></tr>
            </table>
        </div>
    </div>

 
</div>

<div class="crear-reserva-form container">
    <form action="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 id" id="id"><p></p></div> 
                <div class="apellidos col-6">
                    <label for="apellidos">Apellidos:</label>
                    <input id="apellidos" type="text">
                </div>
                <div class="nombre col-6">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" type="text">
                </div>
                <div class="user offset-6 col-6">
                    <label for="user">User:</label>
                    <input id="user" type="text">
                </div>
                <div class="fecha col-4">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" type="text">
                </div>
                <div class="hora-inicio col-4">
                    <label for="hora-inicio">Hora de inicio:</label>
                    <input type="time" class="hora-inicio" id="hora-inicio" type="text">
                </div>
                <div class="hora-fin col-4">
                    <label for="hora-fin">Hora final:</label>
                    <input type="time" id="hora-fin" type="text" step="1800">
                </div>
            </div>
        </div>
    </form>
</div>
<div class="select-users"></div>




    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/utiles.js"></script>
</body>
</html>