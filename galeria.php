<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/lightbox.min.css">
    <title>Document</title>
</head>
<body>
    <section class="galeria">
        <div class="container">
            <div class="row">
                <?php
                    include_once "funcionesdb.php";
                    $imagenes = getSQLArray("SELECT src, titulo, descripcion from galeria");
                    foreach ($imagenes as $row) {
                        echo "<div class='col-3 p-2'> <a class = 'item-gal' href= 'img/galeria/". $row["src"] ."' title='Ampliar' data-lightbox='galeria' data-title='Autos JB - Jose A.Barrera' >";
                            echo "<img class='item-img' src='img/galeria/". $row["src"] ."' alt='". $row["titulo"] ."'>";
                            echo "<span class='item-title'>". $row["titulo"] ."</span>";
                        echo "</a></div>";
                    }
                ?>
            </div>
        </div>

    </section>

    <footer class="pie">
        <div class="pie-main">
            <a href="" class="logo-abajo">
                <img src="img/logo.jpg" alt="">
            </a>
            <div class="pie-contacto">
                <p>C/nosnsfjiefwkfmoidsfisdjffsdijosdfa Badajoz</p>
                <p>Tel: <a href="tel:+34924536585">924 53 65 85</a></p>
                <a href="mailto: antonio.glezmo@gmail.com">antonio.glezmo@gmail.com</a>
            </div>
        </div>
        </div>
        <div class="banda-abajo">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href=""> &copy; asdia club de tenis </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Políticas de privacidad </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Politica de privacidad </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">info@asdiaclubdeTenis.es </a>
                </li>
                
            </ul>
        </div>
    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/utiles.js"></script>
</body>
</html>