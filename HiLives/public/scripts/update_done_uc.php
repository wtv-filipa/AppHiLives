<?php
session_start();
$idDone_CU = $_GET["uc"];
if (!empty($_POST["nomeuc"]) && !empty($_POST["uniuc"]) && !empty($_POST["data"]) && isset($_GET["uc"])) {
  
    $idDone_CU = $_GET["uc"];
    $nomeuc = $_POST["nomeuc"];
    $uniuc = $_POST["uniuc"];
    $data = $_POST["data"];

    require_once("../connections/connection.php");
  
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE done_cu
      SET Cu_name = ?, University_name = ?, date_CU = ?
      WHERE idDone_CU = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssi', $nomeuc, $uniuc, $data, $idDone_CU);
        if (!mysqli_stmt_execute($stmt)) {           
            header("Location: ../edit_done_uc.php?uc=$idDone_CU");
            $_SESSION["doneCU"] = 1;
        } else {
            header("Location: ../links_made.php");
            $_SESSION["doneCU"] = 3;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../edit_done_uc.php?uc=$idDone_CU");
        $_SESSION["doneCU"] = 1;
    }
    mysqli_close($link);
} else {
    header("Location: ../edit_done_uc.php?uc=$idDone_CU");
    $_SESSION["doneCU"] = 2;
}
