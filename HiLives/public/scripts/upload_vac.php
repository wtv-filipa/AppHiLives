<?php
session_start();
// We need the function!
require_once("../connections/connection.php");
// Create a new DB connection
$link = new_db_connection();
$idUser = $_GET["vac"];

if ($_FILES['fileToUpload']['size'] != 0) {
    echo "quero carregar a vaga COM vídeo";
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);
    //DIRETÓRIO PARA ONDE VAI O VÍDEO
    $target_dir = "../../admin/uploads/vid_vac/";
    $target_file = $target_dir . $idUser .  "_" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $vidFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["but_upload"])) {
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            //ERRO- não é video
            header("Location: ../upload_vac.php");
            $_SESSION["vac"] = 3;
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //ERRO
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 4;
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 70000000000) {
        //ERRO
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 5;
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($vidFileType != "avi" && $vidFileType != "wmv" && $vidFileType != "mp4") {
        //ERRO
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 6;
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //ERRO
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 2;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

            if (!empty($_GET["vac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"])) {

                //parte do video
                $ficheiro = $idUser .  "_" . $_FILES["fileToUpload"]["name"];
                $query = "INSERT INTO content (content_type, content_name, users_idUser)
             VALUES (?,?,?)";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'ssi', $vidFileType, $ficheiro, $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../upload_vac.php");
                        $_SESSION["vac"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        $last_id = mysqli_insert_id($link);
                        //echo "ID: " . "$last_id";
                    }
                    $link1 = new_db_connection();
                    $stmt1 = mysqli_stmt_init($link1);
                    $query = "INSERT INTO vacancies (vacancie_name, description_vac, number_free_vanc, requirements, Region_idRegion, User_publicou, Content_idContent, Workday_idWorkday, Educ_lvl_idEduc_lvl, Areas_idAreas) VALUES (?,?,?,?,?,?,?,?,?,?)";

                    if (mysqli_stmt_prepare($stmt1, $query)) {
                        mysqli_stmt_bind_param($stmt1, 'ssssiiiiii', $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $idUser, $last_id, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas);

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
                        if (mysqli_stmt_execute($stmt1)) {
                            $idVacancies = mysqli_insert_id($link1);
                            /* echo "num vaga: $idVacancies";
                            // SUCCESS ACTION
                            echo "ESTÁ NA BD <br>";
 */
                            //INSERIR CAPACIDADE
                            if (isset($_POST["capacity"])) {

                                $link = new_db_connection();
                                $stmt = mysqli_stmt_init($link);
                                $query2 = "INSERT INTO vacancies_has_capacities (vacancies_idVacancies, capacities_idcapacities)
                               VALUES (?, ?)";
                                //parte do insert
                                if (mysqli_stmt_prepare($stmt, $query2)) {

                                    mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);

                                    // PARA TODAS AS CAPACIDADES ESCOLHIDAS
                                    foreach ($_POST["capacity"] as $capacities_idcapacities) {
                                        //echo "id da capacidade: $capacities_idcapacities<br>";
                                        /* execute the prepared statement */
                                        if (!mysqli_stmt_execute($stmt)) {
                                            //ERRO
                                            header("Location: ../upload_vac.php");
                                            $_SESSION["vac"] = 2;
                                            //echo "Error: " . mysqli_stmt_error($stmt);
                                        }
                                    }
                                    /* close statement */
                                    mysqli_stmt_close($stmt);
                                }
                                //fim da cena do insert
                            } else {
                                //ERRO
                                header("Location: ../upload_vac.php");
                                $_SESSION["vac"] = 1;
                            }
                            //match
                            include "match_comp.php";
                            //SUCESSO
                            header("Location: ../all_vacancies_comp.php");
                            $_SESSION["vac"] = 1;
                        } else {
                            //ERRO
                            header("Location: ../upload_vac.php");
                            $_SESSION["vac"] = 2;
                            //echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    }
                }
                /* close connection */
                mysqli_stmt_close($stmt);
                mysqli_close($link);
            } else {
                //ERRO
                header("Location: ../upload_vac.php");
                $_SESSION["vac"] = 2;
            }
        } else {
            //ERRO
            header("Location: ../upload_vac.php");
            $_SESSION["vac"] = 2;
        }
    }
} else {
    echo "quero carregar a vaga SEM vídeo";
    if (!empty($_GET["vac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"])) {

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
                $idVacancies = mysqli_insert_id($link);
                /*  echo "num vaga: $idVacancies";
                // SUCCESS ACTION
                echo "ESTÁ NA BD <br>"; */

                //INSERIR CAPACIDADE
                if (isset($_POST["capacity"])) {

                    $query2 = "INSERT INTO vacancies_has_capacities (vacancies_idVacancies, capacities_idcapacities)
                              VALUES (?, ?)";
                    //parte do insert
                    if (mysqli_stmt_prepare($stmt, $query2)) {

                        mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);

                        // PARA TODAS AS CAPACIDADES ESCOLHIDAS
                        foreach ($_POST["capacity"] as $capacities_idcapacities) {
                            //echo "id da capacidade: $capacities_idcapacities<br>";
                            /* execute the prepared statement */
                            if (!mysqli_stmt_execute($stmt)) {
                                //ERRO
                                header("Location: ../upload_vac.php");
                                $_SESSION["vac"] = 2;
                                //echo "Error: " . mysqli_stmt_error($stmt);
                            }
                        }
                        /* close statement */
                        mysqli_stmt_close($stmt);
                    }
                    //fim da cena do insert
                } else {
                    //ERRO
                    header("Location: ../upload_vac.php");
                    $_SESSION["vac"] = 2;
                }
                //match
                include "match_comp.php";
                //SUCESSO
                header("Location: ../all_vacancies_comp.php");
                $_SESSION["vac"] = 1;
            } else {
                //ERRO
                header("Location: ../upload_vac.php");
                $_SESSION["vac"] = 2;

                //echo "Error execute vaga: " . mysqli_stmt_error($stmt);
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else {
        //ERRO
        header("Location: ../upload_vac.php");
        $_SESSION["vac"] = 1;
    }
}
