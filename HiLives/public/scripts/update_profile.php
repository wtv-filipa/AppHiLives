<?php
session_start();
$id_navegar = $_SESSION["idUser"];
if (isset($_GET["id"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["def"])) {
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
    // Create a new DB connection
    $link2 = new_db_connection();
    /* create a prepared statement */
    $stmt2 = mysqli_stmt_init($link2);

    /*VER O QUE VEM DA BD E COMPARAR COM OS ARRAYS QUE VEEM DO ATUALIZAR PERFIL (AERAS E REGIOES) PARA VER SE SE APAGA O MATCH*/
    //regiao
    $query10 = "SELECT Region_idRegion FROM user_has_region WHERE User_idUser_region = ?";
    $query11 = "DELETE FROM young_university
            WHERE User_young = ? AND User_university IN (
	        SELECT idUser FROM users
	        INNER JOIN user_has_region
	        ON users.idUser = user_has_region.User_idUser_region
	        WHERE users.User_type_idUser_type = 13 AND Region_idRegion = ?)";
    $regiao = $_POST["regiao"];

    if (mysqli_stmt_prepare($stmt, $query10)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Region_idRegion);
        while (mysqli_stmt_fetch($stmt)) {
            $search_val = in_array($Region_idRegion, $regiao);
            if ($search_val == false) {
                /* echo "REGIÃO NÃO EXISTE NO ARRAY! <br>";
                echo "regiao em falta: $Region_idRegion"; */
                //Apagar o match
                if (mysqli_stmt_prepare($stmt2, $query11)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Region_idRegion);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        /*  echo "sucesso a apagar o mtach com base em regioes <br>"; */
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
            }
        }
    }
    /************************************************************/
    //area
    $query12 = "SELECT Areas_idAreas, name_interested_area 
FROM user_has_areas 
INNER JOIN areas 
ON user_has_areas.Areas_idAreas = areas.idAreas
WHERE User_idUser = ?";

    $query13 = "DELETE FROM young_university
WHERE User_young = ?  AND User_university IN 
(SELECT idUser FROM users
INNER JOIN user_has_areas
ON users.idUser = user_has_areas.User_idUser
INNER JOIN areas
ON areas.idAreas = user_has_areas.Areas_idAreas
WHERE users.User_type_idUser_type = 13 AND young_university.Area = ?)";
    $area = $_POST["area"];

    if (mysqli_stmt_prepare($stmt, $query12)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Areas_idAreas, $name_interested_area);
        while (mysqli_stmt_fetch($stmt)) {
            /*  echo "<br> area bd: $Areas_idAreas <br>";
            var_dump($area);
            echo "<br>"; */
            $search_area = in_array($Areas_idAreas, $area);
            /* echo "array search: $search_area <br>"; */
            if ($search_area == false) {
                /* echo "AREA NÃO EXISTE NO ARRAY! <br>";
                echo "area em falta: $Areas_idAreas e nome: $name_interested_area"; */
                //Apagar o match
                if (mysqli_stmt_prepare($stmt2, $query13)) {
                    mysqli_stmt_bind_param($stmt2, 'is', $idUser, $name_interested_area);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        /* echo "sucesso a apagar o match com base em areas <br>"; */
                        //mysqli_stmt_close($stmt2);
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
            }
        }
    }

    /*VERIFICAR SE AINDA PODE ESTAR A FAZER MATCH COM AS VAGAS*/
    //regiao
    //usar query 10 por causa das regiões do jovem
    //Apaga onde é match
    $query14 = "DELETE FROM user_has_vacancies
WHERE User_young = ? AND Vacancies_idVacancies IN (
SELECT idVacancies FROM vacancies
WHERE Region_idRegion = ? AND match_perc = 1)";
    //Apaga as capacidades do percurso
    $query15 = "DELETE FROM learning_path_capacities
WHERE fk_match_vac IN (
SELECT id_match_vac FROM user_has_vacancies
INNER JOIN vacancies 
ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
WHERE Region_idRegion = ? AND match_perc = 0 AND User_young = ?)";
    //apaga o percurso
    $query16 = "DELETE FROM user_has_vacancies
WHERE User_young = ? AND Vacancies_idVacancies IN (
SELECT idVacancies FROM vacancies
WHERE Region_idRegion = ? AND match_perc = 0)";

    if (mysqli_stmt_prepare($stmt, $query10)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Region_idRegion);
        while (mysqli_stmt_fetch($stmt)) {
            $search_regiao = in_array($Region_idRegion, $regiao);
            if ($search_regiao == false) {
                echo "REGIÃO NÃO EXISTE NO ARRAY! <br>";
                echo "regiao em falta: $Region_idRegion";
                //Apagar o match
                if (mysqli_stmt_prepare($stmt2, $query14)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Region_idRegion);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar o mtach com base em regioes <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                //Apagar capacidades do percurso
                if (mysqli_stmt_prepare($stmt2, $query15)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $Region_idRegion, $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar as capacidades com base em regioes <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                //Apagar o match com um percurso
                if (mysqli_stmt_prepare($stmt2, $query16)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Region_idRegion);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar as capacidades com base em regioes <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
            }
        }
    }
    /************************************************************/
    //area
    //ver as àreas do user
    $query30 = "SELECT Areas_idAreas
FROM user_has_areas 
WHERE User_idUser = ?";
    //apagar match
    $query31 = "DELETE FROM user_has_vacancies WHERE User_young = ? AND Vacancies_idVacancies IN ( SELECT idVacancies FROM vacancies WHERE Areas_idAreas = ? AND match_perc = 1)";
    //apagar capacidades do percurso
    $query32 = "DELETE FROM learning_path_capacities
WHERE fk_match_vac IN (
SELECT id_match_vac FROM user_has_vacancies
INNER JOIN vacancies 
ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
WHERE Areas_idAreas = ? AND match_perc = 0 AND User_young = ?)";
    //apagar percurso
    $query33 = "DELETE FROM user_has_vacancies
WHERE User_young = ? AND Vacancies_idVacancies IN (
SELECT idVacancies FROM vacancies
WHERE Areas_idAreas = ? AND match_perc = 0)";

    if (mysqli_stmt_prepare($stmt, $query30)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Areas_idAreas);
        while (mysqli_stmt_fetch($stmt)) {
            $procura = in_array($Areas_idAreas, $area);
            echo "array search: $procura <br>";
            if ($procura == false) {
                echo "AREA NÃO EXISTE NO ARRAY! <br>";
                echo "area em falta: $Areas_idAreas";
                //Apagar o match
                if (mysqli_stmt_prepare($stmt2, $query31)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Areas_idAreas);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar o mtach com base em areas <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                //Apagar capacidades do percurso
                if (mysqli_stmt_prepare($stmt2, $query32)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $Areas_idAreas, $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar as capacidades com base em areas <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                //Apagar o match com um percurso
                if (mysqli_stmt_prepare($stmt2, $query33)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Areas_idAreas);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar o match das capacidades com base em areas <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
            }
        }
    }
    //$school
    //verificar a escolaridade do user
    $query34 = "SELECT Educ_lvl_idEduc_lvl  FROM users WHERE idUser = ?";
    //apaga o match
    $query35 = "DELETE FROM user_has_vacancies 
    WHERE User_young = ? AND Vacancies_idVacancies IN (
    SELECT idVacancies FROM vacancies 
    WHERE Educ_lvl_idEduc_lvl > ? AND match_perc = 1)";
    //apaga capacidades do percurso
    $query36 = "DELETE FROM learning_path_capacities
    WHERE fk_match_vac IN (
    SELECT id_match_vac FROM user_has_vacancies
    INNER JOIN vacancies 
    ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
    WHERE Educ_lvl_idEduc_lvl > ? AND match_perc = 0 AND User_young = ?)";
    //apaga o percurso
    $query37 = "DELETE FROM user_has_vacancies
    WHERE User_young = ? AND Vacancies_idVacancies IN (
    SELECT idVacancies FROM vacancies
    WHERE Educ_lvl_idEduc_lvl > ? AND match_perc = 0)";

    if (mysqli_stmt_prepare($stmt, $query34)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Educ_lvl_idEduc_lvl);
        while (mysqli_stmt_fetch($stmt)) {
            if ($Educ_lvl_idEduc_lvl > $school &&  $Educ_lvl_idEduc_lvl != $school) {
                echo "nível de educação inferior: $school";
                echo "nível de educação que tem: $Educ_lvl_idEduc_lvl";
                //Apagar o match
                if (mysqli_stmt_prepare($stmt2, $query35)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $school);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar o mtach com base em nivel de educ <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                //Apagar capacidades do percurso
                if (mysqli_stmt_prepare($stmt2, $query36)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $school, $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar as capacidades com base em educlvl <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                //Apagar o match com um percurso
                if (mysqli_stmt_prepare($stmt2, $query37)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $school);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        echo "sucesso a apagar o match das capacidades com base em educ lvl <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
            }
        }
    }
    /************************************************************/

    /*UPDATE DO PERFIL*/
    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?, info_young=?, work_xp=?, Educ_lvl_idEduc_lvl=?
      WHERE idUser = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssssii', $nome, $email, $tlm, $data_nasc, $info_young, $work_xp, $school, $idUser);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            //ERRO
            header("Location: ../edit_profile.php?edit=$id_navegar");
            $_SESSION["edit_jovem"] = 3;
            //echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            /* echo "we did it"; */
            //REGIÃO
            if (!empty($_POST["regiao"])) {
                // APAGAR TODOS AS REGIÕES ASSOCIADAS AO USER
                $query2 = "DELETE FROM user_has_region
    WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt);
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
                            //ERRO
                            header("Location: ../edit_profile.php?edit=$id_navegar");
                            $_SESSION["edit_jovem"] = 3;
                            //echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* close connection */
                mysqli_close($link);
            } //FIM DO ISSET DA REGIÃO
            //UPDATE AREA
            if (!empty($_POST["area"])) {
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
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        // echo "Error: " . mysqli_stmt_error($stmt);
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
                            //ERRO
                            header("Location: ../edit_profile.php?edit=$id_navegar");
                            $_SESSION["edit_jovem"] = 3;
                            //echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* close connection */
                mysqli_close($link);
            } //FIM DO ISSET DA AREA
        }
        /* close statement 
        mysqli_stmt_close($stmt);*/
        // INSERIR TODAS AS NOVAS COMPETÊNCIAS
        //UPDATE COMPETÊNCIAS
        if (!empty($_POST["capacity"])) {
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
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                    //echo "Error: " . mysqli_stmt_error($stmt);
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
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }
        }

        // INSERIR TODAS OS NOVOS AMBIENTES DE TRABALHO
        //UPDATE AMBIENTES
        if (!empty($_POST["spot"])) {
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
                    //ERRO
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                    //echo "Error: " . mysqli_stmt_error($stmt);
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
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }
        }
        //match com a uni
        include "match_uni_login.php";
        //SUCESSO
        /*   header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit_jovem"] = 1; */
    } else {
        //ERRO
        header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit_jovem"] = 3;
        //echo "Error: " . mysqli_stmt_error($stmt);
    }
    /* close connection */
    //mysqli_close($link);
} else if (isset($_GET["id_uni_emp"]) && !empty($_POST["nome"]) && !empty($_POST["email"])) {
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
    // Create a new DB connection
    $link2 = new_db_connection();
    /* create a prepared statement */
    $stmt2 = mysqli_stmt_init($link2);

    //APAGAR DO MATCH CASO AS AREAS DA UNIVERSIDADE SEJAM APAGADAS
    $query14 = "SELECT type_user FROM user_type INNER JOIN users ON user_type.idUser_type = users.User_type_idUser_type WHERE users.idUser = ?";

    $query15 = "SELECT Areas_idAreas, name_interested_area 
FROM user_has_areas 
INNER JOIN areas 
ON user_has_areas.Areas_idAreas = areas.idAreas
WHERE User_idUser = ?";

    $query16 = "DELETE FROM young_university
WHERE User_university = ?  AND User_young IN 
(SELECT idUser FROM users
INNER JOIN user_has_areas
ON users.idUser = user_has_areas.User_idUser
INNER JOIN areas
ON areas.idAreas = user_has_areas.Areas_idAreas
WHERE users.User_type_idUser_type = 10 AND young_university.Area = ?)";

    $area = $_POST["area"];

    if (mysqli_stmt_prepare($stmt, $query14)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $type_user);
        while (mysqli_stmt_fetch($stmt)) {
            if ($type_user == "Universidade") {
                if (mysqli_stmt_prepare($stmt, $query15)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $Areas_idAreas, $name_interested_area);
                    while (mysqli_stmt_fetch($stmt)) {
                        /* echo "<br> area bd: $Areas_idAreas <br>";
                        var_dump($area);
                        echo "<br>"; */
                        $search_area = in_array($Areas_idAreas, $area);
                        /* echo "array search: $search_area <br>"; */
                        if ($search_area == false) {
                            /* echo "AREA NÃO EXISTE NO ARRAY! <br>";
                            echo "area em falta: $Areas_idAreas e nome: $name_interested_area"; */
                            //Apagar o match
                            if (mysqli_stmt_prepare($stmt2, $query16)) {
                                mysqli_stmt_bind_param($stmt2, 'is', $idUser, $name_interested_area);
                                // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                if (!mysqli_stmt_execute($stmt2)) {
                                    //ERRO
                                    header("Location: ../edit_profile.php?edit=$id_navegar");
                                    $_SESSION["edit"] = 3;
                                    //echo "Error: " . mysqli_stmt_error($stmt2);
                                } else {
                                    /*  echo "sucesso a apagar o mtach com base em areas <br>"; */
                                    //mysqli_stmt_close($stmt2);
                                }
                            } else {
                                //echo "erro a apagar o mtach com base em areas <br>";
                                //ERRO
                                header("Location: ../edit_profile.php?edit=$id_navegar");
                                $_SESSION["edit"] = 3;
                            }
                        }
                    }
                }
            }
        }
    }

    /************************************************************/
    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?, website_ue = ?, facebook_ue = ?, instagram_ue = ?, description_ue = ?, history_ue = ?
      WHERE idUser = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssssssssi', $nome, $email, $tlm, $data_fund, $site, $face, $insta, $desc, $hist, $idUser);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            //ERRO
            header("Location: ../edit_profile.php?edit=$id_navegar");
            $_SESSION["edit"] = 3;
            //echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            //echo "we did it";
            //REGIÃO
            if (!empty($_POST["regiao"])) {
                // APAGAR TODOS AS REGIÕES ASSOCIADAS AO USER
                $query2 = "DELETE FROM user_has_region
WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt);
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
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        /* echo "inseriu a região"; */
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* close connection */
                mysqli_close($link);
            } //FIM DO ISSET DA REGIÃO
            //UPDATE AREA
            if (!empty($_POST["area"])) {
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
                        //ERRO
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit"] = 3;
                        //echo "Error: " . mysqli_stmt_error($stmt);
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
                            //ERRO
                            header("Location: ../edit_profile.php?edit=$id_navegar");
                            $_SESSION["edit"] = 3;
                            //echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
            } //FIM DO ISSET DA AREA
        }
        //match com o jovem
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $query14)) {
            mysqli_stmt_bind_param($stmt, 'i', $idUser);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $type_user);
            while (mysqli_stmt_fetch($stmt)) {
                if ($type_user == "Universidade") {
                    include "match_young_login.php";
                }
            }
        }
        /* close statement */
        mysqli_stmt_close($stmt);
        //SUCESSO
        header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit"] = 1;
    } else {
        //ERRO
        header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit"] = 3;
        //echo "Error: " . mysqli_stmt_error($stmt);
    }
} else {
    //ERRO
    header("Location: ../edit_profile.php?edit=$id_navegar");
    $_SESSION["edit_jovem"] = 2;
    $_SESSION["edit"] = 2;
}
