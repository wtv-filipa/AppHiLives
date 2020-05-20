<?php

if (isset($_GET["apaga"])) {
    $idUser = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM user_has_areas WHERE User_idUser = ?";
    $query2 = "DELETE FROM user_has_region WHERE User_idUser_region = ?";
    $query3="DELETE FROM user_has_personality WHERE User_idUser = ?";
    $query4 = "DELETE FROM users WHERE idUser = ?";

    //PRIMEIRA QUERY
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {

            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "erro";
        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
    }
    //SEGUNDA QUERY
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {

            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "erro";
        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
    }
    //TERCEIRA QUERY
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query3)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {

            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "erro";
        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
    }
    //QUARTA QUERY
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query4)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {

            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "erro";
        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
    }
    mysqli_close($link);
    echo "utilizador apagado com sucesso";
    header("Location:../index.php");


}
