<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Cabecera</title>
</head>
<body>
    <?php session_start(); ?>
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
                                        <a class="portrait" href="user.php"><img src="<?php echo "img/usuarios/" . $_SESSION["user"] . "/portrait.jpg"; ?>" alt="portrait"></a>
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


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/utils.js"></script>
</body>
</html>