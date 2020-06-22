<?php

if (isset($_GET["apaga"])) {
    echo "estou aqui para apagar uma vaga de emprego";
    $idVacancies = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM vacancies WHERE idVacancies = ?";
    $query2 = "DELETE FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";
    $query3 = "DELETE FROM user_has_vacancies WHERE Vacancies_idVacancies = ?";

    //PRIMEIRA QUERY- apagar a vaga
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);


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
    //SEGUNDA QUERY- apagar as cpacidades
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);


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
     //TERCEIRA QUERY- apagar os matchs com users
     $stmt = mysqli_stmt_init($link);
     if (mysqli_stmt_prepare($stmt, $query3)) {
         mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
 
 
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
    mysqli_stmt_close ($stmt);
    mysqli_close($link);
    header("Location:../vacancies_emp.php");
}
