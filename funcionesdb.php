<?php

function get_db(){
$dbserver = "localhost";
$dbuser = "asdia";
$password = "asdia";
$dbname = "asdia";

$database = new mysqli($dbserver, $dbuser, $password, $dbname);

if($database->connect_errno) {
    die("No se pudo conectar a la base de datos");
}
return $database;
}
function get_reservas_by_range( $fecha_inicial, $fecha_final ) {

    $database = get_db();

    $jsondata = array();

    //Sanitize ipnut y preparar query
        // $fecha_inicial = intval($fecha_inicial);

    if ( $result = $database->query( "SELECT reserva.fecha, reserva.hora_inicio, reserva.hora_fin, reserva.pista, usuario.nombre FROM reserva reserva, usuario usuario WHERE reserva.fecha >= '" . $fecha_inicial . "' and reserva.fecha <= '" . $fecha_final."' and reserva.id_user = usuario.user")) {

        if( $result->num_rows > 0 ) {
            $jsondata["success"] = true;
            $jsondata["data"]["reservas"] = array();
            while( $row = $result->fetch_object() ) {
                $jsondata["data"]["reservas"][] = $row;
            }

        } else {
            $jsondata["success"] = false;
            $jsondata["data"] = array(
                'message' => 'No se encontró ningún resultado.'
            );
        }

    $result->close();

    } else {
    
        $jsondata["success"] = false;
        $jsondata["data"] = array(
        'message' => $database->error);
    }
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
    $database->close();
}

function get_next_reserva(){
    $database = get_db();
    if ( $result = $database->query( "SELECT gen.AUTO_INCREMENT
        FROM  INFORMATION_SCHEMA.TABLES gen
        WHERE gen.TABLE_SCHEMA = 'asasur'
        AND   gen.TABLE_NAME   = 'reserva'")) {
            echo $result->fetch_all()[0][0];
    }
    $database->close();
}

function get_listOfUsers($apellido) {

    $database = get_db();

    if ( $result = $database->query( "SELECT apellidos, nombre, user  FROM  usuario WHERE apellidos like '%$apellido%' and tipo = 'U' order by apellidos desc, nombre desc")) {

        while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['apellidos']."</td><td>".$row["nombre"]."</td><td>".$row["user"]."</td></tr>";
        }
    }else {
        echo $database->error;
    }
    $database->close();
}

function login_user($user, $password, $admin = false){
    $database = get_db();
    $tipos = "(tipo = 'U' or tipo = 'S')";
    $usertype = "user";
    if($admin) {
        $tipos = "(tipo = 'A' or tipo = 'E')";
        $usertype = "admin";
    }
    if ( $result = $database->query( "SELECT nombre, apellidos, tipo, user as $usertype, Date(fecha_ingreso) as fecha_ingreso
    FROM  usuario
    WHERE $tipos and user = '$user' and passwd = md5('$password')")) {
      if($result->num_rows>0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        echo "el usuario o contraseña es erróneo";
        return;
      }
    }else{
        echo $database->error;
        return;
    }
    $database->close();
}

function typeUser($user){
    $database = get_db();
    $sql = "SELECT tipo from usuario where user = '$user'";
    if($result = $database->query($sql)){
        if($row = $result->fetch_assoc()){
            return $row["tipo"];
        }
    }
    $database->close();
}

function getInfoFromUser($user, $inJquery = false){

    $database = get_db();
    $tipo = null;
    $sql = "SELECT tipo from usuario where user = '$user'";
    if($result = $database->query($sql)){
        if($row = $result->fetch_assoc()){
             $tipo = $row["tipo"];
        }
    }else{
        echo $database->error();
        $database->close();
        return;
    }
    switch ($tipo) {
        case "N":
            $sql = "SELECT us.user, us.nombre, us.apellidos, us.tipo, us.fecha_ingreso from usuario us, no_socio ns where user = '$user' and us.user = ns.id_user";
            break;
        case "S":
            $sql = "SELECT us.user, us.nombre, us.apellidos, us.tipo, us.fecha_ingreso, so.bonos  from usuario us, socio so where user = '$user' and us.user = so.id_user";
            break;
        case "A":
            $sql = "SELECT us.user, us.nombre, us.apellidos, us.tipo, us.fecha_ingreso from usuario us, administrador ad where user = '$user' and us.user = ad.id_user";
            break;
        case "E":
            $sql = "SELECT us.user, us.nombre, us.apellidos, us.tipo, us.fecha_ingreso from usuario us, empleado em where user = '$user' and us.user = em.id_user";
            break;
        default:
            echo "tipo de usuario erróneo, revisa la base de datos.";
            $database->close();
            return;
    }
    if($inJquery){          //comprueba si se requiere la info para json o en array
        $jsondata = array();
        if ( $result = $database->query($sql)) {
            if( $result->num_rows > 0 ) {
                $jsondata["success"] = true;
                $jsondata["data"]["reservas"] = array();
                while( $row = $result->fetch_object() ) {
                    $jsondata["data"]["reservas"][] = $row;
                }
            } else {
                $jsondata["success"] = false;
                $jsondata["data"] = array(
                    'message' => 'No se encontró ningún resultado.'
                );
            }
        $result->close();
    
        } else {
        
            $jsondata["success"] = false;
            $jsondata["data"] = array(
            'message' => $database->error);
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata, JSON_FORCE_OBJECT);

    }else{
        if($result = $database->query($sql)){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            echo $database->error;
        }
    }
    $database->close();
}

function getReservasbyUser($user, $omitir_pasadas = false){
    $database = get_db();
    $just_new = "";
    if($omitir_pasadas)        $just_new = "and res.fecha >= '" . date("Y-m-d") . "'";
    $sql = "SELECT res.id, res.pista, res.hora_inicio, res.hora_fin, res.fecha, date(res.fecha_registro) as fecha_registro, lig.nombre  from reserva res, liga lig where res.liga = lig.id and res.id_user = '$user'" . $just_new . " order by res.fecha , res.hora_inicio asc";
    if ($result = $database->query($sql)){
        $array = $result->fetch_all(MYSQLI_ASSOC);
        // print_r($array);
        return $array;
    }else{
        echo $database->error;
    }
    $database->close();
}

function deleteReserva($id){
    $database = get_db();
    $sql = "DELETE from reserva where id = $id";
    if($result = $database->query($sql)){
        
    }else{
        echo $database->error;
    }
}

function getLigasbyUser($user){
    $database = get_db();

    $sql = "SELECT DISTINCT lig.id, lig.nombre, lig.estado from reserva res, liga lig WHERE res.id_user = '$user' and res.liga = lig.id and lig.id != '1' ";
    if ($result = $database->query($sql)){
        $array = $result->fetch_all(MYSQLI_ASSOC);
        // print_r($array);
        return $array;
    }else{
        echo $database->error;
    }
}

function addUser($nombre, $apellido, $tipo, $email, $extra = 1){
    $database = get_db();
    $rand;
    $user;
    $tipos = "SNEA";
    if(strpos($tipos, $tipo) === false){
        echo "Tipo de usuario incorrecto";
        die();
    }
    do{
        $rand = rand(0, 99);
        $user = $nombre[0] . substr($apellido, 0, strpos($apellido, " ")) . $rand;
        $user = strtolower($user);
    }while ($database->query("SELECT * from usuario where user = ' $user '")->num_rows > 0);
    $string = "0123456789ABCDEFGHIJK";
    $passwd = substr(str_shuffle($string), 0, 12);
    $sql = "INSERT into usuario (user, nombre, apellidos, email, passwd, tipo) values ('$user', UPPER('$nombre'), UPPER('$apellido'), '$email', MD5('$passwd'), '$tipo')";
    if($database->query($sql)){
        echo "El nuevo usuario $user fue registrado";
    }else{
        echo $database->error;
        die();
    }

    switch ($tipo) {
        case 'N':
            $sql = "INSERT into no_socio (id_user) values ('$user')";
            break;
        case 'S':
            $sql = "INSERT into socio (id_user, id_empleado) values ('$user', '$extra')";
            break;
        case 'E':
            $sql = "INSERT into empleado (id_user, id_admin) values ('$user', '$extra')";
            break;
        case 'A':
            $sql = "INSERT into administrador (id_user) values ('$user')";
            break;
    }

    if($database->query($sql)){
        echo "El nuevo usuario $user fue registrado";
    }else{
        echo $database->error;
        die();
    }
}

function getSQLArray($sql){
    $database = get_db();
    if($result = $database->query($sql)){
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $database->close();
        return $row;
    }else{
        echo $database->error;
    }
    $database->close();
}

function updateRow($id, $tabla, $columna, $nuevoValor){
    $database = get_db();
    $sql = "UPDATE $tabla set $columna = '$nuevoValor' where id = $id";
    if($result = $database->query($sql)){
        echo "la columna $tabla.$columna = $nuevoValor se ha actualizado. id= $id";
        
    }else{
        echo $database->error;
    }
}
function newGalleryItem(){
    $database = get_db();
    $datos = getSQLArray("SELECT max(pos) as pos from galeria");
    $pos = $datos[0]["pos"] + 1;
    $sql = "INSERT into galeria (src, titulo, descripcion, mostrar, pos) values ('', 'Inserte título', 'Inserte descripción', 'N', '$pos')";
    if($result = $database->query($sql)){

    }else{
        $database->error;
    }

}
?>