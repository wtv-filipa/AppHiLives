<?php

if (!empty($_POST["email"]) && !empty($_POST["password"])) {

    require_once("../connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    
    $link2 = new_db_connection();
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

                    if ($type_user == "Jovem") {
                        include "match_uni_login.php";
                        header("Location: ../home_people.php");
                    } else if ($type_user == "Empresa") {
                        $query2 = "SELECT idVacancies FROM vacancies WHERE User_publicou = ?";
                        if (mysqli_stmt_prepare($stmt2, $query2)) {
                            mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $idVacancies);
                            while (mysqli_stmt_fetch($stmt2)) {
                                include "match_comp.php";
                                header("Location: ../home_companies.php");
                            }
                            mysqli_stmt_close($stmt2);
                            mysqli_close($link2);
                        }
                        header("Location: ../home_companies.php");
                        
                    } else if ($type_user == "Universidade") {
                        include "match_young_login.php";
                        header("Location: ../home_uni.php");
                    } else if ($type_user == "Admin") {
                        header("Location: ../../admin/index.php");
                    }

                } else {
                    session_start();
                   
                    header("Location: ../login.php");
                    $_SESSION["login"] = 1;
                }
            } else {
                session_start();
                
                header("Location: ../login.php");
                $_SESSION["login"] = 3;
            }
        } else {
            session_start();
            
            header("Location: ../login.php");
            $_SESSION["login"] = 3;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else{
        session_start();
        
        header("Location: ../login.php");
        $_SESSION["login"] = 1;
    }
} else {
    session_start();
    
    header("Location: ../login.php");
    $_SESSION["login"] = 2;
}
