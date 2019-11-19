<?php
include_once "funcionesdb.php";


if( isset($_GET['fecha_inicial']) ) {
  get_reservas_by_range($_GET['fecha_inicial'], $_GET['fecha_final']);
}
else if(isset($_GET["new_reserva"])){
  get_next_reserva_index();
}
else if(isset($_GET["apellido"])){
  get_listOfUsers($_GET["apellido"]);
}
else if(isset($_GET["borrar_reserva"])){
  deleteReserva($_GET["borrar_reserva"]);
}
else {
  die("Solicitud no válida.");
}

exit();
?>