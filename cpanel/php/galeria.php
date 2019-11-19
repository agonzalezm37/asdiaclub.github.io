<?php
    if($_SESSION["tipo"] != "A" ){
        header("refresh:3; url=index.php");
        echo "No puedes acceder a esta seccion si no eres Administrador";
        die();
    }
   ?>

    <section class="galeria">
        <h2 class="title">Galería</h2>
        <button class="btn-self nueva-imagen-btn" href="">Nueva imagen</button>

        <table class="tabla table">
            <thead>
                <tr>
                    <th class="tabla-head w25">Index</th>
                    <th class="tabla-head w70">IMG</th>
                    <th class="tabla-head w50">Title</th>
                    <th class="tabla-head w95">Desc</th>
                    <th class="tabla-head w65">Otros</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once "../funcionesdb.php";
                    $array = getSQLArray("SELECT * from galeria");
                    foreach ($array as $key => $row) {
                        echo "<tr class='galeria-row' data-row='". $row["id"] ."' data-tabla='galeria'>";
                        echo "<td class='w25'>". $row["pos"] ."</td>";
                        echo "<td class='img w70 img editable-img'> <img src='../img/galeria/miniatura-". $row["src"] ."'></td>";
                        echo "<td class='w50 editable-text' data-column='titulo'> <p>". $row["titulo"] ."</p></td>";
                        echo "<td class='w95 editable-text' data-column='descripcion' ><p class=' mb0'>". $row["descripcion"] ."</p></td> ";
                        echo "<td class='w50'> <a class='mostrar-btn ". (($row["mostrar"]== "S")? "active" : "") ."' href='javascript://'></a> </td>";
                        echo "</tr>";
                    }

                ?>
            </tbody>
        </table>
    </section>

