<?php

if (isset($_POST["image"])) {
    $data = $_POST["image"];

    $nome = $_POST["name"];

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $filename = "../uploads/img_perfil/" . $nome . '.png';
    $filename_bd = $nome . '.png';

    file_put_contents($filename, $data);


    if (isset($_POST["name"])) {
        $idUser = $_POST["name"];
        $image = $filename_bd;


        require_once("../connections/connection.php");

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "UPDATE users
              SET  profile_img = ?
              WHERE idUser = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'si',  $image, $idUser);

            if (!mysqli_stmt_execute($stmt)) {
            }
            mysqli_stmt_close($stmt);
        }
    }
}
