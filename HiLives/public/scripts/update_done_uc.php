<?php
session_start();
$idDone_CU = $_GET["uc"];
if (!empty($_POST["nomeuc"]) && !empty($_POST["uniuc"]) && !empty($_POST["data"]) && isset($_GET["uc"])) {
    //echo "estou a editar";
    $idDone_CU = $_GET["uc"];
    $nomeuc = $_POST["nomeuc"];
    $uniuc = $_POST["uniuc"];
    $data = $_POST["data"];

    echo $idDone_CU;
    echo $nomeuc;
    echo  $uniuc;
    echo $data;

    // We need the function!
    require_once("../connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE done_cu
      SET Cu_name = ?, University_name = ?, date_CU = ?
      WHERE idDone_CU = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssi', $nomeuc, $uniuc, $data, $idDone_CU);

        if (!mysqli_stmt_execute($stmt)) {
            //echo "Error: " . mysqli_stmt_error($stmt);
            //ERRO
            header("Location: ../edit_done_uc.php?uc=$idDone_CU");
            $_SESSION["doneCU"] = 1;
        } else {
            // SUCCESS ACTION
            header("Location: ../links_made.php");
            $_SESSION["doneCU"] = 3;
            mysqli_stmt_close($stmt);
        }
    } else {
        //ERRO
        header("Location: ../edit_done_uc.php?uc=$idDone_CU");
        $_SESSION["doneCU"] = 1;
    }
    mysqli_close($link);
} else {
    //ERRO
    header("Location: ../edit_done_uc.php?uc=$idDone_CU");
    $_SESSION["doneCU"] = 2;
}
