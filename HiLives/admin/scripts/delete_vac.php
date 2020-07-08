<?php
session_start();
if (isset($_GET["apaga"])) {
    echo "estou aqui para apagar uma vaga de emprego";
    $idVacancies = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "DELETE FROM vacancies WHERE idVacancies = ?";
    $query2 = "DELETE FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";
    $query3 = "SELECT id_match_vac FROM user_has_vacancies WHERE Vacancies_idVacancies = ?";
    $query4 = "DELETE FROM learning_path_capacities WHERE fk_match_vac = ?";
    $query5 = "DELETE FROM user_has_vacancies WHERE Vacancies_idVacancies = ?";


    if (mysqli_stmt_prepare($stmt, $query3)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_match_vac);
        while (mysqli_stmt_fetch($stmt)) {
            //apaga percurso
            if (mysqli_stmt_prepare($stmt2, $query4)) {
                mysqli_stmt_bind_param($stmt2, 'i', $id_match_vac);
                // VALIDAÇÃO DO RESULTADO DO EXECUTE
                if (!mysqli_stmt_execute($stmt2)) {
                    header("Location: ../vacancies_emp.php");
                    $_SESSION["vac"] = 2;
                }
            } else {
                header("Location: ../vacancies_emp.php");
                $_SESSION["vac"] = 2;
            }
            //apaga match
            if (mysqli_stmt_prepare($stmt2, $query5)) {
                mysqli_stmt_bind_param($stmt2, 'i', $idVacancies);
                if (!mysqli_stmt_execute($stmt2)) {
                    header("Location: ../vacancies_emp.php");
                    $_SESSION["vac"] = 2;
                }
            } else {
                header("Location: ../vacancies_emp.php");
                $_SESSION["vac"] = 2;
            }
        }
    }
    //SEGUNDA QUERY- apagar as cpacidades
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../vacancies_emp.php");
            $_SESSION["vac"] = 2;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../vacancies_emp.php");
        $_SESSION["vac"] = 2;
    }

    //PRIMEIRA QUERY- apagar a vaga
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../vacancies_emp.php");
            $_SESSION["vac"] = 2;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../vacancies_emp.php");
        $_SESSION["vac"] = 2;
    }
    mysqli_close($link);
    //SUCCESS
    header("Location: ../vacancies_emp.php");
    $_SESSION["vac"] = 1;
} else {
    header("Location: ../vacancies_emp.php");
    $_SESSION["vac"] = 2;
}
