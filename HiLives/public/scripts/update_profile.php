<?php
if (isset($_GET["id"]) && isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["def"])) {
    echo "estou a editar um jovem";
    $idUser = $_GET["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tlm = $_POST["phone"];
    $data_nasc = $_POST["data_nasc"];
    $info_young = $_POST["def"];
    $work_xp = $_POST["work"];
    $school = $_POST["esc"];
    // We need the function!
    require_once("../connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?, info_young=?, work_xp=?, Educ_lvl_idEduc_lvl=?
      WHERE idUser = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssssii', $nome, $email, $tlm, $data_nasc, $info_young, $work_xp, $school, $idUser);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            $idUser = $_POST["edit"];
            echo $idUser;
            /*header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");
            */
            echo "erro da stmt execute <br/>";
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            echo "we did it";
            //REGIÃO
            if (isset($_POST["regiao"])) {
                // APAGAR TODOS AS REGIÕES ASSOCIADAS AO USER
                $query2 = "DELETE FROM user_has_region
    WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

                // INSERIR AS NOVAS REGIÕES ESCOLHIDAS
                $query3 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
                  VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query3)) {

                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);

                    // PARA TODOS AS REGIÕES ESCOLHIDAS
                    foreach ($_POST["regiao"] as $idRegion) {
                        /* execute the prepared statement */
                        if (!mysqli_stmt_execute($stmt)) {
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }

                /* close connection */
                mysqli_close($link);
                //header("Location: clube.php?id=$id_clubes");
            } //FIM DO ISSET DA REGIÃO
            //UPDATE AREA
            if (isset($_POST["area"])) {
                // Create a new DB connection
                $link = new_db_connection();
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);
                // APAGAR TODOS AS AREAS ASSOCIADAS AO USER
                $query4 = "DELETE FROM user_has_areas
 WHERE User_idUser = ?";

                if (mysqli_stmt_prepare($stmt, $query4)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

                // INSERIR TODAS AS NOVAS ÁREAS ESCOLHIDAS
                $query5 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
               VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query5)) {

                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idAreas);

                    // PARA TODSS AS AREAS ESCOLHIDAS
                    foreach ($_POST["area"] as $idAreas) {
                        /* execute the prepared statement */
                        if (!mysqli_stmt_execute($stmt)) {
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* close connection */
                mysqli_close($link);
            } //FIM DO ISSET DA AREA
        }
        /* close statement */
        //mysqli_stmt_close($stmt);

        // INSERIR TODAS AS NOVAS COMPETÊNCIAS
        //UPDATE COMPETÊNCIAS
        if (isset($_POST["capacity"])) {
            // Create a new DB connection
            $link = new_db_connection();
            /* create a prepared statement */
            $stmt = mysqli_stmt_init($link);
            // APAGAR TODOS AS COMPETÊNCIAS ASSOCIADAS AO USER
            $query6 = "DELETE FROM capacities_has_users
 WHERE users_idUser = ?";

            if (mysqli_stmt_prepare($stmt, $query6)) {

                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                /* close statement */
                mysqli_stmt_close($stmt);
            }
            /* create a prepared statement */
            $stmt = mysqli_stmt_init($link);

            $query7 = "INSERT INTO capacities_has_users (capacities, users_idUser)
               VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query7)) {

                mysqli_stmt_bind_param($stmt, 'ii', $capacities, $idUser);

                // PARA TODSS AS AREAS ESCOLHIDAS
                foreach ($_POST["capacity"] as $capacities) {
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }
        }

        // INSERIR TODAS OS NOVOS AMBIENTES DE TRABALHO
        //UPDATE AMBIENTES
        if (isset($_POST["spot"])) {
            // Create a new DB connection
            $link = new_db_connection();
            /* create a prepared statement */
            $stmt = mysqli_stmt_init($link);
            // APAGAR TODOS OS AMBIENTES ASSOCIADAS AO USER
            $query8 = "DELETE FROM work_environment_has_users
 WHERE users_idUser = ?";

            if (mysqli_stmt_prepare($stmt, $query8)) {

                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                /* close statement */
                mysqli_stmt_close($stmt);
            }
            /* create a prepared statement */
            $stmt = mysqli_stmt_init($link);

            $query9 = "INSERT INTO work_environment_has_users (favorite_environment, users_idUser)
               VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query9)) {

                mysqli_stmt_bind_param($stmt, 'ii', $favorite_environment, $idUser);

                // PARA TODAS AS AREAS ESCOLHIDAS
                foreach ($_POST["spot"] as $favorite_environment) {
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }
        }

        echo $idUser;
        header("Location: ../edit_profile.php?edit=$idUser");
        echo "sucesso";
    } else {
        //header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");*/
        echo " erro do stmt prepare <br/>";
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    /* close connection */
    //mysqli_close($link);
} else if (isset($_GET["id_uni_emp"]) && isset($_POST["nome"]) && isset($_POST["email"])) {
    echo "estou a editar uma empresa/universidade";
    $idUser = $_GET["id_uni_emp"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tlm = $_POST["phone"];
    $data_fund = $_POST["data_fund"];
    $site = $_POST["site"];
    $face = $_POST["face"];
    $insta = $_POST["insta"];
    $desc = $_POST["desc"];
    $hist = $_POST["hist"];
    // We need the function!
    require_once("../connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?, website_ue = ?, facebook_ue = ?, instagram_ue = ?, description_ue = ?, history_ue = ?
      WHERE idUser = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssssssssi', $nome, $email, $tlm, $data_fund, $site, $face, $insta, $desc, $hist, $idUser);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            $idUser = $_POST["edit"];
            echo $idUser;
            /*header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");
        */
            echo "erro da stmt execute <br/>";
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            echo "we did it";
            //REGIÃO
            if (isset($_POST["regiao"])) {
                // APAGAR TODOS AS REGIÕES ASSOCIADAS AO USER
                $query2 = "DELETE FROM user_has_region
WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

                // INSERIR AS NOVAS REGIÕES ESCOLHIDAS
                $query3 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
              VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query3)) {

                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);

                    $idRegion = $_POST["regiao"];
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        echo "inseriu a região";
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* close connection */
                mysqli_close($link);
            } //FIM DO ISSET DA REGIÃO
            //UPDATE AREA
            if (isset($_POST["area"])) {
                // Create a new DB connection
                $link = new_db_connection();
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);
                // APAGAR TODOS AS AREAS ASSOCIADAS AO USER
                $query4 = "DELETE FROM user_has_areas
 WHERE User_idUser = ?";

                if (mysqli_stmt_prepare($stmt, $query4)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

                // INSERIR TODAS AS NOVAS ÁREAS ESCOLHIDAS
                $query5 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
               VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query5)) {

                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idAreas);

                    // PARA TODSS AS AREAS ESCOLHIDAS
                    foreach ($_POST["area"] as $idAreas) {
                        /* execute the prepared statement */
                        if (!mysqli_stmt_execute($stmt)) {
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                //header("Location: clube.php?id=$id_clubes");
            } //FIM DO ISSET DA AREA
        }

        echo $idUser;
        header("Location: ../edit_profile.php?edit=$idUser");
        echo "sucesso";
    } else {
        //header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");*/
        echo " erro do stmt prepare <br/>";
        echo "Error: " . mysqli_stmt_error($stmt);
    }
} else {
    echo "faltam campos obrigatórios";
}
