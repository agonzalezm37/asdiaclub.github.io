<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Subir archivos al servidor</title>
    <meta name ="author" content ="Norfi Carrodeguas">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php session_start() ?>
        <table class="table w-100 text-center ">
            <thead>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora de entrada</th>
                <th>Hora de salida</th>
                <th>Pista</th>
                <th>Fecha Reserva</th>
                <th>Liga</th>
            </thead>
            <tbody class="reservas-table">
                <?php
                include_once "funcionesdb.php";
                    $reservas = getReservasbyUser($_SESSION["user"]);
                    $hoy = date("Y-m-d");
                    foreach ($reservas as $clave => $valor) {
                        $pasada = "";
                        $liga = "";
                        if($valor["nombre"] != "ninguna"){
                            $liga = " liga";
                        }
                        if($hoy > $valor["fecha"]) $pasada = "pasada";
                        echo "<tr class='reservac ". $pasada . $liga . "'>
                            <td> ". $valor["id"] ." </td>
                            <td> ". $valor["fecha"] ." </td>
                            <td> ". $valor["hora_inicio"] ." </td>
                            <td> ". $valor["hora_fin"] ." </td>
                            <td> ". $valor["pista"] ." </td>
                            <td>". $valor["fecha_registro"] ." </td>
                            <td>". $valor["nombre"] ." </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        var reservaSelected = null;
        $(".reservac").on("click", function(){
            $(this).addClass("selected");
            if(reservaSelected != null){
                reservaSelected.removeClass("selected");
            }
            $(".cancelar-reserva-btn").removeClass("disabled");
            reservaSelected = $(this);
        });
        $(".cancelar-reserva-btn").on("click", function(){
            if(reservaSelected!=null){
                $.ajax({
                    type: "GET",
                    url: "calendario.php",
                    typedata: "html",
                    data: {borrar_reserva: reservaSelected.children().eq(0).text()}
                })
                .done(function(result){
                    reservaSelected.addClass("close-reserva");
                });
            }
        });


    </script>
</body>
</html>    
