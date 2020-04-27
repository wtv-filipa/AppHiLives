<?php

if (isset($_POST["email"]) && isset($_POST["password"])){

    require_once("../connections/connection.php");

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);
    $query = "SELECT idUser, email_user, password, User_type_idUser_type, active FROM users WHERE email_user LIKE ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email_user);
        $email_user = $_POST['email'];
        $password = $_POST['password'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $email_user, $passwordx, $User_type, $active);

        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $passwordx)) {
                if ($active == 1){
                    session_start();
                    $_SESSION["email"] = $email_user;
                    $_SESSION["type"] = $User_type;
                    $_SESSION["idUser"] = $idUser;
                    $link3 = new_db_connection();

                    /***********************************************/
                    // feedback de sucesso
                    header("Location: ../homepage_userDID.php");
                    //echo "LOGIN DEU YESSSSSSSSSSSSS";
                } else {
                   // header("Location: ../login.php?msg=1");
                    echo"não deu o login";
                }
            } else {
                // feedback de erro geral devido à password estar errada
                echo "pass errada";
                //header("Location: ../login.php?msg=0");
            }
        } else {
            // feedback de erro feral devido ao username estar errado
            echo "nickname errado";
            //header("Location: ../login.php?msg=0");
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }

}

?>