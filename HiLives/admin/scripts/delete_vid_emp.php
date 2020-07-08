<?php
session_start();
require_once "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_GET['apaga'])) {
    $idContent = $_GET["apaga"];

    $query = "UPDATE vacancies SET Content_idContent = Null WHERE Content_idContent = ?";
    $query2 = "DELETE FROM content WHERE idContent = ?";
    $query3 = "SELECT content_name FROM content WHERE idContent = ?";

    if (mysqli_stmt_prepare($stmt, $query3)) {

        mysqli_stmt_bind_param($stmt, 'i', $idContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $content_name);
        while (mysqli_stmt_fetch($stmt)) {
            $ficheiro = "../uploads/vid_vac/" . $content_name;
            if (!unlink($ficheiro)) {
                header("Location: ../contents_emp.php");
                $_SESSION["cont_emp"] = 2;
            } else {
                //PRIMEIRA QUERY
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../contents_emp.php");
                        $_SESSION["cont_emp"] = 2;
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../contents_emp.php");
                    $_SESSION["cont_emp"] = 2;
                }
                //SEGUNDA QUERY
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../contents_emp.php");
                        $_SESSION["cont_emp"] = 2;
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../contents_emp.php");
                    $_SESSION["cont_emp"] = 2;;
                }
                //SUCCESS
                header("Location: ../contents_emp.php");
                $_SESSION["cont_emp"] = 1;
            }
        }
    } else {
        header("Location: ../contents_emp.php");
        $_SESSION["cont_emp"] = 2;
    }
} else {
    header("Location: ../contents_emp.php");
    $_SESSION["cont_emp"] = 2;
}
