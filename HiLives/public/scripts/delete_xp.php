<?php
session_start();
$id_navegar = $_SESSION["idUser"];
if (isset($_GET['apaga']) && isset($_GET['user'])) {
    //echo "estou a apagar uma experiência";
    $idContent = $_GET["apaga"];
    $idUser =  $_GET["user"];

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM experiences WHERE Content_idContent = ?";
    $query2 = "DELETE FROM content WHERE idContent = ?";
    $query3 = "SELECT content_name FROM content WHERE idContent = ?";

    if (mysqli_stmt_prepare($stmt, $query3)) {

        mysqli_stmt_bind_param($stmt, 'i', $idContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $content_name);
        while (mysqli_stmt_fetch($stmt)) {
            $ficheiro = "../../admin/uploads/xp/" . $content_name;
            echo $ficheiro;
            if (!unlink($ficheiro)) {
                //ERRO
                header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                $_SESSION["xp_jovem"] = 4;
                //echo "erro a apagar o ficheiro da pasta";
            } else {
                //echo "sucesso a apagar o ficheiro da pasta";
                //PRIMEIRA QUERY
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idContent);

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                        $_SESSION["xp_jovem"] = 4;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    //ERRO
                    header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                    $_SESSION["xp_jovem"] = 4;
                }
                //SEGUNDA QUERY
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idContent);

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                        $_SESSION["xp_jovem"] = 4;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    //ERRO
                    header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                    $_SESSION["xp_jovem"] = 4;
                }
                //ERRO
                header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                $_SESSION["xp_jovem"] = 3;
            }
        }
    } else {
        //ERRO
        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
        $_SESSION["xp_jovem"] = 4;
    }
} else {
    //ERRO
    header("Location: ../profile.php?user=$id_navegar#xp_jovem");
    $_SESSION["xp_jovem"] = 4;
}
