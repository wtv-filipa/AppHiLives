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

        if (isset($_GET["xp"]) && isset($_POST["nomeVideo"])) {
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

                //parte da bd da tabela de experiências
                $idUser = $_GET["xp"];

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
                        // header("Location: ../eventos.php?msg=0");
                        echo $idUser;
                        echo "DEU";
                    } else {
                        // Acção de erro
                        // header("Location: ../criar_evento.php?msg=0");
                        echo "Error: " . mysqli_stmt_error($stmt);
                        echo " não DEU";
                    }
                } else {
                    // Acção de erro
                    echo "não deu 2";
                    //header("Location: ../criar_evento.php?msg=0");
                    mysqli_close($link);
                }
            } else {
                echo "faltam campos de preenchimento obrigatório";
            }
        }
    } else {
        //header("Location: ../criar_evento.php?msg=0");
    }
}
