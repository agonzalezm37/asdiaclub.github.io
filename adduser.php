<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

    include_once "funcionesdb.php";

    if(isset($_POST["nombre"])){
        addUser($_POST["nombre"], $_POST["apellidos"], $_POST["tipo"], $_POST["email"]);
    }

?>
<form method="post">
    <div>
        <label for="new-user-nombre">Nombre</label>
        <input type="text" id="new-user-nombre" name="nombre">
    </div>
    <div>
        <label for="new-user-apellidos">Apellidos</label>
        <input type="text" id="new-user-apellidos" name="apellidos">
    </div>
    <div>
        <label for="new-user-email">Email</label>
        <input type="email" id="new-user-email" name="email">
    </div>
    <div>
        <label for="new-user-tipo"></label>
        <select name="tipo" id="new-user-tipo">
            <option value="N">No Socio</option>
            <option value="S" selected>Socio</option>
        </select>
    </div>
    <input type="submit" value="submit">

    
</form>

</body>
</html>