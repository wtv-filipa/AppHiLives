<?php
session_start();
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

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

    $query1 = "SELECT Region_idRegion, Areas_idAreas, Educ_lvl_idEduc_lvl FROM vacancies WHERE idVacancies = ?";

    $query2 = "DELETE FROM user_has_vacancies WHERE Vacancies_idVacancies = ? AND match_perc = 1 AND User_young IN ( SELECT User_idUser_region FROM user_has_region WHERE Region_idRegion = ?)";

    $query3 = "DELETE FROM learning_path_capacities WHERE fk_match_vac IN ( SELECT id_match_vac FROM user_has_vacancies INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies WHERE Region_idRegion = ? AND Vacancies_idVacancies = ? AND match_perc = 0 AND User_young IN ( SELECT User_idUser_region FROM user_has_region WHERE Region_idRegion = ? ))";

    $query4 = "DELETE FROM user_has_vacancies WHERE Vacancies_idVacancies = ? AND match_perc = 0 AND User_young IN ( SELECT User_idUser_region FROM user_has_region WHERE Region_idRegion = ?)";

    $query5 = "DELETE FROM user_has_vacancies WHERE Vacancies_idVacancies = ? AND match_perc = 1 AND User_young IN ( SELECT User_idUser FROM user_has_areas WHERE Areas_idAreas = ?)";

    $query6 = "DELETE FROM learning_path_capacities WHERE fk_match_vac IN ( SELECT id_match_vac FROM user_has_vacancies INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies WHERE Areas_idAreas = ? AND Vacancies_idVacancies = ? AND match_perc = 0 AND User_young IN ( SELECT User_idUser FROM user_has_areas WHERE Areas_idAreas = ? ))";

    $query7 = "DELETE FROM user_has_vacancies WHERE Vacancies_idVacancies = ? AND match_perc = 0 AND User_young IN ( SELECT User_idUser FROM user_has_areas WHERE Areas_idAreas = ?)";

    $query8 = "DELETE FROM user_has_vacancies 
               WHERE Vacancies_idVacancies = ? AND match_perc = 1 AND User_young IN ( 
               SELECT idUser FROM users 
               WHERE Educ_lvl_idEduc_lvl < ?)";

    $query9 = "DELETE FROM learning_path_capacities 
               WHERE fk_match_vac IN ( 
               SELECT id_match_vac FROM user_has_vacancies 
               INNER JOIN vacancies 
               ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
               WHERE Educ_lvl_idEduc_lvl < ? AND Vacancies_idVacancies = ? AND match_perc = 0 AND User_young IN ( 
               SELECT idUser FROM users 
               WHERE Educ_lvl_idEduc_lvl < ?))";

    $query10 = "DELETE FROM user_has_vacancies 
    WHERE Vacancies_idVacancies = ? AND match_perc = 0 AND User_young IN ( 
    SELECT idUser FROM users 
    WHERE Educ_lvl_idEduc_lvl < ?)";

    $query11 = "SELECT User_Young, Region_idRegion, Areas_idAreas FROM user_has_vacancies INNER JOIN user_has_region ON user_has_vacancies.User_Young = user_has_region.User_idUser_region INNER JOIN user_has_areas ON user_has_vacancies.User_Young = user_has_areas.User_idUser WHERE Vacancies_idVacancies = ?";
    /****/
    $areas_jovens = [];
    $regioes_jovens = [];

    if (mysqli_stmt_prepare($stmt, $query11)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $User_Young, $Region_jovem, $Areas_jovem);
        while (mysqli_stmt_fetch($stmt)) {

            if ($areas_jovens[$User_Young] === NULL) {
                $areas_jovens[$User_Young] = [];
            }
            if (!in_array($Areas_jovem, $areas_jovens[$User_Young])) {
                array_push($areas_jovens[$User_Young], $Areas_jovem);
            }

            if ($regioes_jovens[$User_Young] === NULL) {
                $regioes_jovens[$User_Young] = [];
            }
            if (!in_array($Region_jovem, $regioes_jovens[$User_Young])) {
                array_push($regioes_jovens[$User_Young], $Region_jovem);
            }
        }
    }

    if (mysqli_stmt_prepare($stmt, $query1)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Region_vaga, $Areas_vaga, $Educ_lvl_vaga);
        while (mysqli_stmt_fetch($stmt)) {
            if ($Region_vaga = !$Region_idRegion) {
                if (!in_array($Region_idRegion, $regioes_jovens[$User_Young])) {
                    if (mysqli_stmt_prepare($stmt2, $query2)) {
                        mysqli_stmt_bind_param($stmt2, 'ii', $idVacancies, $Region_vaga);

                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../edit_vac.php?idvac=$idVacancies");
                            $_SESSION["vac"] = 2;
                        }
                    } else {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                    /*****/
                    if (mysqli_stmt_prepare($stmt2, $query3)) {
                        mysqli_stmt_bind_param($stmt2, 'iii', $Region_vaga, $idVacancies, $Region_vaga);
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../edit_vac.php?idvac=$idVacancies");
                            $_SESSION["vac"] = 2;
                        } 
                    } else {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                    /*****/
                    if (mysqli_stmt_prepare($stmt2, $query4)) {
                        mysqli_stmt_bind_param($stmt2, 'ii', $idVacancies, $Region_vaga);
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../edit_vac.php?idvac=$idVacancies");
                            $_SESSION["vac"] = 2;
                        } 
                    } else {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                    /*****/
                }
            }
            if ($Areas_vaga != $Areas_idAreas) {
                if (!in_array($Areas_idAreas, $areas_jovens[$User_Young])) {
                    if (mysqli_stmt_prepare($stmt2, $query5)) {
                        mysqli_stmt_bind_param($stmt2, 'ii', $idVacancies, $Areas_vaga);
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../edit_vac.php?idvac=$idVacancies");
                            $_SESSION["vac"] = 2;
                        }
                    } else {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                    if (mysqli_stmt_prepare($stmt2, $query6)) {
                        mysqli_stmt_bind_param($stmt2, 'iii', $Areas_vaga, $idVacancies, $Areas_vaga);
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../edit_vac.php?idvac=$idVacancies");
                            $_SESSION["vac"] = 2;
                        } 
                    } else {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                    /*****/
                    if (mysqli_stmt_prepare($stmt2, $query7)) {
                        mysqli_stmt_bind_param($stmt2, 'ii', $idVacancies, $Areas_vaga);
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../edit_vac.php?idvac=$idVacancies");
                            $_SESSION["vac"] = 2;
                        }
                    } else {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                    /*****/
                }
            }
            if ($Educ_lvl_vaga != $Educ_lvl_idEduc_lvl && $Educ_lvl_vaga < $Educ_lvl_idEduc_lvl) {               
                if (mysqli_stmt_prepare($stmt2, $query8)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idVacancies, $Educ_lvl_idEduc_lvl);                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                } else {
                    header("Location: ../edit_vac.php?idvac=$idVacancies");
                    $_SESSION["vac"] = 2;
                }
                /*****/
                if (mysqli_stmt_prepare($stmt2, $query9)) {
                    mysqli_stmt_bind_param($stmt2, 'iii', $Educ_lvl_idEduc_lvl, $idVacancies, $Educ_lvl_idEduc_lvl);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    } 
                } else {
                    header("Location: ../edit_vac.php?idvac=$idVacancies");
                    $_SESSION["vac"] = 2;
                }
                /*****/
                
                if (mysqli_stmt_prepare($stmt2, $query10)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idVacancies, $Educ_lvl_idEduc_lvl);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    } 
                } else {
                    header("Location: ../edit_vac.php?idvac=$idVacancies");
                    $_SESSION["vac"] = 2;
                }
                /*****/
            }
        }
    }
    /******************************************************************/

    $query = "UPDATE vacancies
      SET vacancie_name = ?, description_vac=?, number_free_vanc=?, requirements = ?, Region_idRegion=?, Workday_idWorkday=?, Educ_lvl_idEduc_lvl=?, Areas_idAreas=?
      WHERE idVacancies = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssiiiii', $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $idVacancies);

        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../edit_vac.php?idvac=$idVacancies");
            $_SESSION["vac"] = 2;
        } else {
            if (!empty($_POST["capacity"])) {
                $query2 = "DELETE FROM vacancies_has_capacities
                        WHERE vacancies_idVacancies = ?";
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }

                    mysqli_stmt_close($stmt);
                }
                $stmt = mysqli_stmt_init($link);
            }
            $query3 = "INSERT INTO vacancies_has_capacities (vacancies_idVacancies, capacities_idcapacities)
                  VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query3)) {
                mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);
                foreach ($_POST["capacity"] as $capacities_idcapacities) {
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_vac.php?idvac=$idVacancies");
                        $_SESSION["vac"] = 2;
                    }
                }
                mysqli_stmt_close($stmt);
            }
            mysqli_close($link);
            
            include "match_comp.php";
            
            header("Location: ../all_vacancies_comp.php");
            $_SESSION["vac"] = 3;
        }
    }
} else {
    header("Location: ../edit_vac.php?idvac=$idVacancies");
    $_SESSION["vac"] = 1;
}
