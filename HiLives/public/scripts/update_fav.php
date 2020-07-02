<?php
session_start();
if (isset($_GET["match"]) && isset($_GET["fav"])) {
    $match = $_GET["match"];
    $fav = $_GET["fav"];
    require_once("../connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);
    if ($fav == 1) {
        $query = "UPDATE young_university
              SET favorite = 0
              WHERE id_match = ?";
    } else {
        $query = "UPDATE young_university
              SET favorite = 1
              WHERE id_match = ?";
    }

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $match);
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
    header("location:" . $_SERVER['HTTP_REFERER']);
} else {
    if (isset($_GET["m"]) && isset($_GET["f"])) {
        $match = $_GET["m"];
        $fav = $_GET["f"];
        require_once("../connections/connection.php");
        // Create a new DB connection
        $link = new_db_connection();
        /* create a prepared statement */
        $stmt = mysqli_stmt_init($link);
        if ($fav == 1) {
            $query = "UPDATE user_has_vacancies
              SET favorite = 0
              WHERE id_match_vac = ?";
        } else {
            $query = "UPDATE user_has_vacancies
              SET favorite = 1
              WHERE id_match_vac = ?";
        }

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $match);
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
        header("location:" . $_SERVER['HTTP_REFERER']);
    }
}
