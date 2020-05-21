<?php

if (isset($_POST["email"]) && isset($_POST["password"])) {

    require_once("../connections/connection.php");

    $link = new_db_connection();
    $link2 = new_db_connection();

    $stmt = mysqli_stmt_init($link);
    $stmt2 = mysqli_stmt_init($link2);
    $query = "SELECT idUser, email_user, password, User_type_idUser_type, active, type_user
                FROM users 
                INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
                WHERE email_user LIKE ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email_user);
        $email_user = $_POST['email'];
        $password = $_POST['password'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $email_user, $passwordx, $User_type, $active, $type_user);

        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $passwordx)) {
                if ($active == 1) {
                    session_start();
                    $_SESSION["email"] = $email_user;
                    $_SESSION["type"] = $User_type;
                    $_SESSION["idUser"] = $idUser;
                    $link3 = new_db_connection();

                    /***********************************************/
                    //Aqui era onde tínhamos o script do match
                    // feedback de sucesso
                    include "match_uni_login.php";
                    echo "$type_user";
                    if($type_user == "Jovem") {
                        header("Location: ../home_people.php");
                    } else if ($type_user == "Empresa") {
                        header("Location: ../home_companies.php");
                    } else if ($type_user == "Universidade") {
                        header("Location: ../home_uni.php");
                    }
                    echo "LOGIN DEU";
                } else {
                    // header("Location: ../login.php?msg=1");
                    echo "não deu o login";
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