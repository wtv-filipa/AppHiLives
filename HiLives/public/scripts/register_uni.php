<?php
require_once "../connections/connection.php";


if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["data_fund"]) && isset($_POST["phone"]) && isset($_POST["site"]) && isset($_POST["desc"]) && isset($_POST["hist"]) && isset($_POST["password"])) {

    $type = 13;

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, password, website_ue, facebook_ue, instagram_ue, description_ue, history_ue, User_type_idUser_type) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssi', $name_uni, $email, $contact_user, $birth_date, $password_hash, $website_ue, $facebook_ue, $instagram_ue, $description_ue, $history_ue, $User_type_idUser_type);

        $name_uni = $_POST['nome'];
        $email = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_fund'];
        $website_ue = $_POST["site"];
        $facebook_ue = $_POST["face"];
        $instagram_ue = $_POST["insta"];
        $description_ue = $_POST["desc"];
        $history_ue = $_POST["hist"];
        $User_type_idUser_type = $type;
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            //echo "ESTÁ NA BD <br>";

            //INSERIR REGIAO
            if (isset($_POST["regiao"])) {

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query1 = "SELECT MAX(idUser) FROM users";

                $idRegion = $_POST["regiao"];
                if (mysqli_stmt_prepare($stmt, $query1)) {
                    /* execute the prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $idUser);

                        /* fetch values */
                        while (mysqli_stmt_fetch($stmt)) {
//                            echo "id do user: $idUser <br>";
                            $query2 = "INSERT INTO user_has_region (User_idUser, Region_idRegion) VALUES (?, ?)";
                            //parte do insert
                            if (mysqli_stmt_prepare($stmt, $query2)) {
//                                echo "id do user: $idUser <br>";

                                mysqli_stmt_bind_param($stmt, 'ii',$idUser, $idRegion);
//                                echo"id da região: $idRegion<br>";

                                if (!mysqli_stmt_execute($stmt)) {
                                    echo "Error: " . mysqli_stmt_error($stmt);
                                }
                                /* close statement */
                                mysqli_stmt_close($stmt);
                            }
                            //fim da cena do insert
                        }
                    }
                }
            } else {
                ///isto é do isset
                echo "ERRO de não temos nada inserido";
                // header("Location: ../register.php?msg=2");
            }
            //FIM DO INSERT REGIAO

            //INSERIR AREA
            if (isset($_POST["area"])) {

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query1 = "SELECT MAX(idUser) FROM users";

                if (mysqli_stmt_prepare($stmt, $query1)) {
                    /* execute the prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $idUser);

                        /* fetch values */
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "id do user: $idUser <br>";
                            $query2 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas) VALUES (?, ?)";
                            //parte do insert
                            if (mysqli_stmt_prepare($stmt, $query2)) {
//                                echo "id do user: $idUser <br>";

                                mysqli_stmt_bind_param($stmt, 'ii',$idUser, $idAreas);
//                                echo"id das áreas: $idAreas<br>";
                                // PARA TODAS AS ÁREAS QUE FORAM ESCOLHIDAS
                                foreach ($_POST["area"] as $idAreas) {
                                    echo"id das áreas: $idAreas<br>";
                                    /* execute the prepared statement */
                                    if (!mysqli_stmt_execute($stmt)) {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                }
                                /* close statement */
                                mysqli_stmt_close($stmt);
                            }
                            //fim da cena do insert
                        }
                    }
                }
            } else {
                ///isto é do isset
                echo "ERRO de não temos nada inserido";
                // header("Location: ../register.php?msg=2");
            }
            //FIM INSERT ÁREA


            header("Location: ../login.php");
        } else {
            // ERROR ACTION
            echo "Error: " . mysqli_stmt_error($stmt);
            echo "NAO DEU POR ERRO DA BD <br>";
            //header("Location: ../register.php?msg=0");
        }

    } else {
        // ERROR ACTION
        echo "ERRO <br>";
        //header("Location: ../register.php?msg=0");
        mysqli_close($link);
    }
} else {
    echo "ERRO de não temos nada inserido <br>";
    // header("Location: ../register.php?msg=2");
}