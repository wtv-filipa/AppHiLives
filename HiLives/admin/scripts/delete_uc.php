<?php
session_start();
if (isset($_GET['apaga'])) {
    echo "estou a apagar uma UC";
    $idUC = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM done_cu WHERE idDone_CU = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUC);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../UC_jovem.php");
            $_SESSION["uc"] = 2;
        } else {
            header("Location: ../UC_jovem.php");
            $_SESSION["uc"] = 1;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../UC_jovem.php");
        $_SESSION["uc"] = 2;
    }
} else {
    header("Location: ../UC_jovem.php");
    $_SESSION["uc"] = 2;
}
