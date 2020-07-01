<?php
session_start();
require_once "../connections/connection.php";

if (isset($_SESSION["idUser"]) && !empty($_POST["nomeuc"]) && !empty($_POST["uniuc"]) && !empty($_POST["data"])) {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO done_cu (User_idUser, Cu_name, University_name, date_cu) VALUES (?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'isss', $User_idUser, $Cu_name, $University_name, $date_cu);
        $User_idUser = $_SESSION['idUser'];
        $Cu_name = $_POST['nomeuc'];
        $University_name = $_POST['uniuc'];
        $date_cu = $_POST['data'];

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            // SUCCESS ACTION
            header("Location: ../links_made.php");
            $_SESSION["doneCU"] = 2;
        } else {
            //ERRO
            ///isto é do isset
            header("Location: ../done_uc.php");
            $_SESSION["doneCU"] = 1;
        }
    } else {
        //ERRO
        header("Location: ../done_uc.php");
        $_SESSION["doneCU"] = 1;
    }
} else {
    //ERRO
    header("Location: ../done_uc.php");
    $_SESSION["doneCU"] = 2;
}
