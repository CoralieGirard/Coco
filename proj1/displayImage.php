<?php
    include "CLASSES/IMAGES/Images.php";

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
        <title> Display Image</title>
    </head>
    <body>
        <?php

            if(isset($_GET["idAlbum"]))
            $image_arr = Images::listImagesByIdAlbum($_GET["idAlbum"]);

            if(isset($_GET["idImage"]))
            {
                $image_arr=array();
                $image = new Images();
                $image->loadImageById($_GET["idImage"]);
                array_push($image_arr,$image);

            }

            foreach($image_arr as $image){

                $image->displayImage();

            }
        ?>
    </body>
</hmtl>