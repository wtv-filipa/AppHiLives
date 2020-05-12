<?php

if (isset($_GET["block"]) && isset($_GET["a"])) {
    $idUser = $_GET["block"];
    $active = $_GET["a"];

    require_once("../connections/connection.php");

// Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    if ($active == 1) {
        $query = "UPDATE users
              SET active = 0
              WHERE idUser = ?";


    } else {
        $query = "UPDATE users
              SET active = 1
              WHERE idUser = ?";

    }

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {

            //header("Location: ../administradores.php?msg=1");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {

        //header("Location: ../administradores.php?msg=1");
    }
    /* close connection */

    header("Location: ../index.php");
} else {

    //header("Location: ../administradores.php?msg=1");
}