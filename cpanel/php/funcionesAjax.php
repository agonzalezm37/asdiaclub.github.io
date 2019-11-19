<?php
    include_once "../../funcionesdb.php";
    if(isset($_POST["mostrar-btn"])){
        updateRow($_POST["id"], $_POST["tabla"], $_POST["columna"], $_POST["valor"]);
    }else if(isset($_POST["subir-img"])){
        // header("refresh:5; url=". $_SERVER['HTTP_REFERER']);
        $target_path = "../../img/galeria/";
        $filename = str_shuffle("qwertyuiopasdfghjklzxcvbnm123456789");
        $target_path = $target_path . $filename .".jpeg"; 
        if(move_uploaded_file($_FILES['img']['tmp_name'], $target_path)) {
            echo "El archivo ".  $filename .
            " ha sido subido";
        } else{
            echo "Ha ocurrido un error, trate de nuevo!";
        }
        $removeImg = getSQLArray("SELECT src from galeria where id = ". $_POST["id"]);
        if($removeImg != null){
            unlink( "../../img/galeria/". $removeImg[0]["src"]);
        }
        updateRow($_POST["id"], $_POST["tabla"], "src", $filename . ".jpeg");
        $img = imagecreatefromjpeg($target_path);
        $imageSize = getimagesize($target_path);
        $aspectRatio = $imageSize[0]/$imageSize[1];
        if($aspectRatio < 1.5){
            $img = imagescale ( $img , 360);
            $rect["x"] = 0;
            $rect["y"] = (360/$aspectRatio - 240)/2;
            $rect["width"] = 360;
            $rect["height"] = 240;
            $img = imagecrop($img, $rect);
        }else{
            $img =  imagescale ( $img , 240*$aspectRatio, 240);
            $rect["x"] = (240*$aspectRatio - 360)/2;
            $rect["y"] = 0;
            $rect["width"] = 360;
            $rect["height"] = 240;
            $img = imagecrop($img, $rect);
        }

        // Imprimir la imagen
        imagejpeg ($img, "../../img/galeria/miniatura-" . $filename . ".jpeg");

    }else if(isset($_POST["galeria-nueva-linea"])){
        newGalleryItem();
    }
    else{
        echo "fallo en funcionesAjax.php";
    }


?>