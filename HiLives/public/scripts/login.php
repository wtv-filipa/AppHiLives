<?php

if (isset($_POST["email"]) && isset($_POST["password"])) {

    require_once("../connections/connection.php");

    $link = new_db_connection();
    $link2 = new_db_connection();

    $stmt = mysqli_stmt_init($link);
    $stmt2 = mysqli_stmt_init($link2);
    $query = "SELECT idUser, email_user, password, User_type_idUser_type, active FROM users WHERE email_user LIKE ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email_user);
        $email_user = $_POST['email'];
        $password = $_POST['password'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $email_user, $passwordx, $User_type, $active);

        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $passwordx)) {
                if ($active == 1) {
                    session_start();
                    $_SESSION["email"] = $email_user;
                    $_SESSION["type"] = $User_type;
                    $_SESSION["idUser"] = $idUser;
                    $link3 = new_db_connection();

                    /***********************************************/
                    //MATCH
                    $query1 = "SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area FROM user_has_areas INNER JOIN users ON user_has_areas.User_idUser = users.idUser INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas WHERE User_type_idUser_type LIKE 13 OR User_idUser= ?";
                    $query2 = "INSERT INTO young_university (User_young, User_university, Area) VALUES (?, ?, ?)";

                    if (mysqli_stmt_prepare($stmt, $query1)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $User_idUser, $Areas_idAreas, $User_type_idUser_type, $name_interested_area);
                        $array_jovem = array();
                        while (mysqli_stmt_fetch($stmt)) {
                            /*Array que guarda todas as areas dos jovens e uni*/
                            array_push($array_jovem, $Areas_idAreas);
                            //var_dump($array_jovem);
                            echo "<br>";


                            /*Deteta areas iguais aka match!*/
                            $respostas_iguais = array_count_values($array_jovem);

                            var_dump($respostas_iguais);
                            foreach ($respostas_iguais as $value) {
                                    if ($value > 1) {
                                        if (mysqli_stmt_prepare($stmt, $query2)) {
//                                        echo "OLÁ PASSOU AQUI<br>";
                                            if ($User_idUser != $idUser) {
                                                //echo $User_idUs
                                                mysqli_stmt_bind_param($stmt, 'iis', $idUser, $User_idUser, $name_interested_area);
                                            }
                                            echo "<br>FEZ A PUTA DO MATCH<br>";
                                            if (!mysqli_stmt_execute($stmt)) {
                                                echo "Error: " . mysqli_stmt_error($stmt);
                                            }
                                            /* close statement */
                                            mysqli_stmt_close($stmt);
                                        }
                                    } else{
                                        echo "não estamos a inserir :( <br>";
                                    }


                                echo "Value: $value<br>";
                            }
                        }
                    }
                    /***********************************************/
                    // feedback de sucesso
                    // header("Location: ../home_people.php");
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