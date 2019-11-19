<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Tomorrow&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>CPanel - ASDIA</title>
</head>
<body>
    <?php       session_start();?>
    <div class="container p-0">
        <header class="cabecera containter-fluid">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-start">
                    <a class="header-logo" href="index.php"> <img src="../img/" alt="Asdia - CPanel"> </a>
                </div>
                <div class="col-4 text-center d-flex align-items-center justify-content-center">
                    <p class="header-cpanel" >Panel de control</p>
                </div>
                <div class="col-4 text-right d-flex align-items-center justify-content-end links-right">
                    <?php
                    
                        if(isset($_SESSION["admin"])):
                    ?>

                    <span> <?php echo $_SESSION["nombre"] ?></span>

                    <a href="login.php" class="header-link">cerrar session</a>
                    
                    <?php
                        endif;
                    ?>
                    <a href="" class="header-link">Volver a la Web</a>
                </div>
            </div>

        </header>

        <?php
 
        if(!isset($_SESSION["admin"])):
        ?>
        <div class="login pt50 pb50">
            <form action="login.php" method="post">
                <table class="">
                    <tr>
                        <td class="label"><label for="usuario"> Usuario:</label></td>
                        <td class="input"><input type="text" id="usuario" name="admin"></td>
                    </tr>
                    <tr>
                        <td class="label"><label for="password"> Contraseña:</label></td>
                        <td class="input"><input type="password" id="password" name="password"></td>
                    </tr>
                    <tr>
                        <td colspan = 2>
                            <input class="submit" type="submit" value="Acceder">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
        elseif(isset($_GET["categoria"])):

            switch ($_GET["categoria"]):case "galeria": include "php/galeria.php";break;
            ?>
            <?php case "usuarios": include "php/usuarios.php";break;?>
            <?php case "nosotros": include "php/nosotros.php";break;?>
            <?php case "reservas": include "php/reservas.php";break;?>
            <?php endswitch;?>

        <?php
        else:   
        ?>
        <section class="categorias">
            <div class="container">
                <div class="row">
                    <div class="col-2 categoria-col">
                        <a class="btn-self" href="index.php?categoria=reservas">Reservas</a>
                    </div>
                    <div class="col-2 categoria-col">
                        <a class="btn-self" href="index.php?categoria=usuarios">Usuarios</a>
                    </div>
                    <div class="col-2 categoria-col">
                        <a class="btn-self" href="index.php?categoria=galeria">Galería</a>
                    </div>
                    <div class="col-2 categoria-col">
                        <a class="btn-self" href="index.php?categoria=nosotros">Nosotros</a>
                    </div>
                </div>
            </div>
        </section>

        <?php
        endif;
        ?>

        <footer class="pie">
            <a href="mailto:info@asdiaclubdetenis.es"> info@asdiaclubdetenis.es</a>
        </footer>
    </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="cpanel.js"></script>
</body>

</html>