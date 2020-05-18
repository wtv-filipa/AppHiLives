<?php
require_once "../connections/connection.php";

if (isset($_GET["vac"]) && isset($_POST["nomevaga"]) && isset($_POST["descricao"]) && isset($_POST["numvagas"]) && isset($_POST["requisitos"])) {


    $idUser = $_GET["vac"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO vacancies (vacancie_name, description_vac, number_free_vanc, requirements, Region_idRegion, User_publicou, Workday_idWorkday, Educ_lvl_idEduc_lvl, Areas_idAreas) VALUES (?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssiiiii', $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $idUser, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas);


        echo "User que publicou: $idUser";
        $vacancie_name = $_POST["nomevaga"];
        $description_vac = $_POST["descricao"];
        $number_free_vanc = $_POST["numvagas"];
        $requirements = $_POST["requisitos"];
        $Region_idRegion = $_POST["regiao"];
        $Workday_idWorkday = $_POST["jornada"];
        $Educ_lvl_idEduc_lvl = $_POST["educ"];
        $Areas_idAreas = $_POST["area"];


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            echo "ESTÁ NA BD <br>";

            //INSERIR PERSONALIDADE
            if (isset($_POST["personalidade"])) {

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query1 = "SELECT MAX(idVacancies) FROM vacancies";

                if (mysqli_stmt_prepare($stmt, $query1)) {
                    /* execute the prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $idVacancies);

                        /* fetch values */
                        while (mysqli_stmt_fetch($stmt)) {
                            $query2 = "INSERT INTO personality_has_vacancies (Personality_idPersonality, Vacancies_idVacancies)
                  VALUES (?, ?)";
                            //parte do insert
                            if (mysqli_stmt_prepare($stmt, $query2)) {

                                mysqli_stmt_bind_param($stmt, 'ii', $Personality_idPersonality, $idVacancies);

                                // PARA TODOS OS JOGADORES QUE FORAM ESCOLHIDOS
                                foreach ($_POST["personalidade"] as $Personality_idPersonality) {
                                    echo "id da personalidade: $Personality_idPersonality<br>";
                                    /* execute the prepared statement */
                                    if (!mysqli_stmt_execute($stmt)) {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                }
                                /* close statement */
                                mysqli_stmt_close($stmt);
                            }
                            //fim da cena do insert
                        }
                    }
                }
            } else {
                ///isto é do isset
                echo "ERRO de não temos nada inserido";
                // header("Location: ../register.php?msg=2");
            }
            header("Location: ../home_people.php");
        }else {
            // ERROR ACTION
            echo "Error: " . mysqli_stmt_error($stmt);
            //echo "NAO DEU <br>";
            //header("Location: ../register.php?msg=0");
        }
    }
} else {
    echo "nao passa no if";
}