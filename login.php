<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <?php
    // prueba();

    include_once "funcionesdb.php";
    
        if(isset($_POST["user"])){
            $row = login_user($_POST["user"], $_POST["passwd"]);
            print_r($row);
            if($row != null){
                session_start();
                foreach ($row as $clave => $valor){
                  $_SESSION[$clave] = $valor;
              }
                echo "Éxito!! Sesion iniciada";
            }
        }else{
            session_start();
            unset($_SESSION["user"]);
            session_destroy();
        }
        // header("refresh:3; url=". $_SERVER['HTTP_REFERER']);
    ?>
</body>
</html>