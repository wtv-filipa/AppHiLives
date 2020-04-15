<?php
    echo "EMPRESA";
require_once "../connections/connection.php";

if (isset($_POST["comp"])) {
    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (User_type_idUser_type) VALUES (?)";
    $role = 2;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $User_type_idUser_type);
        $User_type_idUser_type = $role;


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            echo "ESTÁ NA BD";
            //header("Location: ../login.php?msg=2");
        } else {
            // ERROR ACTION
            echo "NAO DEU POR ERRO DA BD";
            //header("Location: ../register.php?msg=0");
        }

    } else {
        // ERROR ACTION
        echo "ERRO";
        //header("Location: ../register.php?msg=0");
        mysqli_close($link);
    }


} else {
    echo "ERRO não selecionou nada";
    // header("Location: ../register.php?msg=2");
}