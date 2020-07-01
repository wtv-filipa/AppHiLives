<?php
session_start();
// We need the function!
require_once("../connections/connection.php");
// Create a new DB connection
$link = new_db_connection();
/* create a prepared statement */
$stmt = mysqli_stmt_init($link);
//ID DO USER DA SESSÂO
$id_navegar = $_SESSION["idUser"];

if (isset($_GET["xp"]) && !empty($_POST["nomeVideo"]) && $_FILES["fileToUpload"]['size'] != 0) {
    //ID DO USER A FAZER UPLOAD
    $idUser = $_GET["xp"];
    //DIRETÓRIO PARA ONDE VAI O VÍDEO
    $target_dir = "../../admin/uploads/xp/";
    $target_file = $target_dir . $idUser .  "_" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $vidFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["but_upload"])) {
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            //echo "é um video";
            $uploadOk = 1;
        } else {
            //ERRO: NAO É UM VIDEO
            header("Location: ../upload_xp.php");
            $_SESSION["xp_jovem"] = 1;
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //ERRO: VÍDEO JÁ EXISTE
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 2;
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 70000000000) {
        //ERRO: FICHEIRO GRANDE DEMAIS
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 4;
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($vidFileType != "avi" && $vidFileType != "wmv" && $vidFileType != "mp4") {
        //ERRO: FORMATO NÃO SOPURTADO
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 5;
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //ERRO
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 6;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            //parte do video
            $ficheiro =  $idUser .  "_" . $_FILES["fileToUpload"]["name"];
            $query = "INSERT INTO content (content_type, content_name, users_idUser)
            VALUES (?,?,?)";
            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'ssi', $vidFileType, $ficheiro, $idUser);

                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    //ERRO
                    header("Location: ../upload_xp.php");
                    $_SESSION["xp_jovem"] = 6;
                    //echo "Error: " . mysqli_stmt_error($stmt);
                } else {
                    $last_id = mysqli_insert_id($link);
                }

                //parte da bd da tabela de experiências

                $query2 = "INSERT INTO experiences (title_exp, description, User_idUser, Content_idContent) VALUES (?,?,?,?)";

                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'ssii', $title_exp, $description, $User_idUser, $last_id);

                    $title_exp = $_POST['nomeVideo'];
                    $description = $_POST['descricao'];
                    $User_idUser = $idUser;

                    // Devemos validar também o resultado do execute!
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                        // Acção de sucesso
                        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                        $_SESSION["xp_jovem"] = 1;
                    } else {
                        //ERRO
                        header("Location: ../upload_xp.php");
                        $_SESSION["xp_jovem"] = 7;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }
                } else {
                    //ERRO
                    header("Location: ../upload_xp.php");
                    $_SESSION["xp_jovem"] = 7;
                    mysqli_close($link);
                }
            } else {
                //ERRO
                header("Location: ../upload_xp.php");
                $_SESSION["xp_jovem"] = 7;
            }
        } else {
            //ERRO
            header("Location: ../upload_xp.php");
            $_SESSION["xp_jovem"] = 7;
        }
    }
} else {
    //ERRO
    header("Location: ../upload_xp.php");
    $_SESSION["xp_jovem"] = 3;
}
