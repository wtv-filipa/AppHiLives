<?php
session_start();
require_once "../connections/connection.php";

if (isset($_SESSION["idUser"]) && isset($_POST["nomeuc"]) && isset($_POST["uniuc"]) && isset($_POST["data"])) {

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
            echo "INSERIUUU";
            header("Location: ../profile.php?user=$User_idUser");
        }
        else {
            ///isto é do isset

            echo "ERRO de não temos nada inserido";
            // header("Location: ../register.php?msg=2");
        }

    }

}

