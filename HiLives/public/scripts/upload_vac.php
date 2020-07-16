<?php
session_start();

require_once("../connections/connection.php");
$link = new_db_connection();
$idUser = $_GET["vac"];

if ($_FILES['fileToUpload']['size'] != 0) {
    $stmt = mysqli_stmt_init($link);

    $target_dir = "../../admin/uploads/vid_vac/";
    $target_file = $target_dir . $idUser .  "_" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $vidFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["but_upload"])) {
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            header("Location: ../upload_vac.php");
            $_SESSION["vac"] = 3;
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 4;
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 70000000000) {
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 5;
        $uploadOk = 0;
    }
 
    if ($vidFileType != "avi" && $vidFileType != "wmv" && $vidFileType != "mp4") {
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 6;
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 2;
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            if (!empty($_GET["vac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"])) {

                $ficheiro = $idUser .  "_" . $_FILES["fileToUpload"]["name"];
                $query = "INSERT INTO content (content_type, content_name, users_idUser)
             VALUES (?,?,?)";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ssi', $vidFileType, $ficheiro, $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../upload_vac.php");
                        $_SESSION["vac"] = 2;
                    } else {
                        $last_id = mysqli_insert_id($link);
                    }
                    $link1 = new_db_connection();
                    $stmt1 = mysqli_stmt_init($link1);
                    $query = "INSERT INTO vacancies (vacancie_name, description_vac, number_free_vanc, requirements, Region_idRegion, User_publicou, Content_idContent, Workday_idWorkday, Educ_lvl_idEduc_lvl, Areas_idAreas) VALUES (?,?,?,?,?,?,?,?,?,?)";

                    if (mysqli_stmt_prepare($stmt1, $query)) {
                        mysqli_stmt_bind_param($stmt1, 'ssssiiiiii', $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $idUser, $last_id, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas);

                        $vacancie_name = $_POST["nomevaga"];
                        $description_vac = $_POST["descricao"];
                        $number_free_vanc = $_POST["numvagas"];
                        $requirements = $_POST["requisitos"];
                        $Region_idRegion = $_POST["regiao"];
                        $Workday_idWorkday = $_POST["jornada"];
                        $Educ_lvl_idEduc_lvl = $_POST["educ"];
                        $Areas_idAreas = $_POST["area"];

                        if (mysqli_stmt_execute($stmt1)) {
                            $idVacancies = mysqli_insert_id($link1);
                            if (isset($_POST["capacity"])) {

                                $link = new_db_connection();
                                $stmt = mysqli_stmt_init($link);
                                $query2 = "INSERT INTO vacancies_has_capacities (vacancies_idVacancies, capacities_idcapacities)
                               VALUES (?, ?)";
                                if (mysqli_stmt_prepare($stmt, $query2)) {
                                    mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);

                                    foreach ($_POST["capacity"] as $capacities_idcapacities) {
                                        if (!mysqli_stmt_execute($stmt)) {
                                            header("Location: ../upload_vac.php");
                                            $_SESSION["vac"] = 2;
                                        }
                                    }
                                    mysqli_stmt_close($stmt);
                                }
                            } else {
                                header("Location: ../upload_vac.php");
                                $_SESSION["vac"] = 1;
                            }
                            include "match_comp.php";
                          
                            header("Location: ../all_vacancies_comp.php");
                            $_SESSION["vac"] = 1;
                        } else {
                            header("Location: ../upload_vac.php");
                            $_SESSION["vac"] = 2;
                        }
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
            } else {
                header("Location: ../upload_vac.php");
                $_SESSION["vac"] = 2;
            }
        } else {
            header("Location: ../upload_vac.php");
            $_SESSION["vac"] = 2;
        }
    }
} else {
    if (!empty($_GET["vac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"])) {
        $idUser = $_GET["vac"];
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "INSERT INTO vacancies (vacancie_name, description_vac, number_free_vanc, requirements, Region_idRegion, User_publicou, Workday_idWorkday, Educ_lvl_idEduc_lvl, Areas_idAreas) VALUES (?,?,?,?,?,?,?,?,?)";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssiiiii', $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $idUser, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas);

            $vacancie_name = $_POST["nomevaga"];
            $description_vac = $_POST["descricao"];
            $number_free_vanc = $_POST["numvagas"];
            $requirements = $_POST["requisitos"];
            $Region_idRegion = $_POST["regiao"];
            $Workday_idWorkday = $_POST["jornada"];
            $Educ_lvl_idEduc_lvl = $_POST["educ"];
            $Areas_idAreas = $_POST["area"];

            if (mysqli_stmt_execute($stmt)) {
                $idVacancies = mysqli_insert_id($link);
                if (isset($_POST["capacity"])) {

                    $query2 = "INSERT INTO vacancies_has_capacities (vacancies_idVacancies, capacities_idcapacities)
                              VALUES (?, ?)";
                    
                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);
                        foreach ($_POST["capacity"] as $capacities_idcapacities) {
                            if (!mysqli_stmt_execute($stmt)) {
                                header("Location: ../upload_vac.php");
                                $_SESSION["vac"] = 2;
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    header("Location: ../upload_vac.php");
                    $_SESSION["vac"] = 2;
                }
               
                include "match_comp.php";
              
                header("Location: ../all_vacancies_comp.php");
                $_SESSION["vac"] = 1;
            } else {
                header("Location: ../upload_vac.php");
                $_SESSION["vac"] = 2;
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else {
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 1;
    }
}
