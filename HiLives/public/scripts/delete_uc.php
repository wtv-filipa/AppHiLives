<?php
session_start();
if (isset($_GET['apaga'])) {
    //echo "estou a apagar uma UC";
    $idUC = $_GET["apaga"];

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM done_cu WHERE idDone_CU = ?";

    //PRIMEIRA QUERY
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUC);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {
            //ERRO
            header("Location: ../links_made.php");
            $_SESSION["doneCU"] = 1;
            //echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            mysqli_stmt_close($stmt);
            // SUCCESS ACTION
            header("Location: ../links_made.php");
            $_SESSION["doneCU"] = 4;
        }
    } else {
        //ERRO
        header("Location: ../links_made.php");
        $_SESSION["doneCU"] = 1;
    }
    /* close connection */
    mysqli_close($link);
} else {
    //ERRO
    header("Location: ../links_made.php");
    $_SESSION["doneCU"] = 1;
}
