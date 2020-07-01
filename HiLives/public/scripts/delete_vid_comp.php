<?php
session_start();
$id_navegar = $_SESSION["idUser"];
if (isset($_GET['apaga'])) {

    echo "estou a apagar um vídeo de uma empresa";
    $idUser = $_SESSION["idUser"];
    $idContent = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE vacancies SET Content_idContent = Null WHERE Content_idContent = ?";
    $query2 = "DELETE FROM content WHERE idContent = ?";
    $query3 = "SELECT content_name FROM content WHERE idContent = ?";

    if (mysqli_stmt_prepare($stmt, $query3)) {

        mysqli_stmt_bind_param($stmt, 'i', $idContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $content_name);
        while (mysqli_stmt_fetch($stmt)) {
            $ficheiro = "../../admin/uploads/vid_vac/" . $content_name;
            echo $ficheiro;
            if (!unlink($ficheiro)) {
                //ERRO
                header("Location: ../profile.php?user=$id_navegar#xp_vac");
                $_SESSION["xp_vac"] = 2;
            } else {
                //echo "sucesso a apagar o ficheiro da pasta";
                //PRIMEIRA QUERY
                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idContent);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../profile.php?user=$id_navegar#xp_vac");
                        $_SESSION["xp_vac"] = 2;
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                } else {
                    //ERRO
                    header("Location: ../profile.php?user=$id_navegar#xp_vac");
                    $_SESSION["xp_vac"] = 2;
                }
                //SEGUNDA QUERY
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idContent);

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../profile.php?user=$id_navegar#xp_vac");
                        $_SESSION["xp_vac"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    //ERRO
                    header("Location: ../profile.php?user=$id_navegar#xp_vac");
                    $_SESSION["xp_vac"] = 2;
                }
                //ERRO
                header("Location: ../profile.php?user=$id_navegar#xp_vac");
                $_SESSION["xp_vac"] = 1;
            }
        }
    } else {
        //ERRO
        header("Location: ../profile.php?user=$id_navegar#xp_vac");
        $_SESSION["xp_vac"] = 2;
    }
} else {
    //ERRO
    header("Location: ../profile.php?user=$id_navegar#xp_vac");
    $_SESSION["xp_vac"] = 2;
}
