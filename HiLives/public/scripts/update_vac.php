<?php
session_start();
require_once "../connections/connection.php";
$idVacancies = $_GET["idvac"];
if (isset($_GET["idvac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"])) {

    $idVacancies = $_GET["idvac"];
    $vacancie_name = $_POST["nomevaga"];
    $description_vac = $_POST["descricao"];
    $number_free_vanc = $_POST["numvagas"];
    $requirements = $_POST["requisitos"];
    $Region_idRegion = $_POST["regiao"];
    $Workday_idWorkday = $_POST["jornada"];
    $Educ_lvl_idEduc_lvl = $_POST["educ"];
    $Areas_idAreas = $_POST["area"];


    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE vacancies
      SET vacancie_name = ?, description_vac=?, number_free_vanc=?, requirements = ?, Region_idRegion=?, Workday_idWorkday=?, Educ_lvl_idEduc_lvl=?, Areas_idAreas=?
      WHERE idVacancies = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssiiiii', $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $idVacancies);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            //ERRO
            header("Location: ../edit_vac.php?idvac=$idVacancies");
            $_SESSION["vac"] = 2;
            //echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            //CAPACIDADES
            if (!empty($_POST["capacity"])) {
                // APAGAR TODOS AS CAPACIDADES ASSOCIADAS À VAGA
                $query2 = "DELETE FROM vacancies_has_capacities
                        WHERE vacancies_idVacancies = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idVacancies);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);
            }
            $query3 = "INSERT INTO vacancies_has_capacities (vacancies_idVacancies, capacities_idcapacities)
                  VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query3)) {

                mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);

                // ADICIONA AS CAPACIDADES
                foreach ($_POST["capacity"] as $capacities_idcapacities) {
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }

            /* close connection */
            mysqli_close($link);
            //sucess
            header("Location: ../all_vacancies_comp.php");
            $_SESSION["vac"] = 3;
        }
    }
} else {
    //ERRO
    header("Location: ../edit_vac.php?idvac=$idVacancies");
    $_SESSION["vac"] = 1;
}
