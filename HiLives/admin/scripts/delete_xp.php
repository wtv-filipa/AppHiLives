<?php
session_start();
if (isset($_GET['apaga'])) {
    echo "estou a apagar uma experiência";
    $idContent = $_GET["apaga"];
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
            $ficheiro = "../uploads/xp/" . $content_name;
            if (!unlink($ficheiro)) {
                header("Location: ../contents_jovem.php");
                $_SESSION["xp"] = 2;
            } else {
                //PRIMEIRA QUERY
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../contents_jovem.php");
                        $_SESSION["xp"] = 2;
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../contents_jovem.php");
                    $_SESSION["xp"] = 2;
                }
                //SEGUNDA QUERY
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../contents_jovem.php");
                        $_SESSION["xp"] = 2;
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../contents_jovem.php");
                    $_SESSION["xp"] = 2;
                }
                //SUCESSO
                header("Location: ../contents_jovem.php");
                $_SESSION["xp"] = 1;
            }
        }
    }
} else {
    header("Location: ../contents_jovem.php");
    $_SESSION["xp"] = 2;
}
