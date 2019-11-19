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

<?php
    session_start();
?>
<header class="cabecera">
<div class="container">
    <div class="row">
        <div class="col-3 header-logo">
            <a class="header-logo-link" href="#"><img src="" alt="asdia"></a>
        </div>
        <div class="col-9 header-menu">
            <nav class="nav-caja">
                <ul class="nav caja-nav">
                    <a class="d-block d-lg-none mvl-menu-logo" href=""> <img src="assets/img/logo.png" alt=""></a>
                    <li class="nav-item">
                        <a class="nav-link">
                            asdia
                        </a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            galería
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            noticias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            ligas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            reservar
                        </a>
                    </li>
                    <li class="nav-item despl">
                        <a href="#" class="nav-link">
                            login
                        </a>
<?php if (!isset($_SESSION["user"])): ?>
                        <form class="desplegable" action="login.php" method="post">
                            <div class="input-g">
                                <label for="user" class="input-label">Usuario</label>
                                <input class ="input-input" type="text" name="user" id="user">
                            </div>
                            <div class="input-g">
                                <label for="passwd" class="input-label">Contraseña</label>
                                <input class ="input-input" type="text" name="passwd" id="passwd">
                            </div>
                            <div class="input-g">
                                <input type="submit" value="">
                            </div>
                            <div class="input-g">
                                <a class="" href="">Registrarse</a>
                                <a class="" href="">Recuperar contraseña</a>
                            </div>
                        </form>
<?php else: ?>
                        <div class="desplegable ficha-user">
                            <div class="input-g user-data">
                                <a class="portrait" href="user.php"><img src="<?php?>" alt="portrait"></a>
                                <div class="ficha-user-data">
                                    <p class="nombre"> <?php echo $_SESSION["nombre"] ?></p>
                                    <p class="apellidos"><?php echo $_SESSION["apellidos"] ?></p>
                                </div>
                            </div>
                            <div class="input-g">
                                bonos: <?php ?>
                            </div>
                            <div class="input-g">
                                <a class="cerrar-sesion" href="login.php">Cerrar sesión</a>
                            </div>
                        </div>
<?php endif;?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
</header>

    <section class="user-data">
        <div class="container">
            <div class="row ficha-datos-per">
            <div class="col-12">
                <h2 class="title"> Datos Personales </h2>
            </div>
                <div class="col-4 portrait">
                    <img src="<?php echo "img/usuarios/" . $_SESSION["user"] . "/portrait.jpg"  ?>" alt="">
                        <form enctype='multipart/form-data' action='' method='post' class="text-left d-flex justify-content-center m-3">
                            <input name='uploadedfile' id="uploadedfile" type='file' style="position:absolute; right: 9000px"> 
                            <label for="uploadedfile" class="btn btn-primary mb-0">Seleccionar nueva foto </label>
                            <input class="btn btn-primary" type='submit' value='Subir archivo'>
                        </form>
                </div>
                <div class="col-8 ficha-datos-personales d-flex flex-column justify-content-center">
                    <p><b> Nombre:</b> <?php echo $_SESSION["nombre"] ?> </p>
                    <p><b> Apellidos:</b>  <?php echo $_SESSION["apellidos"] ?> </p>
                    <p><b> Fecha de registro:</b> <?php echo $_SESSION["fecha_ingreso"] ?></p>
                </div>
            </div>
            <div class="row reservas">
                <div class="col-12 d-flex flex-row justify-content-between align-items-center">
                    <h2 class="title">Reservas</h2>

                    <button class="btn btn-danger cancelar-reserva-btn disabled">
                        Cancelar reserva
                    </button>
                </div>
                <div class="col-12 table-reservas t-resize">
        

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



                </div>
                <div class="table-resizer"></div>

                <div class="col-6 btn-group btn-group-toggle btns-pasadas" data-toggle="buttons">
                    <label class="btn btn-secondary btn-prev">
                        <input type="radio" name="options" autocomplete="off"> <
                    </label>
                    <label class="btn btn-secondary active btn-mid">
                        <input type="radio" name="options" autocomplete="off" checked> Reservas Pasadas
                    </label>
                    <label class="btn btn-secondary btn-next">
                        <input type="radio" name="options" autocomplete="off"> >
                    </label>
                </div>

                <div class="col-6 btn-group btn-group-toggle btns-ligas" data-toggle="buttons">
                    <label class="btn btn-primary btn-prev">
                        <input type="radio" name="options" autocomplete="off"> <
                    </label>
                    <label class="btn btn-primary active btn-mid">
                        <input type="radio" name="options" autocomplete="off" checked> Reservas de Ligas
                    </label>
                    <label class="btn btn-primary btn-next">
                        <input type="radio" name="options" autocomplete="off"> >
                    </label>
                </div>
            </div>

                            <?php
                            print_r($_SESSION);
                                $userInfo = getInfoFromUser($_SESSION["user"]);   //obtiene un array con toda la informacion del usuario de la base de datos 
                            ?>
            <?php    if($userInfo["tipo"] == "S") :  ?>
            
            <div class="row row-bonos-ligas">
                
                


                <div class="col-6 col-bonos">
                    <h2 class="title ttip" data-toggle="tooltip" data-placement="top" title="Los bonos te permiten reservar pista para partido de liga. Puedes comprarlos aquí."> Bonos </h2>
                    <div class="d-flex justify-content-between">
                        <p>Bonos actuales: <b><?php echo $userInfo["bonos"] ?></b></p>
                        <a href="" class="link"> Aumentar bonos </a>
                    </div>
                </div>

                <div class="col-6 col-ligas" >
                    <h2 class="title ttip" data-toggle="tooltip" data-placement="top" title="Aqui se registran las ligas en las que has participado">Ligas</h2>
                    <div class="t-resize user-tabla-ligas">
                        <table class=" table text-center">
                            <thead >
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $ligas = getLigasbyUser($_SESSION["user"]);

                                foreach ($ligas as $row) {
                                    echo "<tr>";
                                    foreach ($row as $valor){
                                        echo "<td> $valor </td>";
                                    }
                                    echo "</tr>";
                                }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-resizer"></div>
                </div>
            </div>

            <?php endif; ?>
        </div>
    </section>

<?php

if(isset($_FILES['uploadedfile']['name'])){
    $target_path = "img/usuarios/" . $_SESSION["user"] . "/";
    // $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
    $target_path = $target_path . "portrait.jpg";
    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
    {
    echo "<span style='color:green;'>El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido</span><br>";
    }else{
    echo "Ha ocurrido un error, trate de nuevo!";
    }
    die();
}
?>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/utils.js"></script>

    <script>
        $(".ttip").tooltip();


        $(".btns-pasadas .btn-next").on("click", function(){
            console.log("+");
            
            if(!$(this).hasClass("active")){
                $(".pasada").removeClass("close-reserva");
                $(".reservac:not(.pasada)").addClass("close-reserva");
            }
        });
        $(".btns-pasadas .btn-prev").on("click", function(){
            console.log("-");
            if(!$(this).hasClass("active")){
                $(".reservac:not(.pasada)").removeClass("close-reserva");
                $(".pasada").addClass("close-reserva");
            }
        });
        $(".btns-pasadas .btn-mid").on("click", function(){
            if(!$(this).hasClass("active")){
                $(".reservac").removeClass("close-reserva");
            }
        });

        $(".btns-ligas .btn-next").on("click", function(){
            console.log("+");
            
            if(!$(this).hasClass("active")){
                $(".liga").removeClass("close-reserva");
                $(".reservac:not(.liga)").addClass("close-reserva");
            }
        });
        $(".btns-ligas .btn-prev").on("click", function(){
            console.log("-");
            if(!$(this).hasClass("active")){
                $(".reservac:not(.liga)").removeClass("close-reserva");
                $(".liga").addClass("close-reserva");
            }
        });
        $(".btns-ligas .btn-mid").on("click", function(){
            if(!$(this).hasClass("active")){
                $(".reservac").removeClass("close-reserva");
            }
        });





        var lastMousePos;
        
        $(".table-resizer").on("mousedown", function(){
            var table = $(this).parent().children(".t-resize");
            $(document).on("mouseup", function(){
                $(this).off("mouseup");
                $(this).off("mousemove");
                lastMousePos = null;
            });
            $(document).on( "mousemove", function(e){
                currentMousePos = e.pageY;
                if(lastMousePos != null){
                    table.css({
                        "height" : table.outerHeight() +(currentMousePos - lastMousePos)
                    });
                }
                lastMousePos = currentMousePos;
            });
        });

        $(".table-reservas").on("scroll", function(){
            var scrollTop = $(this).scrollTop();
            console.log(scrollTop);

            $(this).find("thead").css({
                top : scrollTop + "px"
            })
        });
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