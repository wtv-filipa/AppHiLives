<?php

if (isset($_POST["image"])) {
    $data = $_POST["image"];

    $nome = $_POST["name"];

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $filename = "../../admin/uploads/img_perfil/" . $nome . '.png';
    $filename_bd = $nome . '.png';

    file_put_contents($filename, $data);


    //If no errors registred, print the success message

    if (isset($_POST["name"])) {
        $idUser = $_POST["name"];
        $image = $filename_bd;

        // We need the function!
        require_once("../connections/connection.php");

        // Create a new DB connection
        $link = new_db_connection();

        /* create a prepared statement */
        $stmt = mysqli_stmt_init($link);

        $query = "UPDATE users
              SET  profile_img = ?
              WHERE idUser = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'si',  $image, $idUser);

            /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            /* close statement */
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($link);
        }
        /* close connection */
        mysqli_close($link);
        // mysql_query("update SQL statement ");
        echo "Image Uploaded Successfully!";
    }
}
