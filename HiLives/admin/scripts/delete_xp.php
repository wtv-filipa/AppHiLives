<?php

if (isset($_GET['apaga'])){
    echo "estou a apagar uma experiência";
    $idContent = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM experiences WHERE Content_idContent = ?";
    $query2 = "DELETE FROM content WHERE idContent = ?";

    //PRIMEIRA QUERY
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idContent);


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
        mysqli_stmt_bind_param($stmt, 'i', $idContent);


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
    echo "sucesso";
    header("Location:../contents_jovem.php");
}