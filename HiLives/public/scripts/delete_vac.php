<?php
session_start();
if (isset($_GET["apaga"])) {
    //echo "estou aqui para apagar uma vaga de emprego";
    $idVacancies = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM vacancies WHERE idVacancies = ?";
    $query2 = "DELETE FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";

    //PRIMEIRA QUERY
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {
            //ERRO
            header("Location: ../all_vacancies_comp.php");
            $_SESSION["vac"] = 2;
            //echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        //ERRO
        header("Location: ../all_vacancies_comp.php");
        $_SESSION["vac"] = 2;
    }
    //SEGUNDA QUERY
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {
            //ERRO
            header("Location: ../all_vacancies_comp.php");
            $_SESSION["vac"] = 2;
            //echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        //ERRO
        header("Location: ../all_vacancies_comp.php");
        $_SESSION["vac"] = 2;
    }
    //SUCESSO
    header("Location: ../all_vacancies_comp.php");
    $_SESSION["vac"] = 4;
    /* close connection */
    mysqli_close($link);
} else {
    //ERRO
    header("Location: ../all_vacancies_comp.php");
    $_SESSION["vac"] = 2;
}
