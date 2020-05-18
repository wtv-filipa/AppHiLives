<?php
// We need the function!
require_once("../connections/connection.php");
// Create a new DB connection
$link = new_db_connection();
/* create a prepared statement */
$stmt = mysqli_stmt_init($link);
//DIRETÓRIO PARA ONDE VAI O VÍDEO
$target_dir = "../../admin/uploads/xp/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$vidFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["but_upload"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "é um video";
        $uploadOk = 1;
    } else {
        //header("Location: ../criar_evento.php?msg=1");
        echo "não é img";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //header("Location: ../criar_evento.php?msg=2");
    echo "ficheiro já existe";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 70000000000) {
    //header("Location: ../criar_evento.php?msg=3");
    echo "ficheiro demasiado grande";
    $uploadOk = 0;
}
// Allow certain file formats
if ($vidFileType != "avi" && $vidFileType != "wmv" && $vidFileType != "mp4") {
    //header("Location: ../criar_evento.php?msg=4");
    echo "formato de ficheiro não permitido";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "erro de upload vir a 0";
    //header("Location: ../criar_evento.php?msg=0");
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        if (isset($_GET["vac"]) && isset($_POST["nomevaga"]) && isset($_POST["descricao"]) && isset($_POST["numvagas"]) && isset($_POST["requisitos"])) {

            //parte do video
            $ficheiro = $_FILES["fileToUpload"]["name"];
            $query = "INSERT INTO content (content_type, content_name)
            VALUES (?,?)";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'ss', $vidFileType, $ficheiro);

                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    //header("Location: ../criar_evento.php?msg=0");
                    echo "Error: " . mysqli_stmt_error($stmt);
                } else {
                    $last_id = mysqli_insert_id($link);
                    echo "ID: " . "$last_id";
                }

                $idUser = $_GET["vac"];

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "INSERT INTO vacancies (vacancie_name, description_vac, number_free_vanc, requirements, Region_idRegion, User_publicou, Content_idContent, Workday_idWorkday, Educ_lvl_idEduc_lvl, Areas_idAreas) VALUES (?,?,?,?,?,?,?,?,?,?)";
            
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ssssiiiiii', $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $idUser, $last_id, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas);
            
            
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

            }
        } else {
            echo "nao passa no if";
        }
    } else {
        //header("Location: ../criar_evento.php?msg=0");
    }
}
