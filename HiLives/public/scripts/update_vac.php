<?php
require_once "../connections/connection.php";

if (isset($_GET["idvac"]) && isset($_POST["nomevaga"]) && isset($_POST["descricao"]) && isset($_POST["numvagas"]) && isset($_POST["requisitos"])) {

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
            echo "erro da stmt execute <br/>";
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            //CAPACIDADES
            if (isset($_POST["capacity"])) {
                // APAGAR TODOS AS CAPACIDADES ASSOCIADAS À VAGA
                $query2 = "DELETE FROM personality_has_vacancies
                        WHERE Vacancies_idVacancies = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idVacancies);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

            }
            $query3 = "INSERT INTO personality_has_vacancies (Personality_idPersonality, Vacancies_idVacancies)
                  VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query3)) {

                mysqli_stmt_bind_param($stmt, 'ii', $Personality_idPersonality, $idVacancies);

                // ADICIONA AS CAPACIDADES
                foreach ($_POST["capacity"] as $Personality_idPersonality) {
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }

            /* close connection */
            mysqli_close($link);
            header("Location: ../vacancie.php");
        }



        }

}