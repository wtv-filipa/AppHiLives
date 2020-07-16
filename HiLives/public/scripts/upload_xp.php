<?php
session_start();

require_once("../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$id_navegar = $_SESSION["idUser"];

if (isset($_GET["xp"]) && !empty($_POST["nomeVideo"]) && $_FILES["fileToUpload"]['size'] != 0) {
    $idUser = $_GET["xp"];
    $target_dir = "../../admin/uploads/xp/";
    $target_file = $target_dir . $idUser .  "_" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $vidFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["but_upload"])) {
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            header("Location: ../upload_xp.php");
            $_SESSION["xp_jovem"] = 1;
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 2;
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 70000000000) {
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 4;
        $uploadOk = 0;
    }
  
    if ($vidFileType != "avi" && $vidFileType != "wmv" && $vidFileType != "mp4") {  
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 5;
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header("Location: ../upload_xp.php");
        $_SESSION["xp_jovem"] = 6;
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $ficheiro =  $idUser .  "_" . $_FILES["fileToUpload"]["name"];
            $query = "INSERT INTO content (content_type, content_name, users_idUser)
            VALUES (?,?,?)";
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'ssi', $vidFileType, $ficheiro, $idUser);
                if (!mysqli_stmt_execute($stmt)) {
                    header("Location: ../upload_xp.php");
                    $_SESSION["xp_jovem"] = 6;
                } else {
                    $last_id = mysqli_insert_id($link);
                }

                $query2 = "INSERT INTO experiences (title_exp, description, User_idUser, Content_idContent) VALUES (?,?,?,?)";

                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'ssii', $title_exp, $description, $User_idUser, $last_id);
                    $title_exp = $_POST['nomeVideo'];
                    $description = $_POST['descricao'];
                    $User_idUser = $idUser;

                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                        $_SESSION["xp_jovem"] = 1;
                    } else {
                        header("Location: ../upload_xp.php");
                        $_SESSION["xp_jovem"] = 7;
                    }
                } else {
                    header("Location: ../upload_xp.php");
                    $_SESSION["xp_jovem"] = 7;
                    mysqli_close($link);
                }
            } else {
                header("Location: ../upload_xp.php");
                $_SESSION["xp_jovem"] = 7;
            }
        } else {
            header("Location: ../upload_xp.php");
            $_SESSION["xp_jovem"] = 7;
        }
    }
} else {
    header("Location: ../upload_xp.php");
    $_SESSION["xp_jovem"] = 3;
}
