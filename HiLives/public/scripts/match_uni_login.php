<?php
//ESTE MATCH (UNIVERSIDADE) É PARA QUANDO O UTILIZADOR JÁ EXISTE E PRETENDEMOS VERIFICAR SE JÁ TEM TODOS OS MATCH FEITOS OU NÃO (PODE SER COLOCADO NO LOGIN, OU NO UPDATE DO PERFIL)
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);
$link5 = new_db_connection();
$stmt5 = mysqli_stmt_init($link5);
$link6 = new_db_connection();
$stmt6 = mysqli_stmt_init($link6);
//MATCH

$query8 = "INSERT INTO young_university (User_young, User_university, Area) VALUES (?, ?, ?)";

//Esta query vai fazr um select dos users que são universidades e ao mesmo tempo já os relaciona com os jovens que têm a mesma area
$query9 = "SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area, name_region FROM user_has_areas 
INNER JOIN users ON user_has_areas.User_idUser = users.idUser 
INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas 
INNER JOIN user_has_region ON user_has_region.User_idUser_region = users.idUser 
INNER JOIN region ON region.idRegion = user_has_region.Region_idRegion 
WHERE User_type_idUser_type = 13 
AND Areas_idAreas IN (SELECT Areas_idAreas FROM user_has_areas WHERE user_has_areas.User_idUser = ? ) 
AND Region_idRegion IN (SELECT Region_idRegion FROM user_has_region WHERE user_has_region.User_idUser_region= ?)";
//verificar o que existe na tabela do match
$query10 = "SELECT User_young, User_university, Area, login_young FROM young_university WHERE User_young = ? AND User_university = ? AND Area = ?";

$query12 = "INSERT INTO notifications(text_noti, User_idUser) VALUES (?,?)";
$query13 = "SELECT name_user FROM users
            WHERE idUser = ?";

$nome_uni = [];
//prepare da query que seleciona o que está em comum
if (mysqli_stmt_prepare($stmt3, $query9)) {
    mysqli_stmt_bind_param($stmt3, 'ii', $idUser, $idUser);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $User_idUser, $Areas_idAreas, $User_type_idUser_type, $name_interested_area, $name_region);
    while (mysqli_stmt_fetch($stmt3)) {
        //echo "<br>$name_interested_area<br>";
        //Verificar se já existe alguma coisa inserida
        if (mysqli_stmt_prepare($stmt5, $query10)) {
            mysqli_stmt_bind_param($stmt5, 'iis', $idUser, $User_idUser, $name_interested_area);

            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $User_university, $Area, $login_young);
            if (mysqli_stmt_fetch($stmt5)) {
                //echo "areas já inseridas <br>";
                //echo "$login_young";
                if($login_young == 0) {
                    $query11 = "UPDATE young_university
                                    SET login_young = 1
                                    WHERE User_young = ? AND User_university = ? AND Area = ?";
                    if (mysqli_stmt_prepare($stmt6, $query11)) {
                        mysqli_stmt_bind_param($stmt6, 'iis', $idUser, $User_idUser, $name_interested_area);
                        /* execute the prepared statement */
                        if (!mysqli_stmt_execute($stmt6)) {
                            echo "Error: " . mysqli_stmt_error($stmt6);
                        }
                    }
                }
            } else {
                //Faz o prepare da query2 que é a que vai inserir os dados
                if (mysqli_stmt_prepare($stmt4, $query8)) {
                    mysqli_stmt_bind_param($stmt4, 'iis', $idUser, $User_idUser, $name_interested_area);

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt4)) {
                        echo "Error: " . mysqli_stmt_error($stmt4);
                    } else {
                        //echo "match feito <br>";
                        // SUCCESS ACTION
                        //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");
                        $query11 = "UPDATE young_university
                                    SET login_young = 1
                                    WHERE User_young = ? AND User_university = ? AND Area = ?";
                        if (mysqli_stmt_prepare($stmt6, $query11)) {
                            mysqli_stmt_bind_param($stmt6, 'iis', $idUser, $User_idUser, $name_interested_area);
                            /* execute the prepared statement */
                            if (!mysqli_stmt_execute($stmt6)) {
                                echo "Error: " . mysqli_stmt_error($stmt6);
                            }
                        }
                    }
                } else {
                    // ERROR ACTION
                    //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
                    //mysqli_close($link);
                }
                //echo "areas ainda não inseridas <br>";
            }
        }
        if ($nome_uni[$User_idUser] === NULL) {
            $nome_uni[$User_idUser] = [];
        }
        if (!in_array($nome_uni, $nome_uni[$User_idUser])) {
            array_push($nome_uni[$User_idUser], $name_interested_area);
        }
    }
}
//noti
foreach ($nome_uni as $id => $areas) {
    if (mysqli_stmt_prepare($stmt5, $query13)) {
        mysqli_stmt_bind_param($stmt5, 'i', $id);
        mysqli_stmt_execute($stmt5);
        mysqli_stmt_bind_result($stmt5, $name_comp);
        if (mysqli_stmt_fetch($stmt5)) {
            foreach ($areas as $area) {
                //echo "$login_young";
                if ($login_young == 0) {
                    $text = "Tens uma nova ligação na área " . $area . " com a " . $name_comp . ".";
                    echo "$text";
                    //Insere a notificação
                    if (mysqli_stmt_prepare($stmt5, $query12)) {
                        mysqli_stmt_bind_param($stmt5, 'si', $text, $idUser);
                        mysqli_stmt_execute($stmt5);
                        if (!mysqli_stmt_execute($stmt5)) {
                            echo "Error: " . mysqli_stmt_error($stmt5);
                        } else {
                            //echo "inseriu";
                        }
                    }
                }
            }
        }
    }
}


/***********************************************/

//MATCH DO JOVEM COM EMPRESA AKA VAGA
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);

//MATCH COM REGIAO, CAPACIDADES, ESCOLARIDADE, AREA
$query20 = "SELECT Educ_lvl_idEduc_lvl FROM users WHERE idUser = ?";
$query21 = "SELECT idVacancies, vacancie_name, vacancies.Region_idRegion, User_publicou, vacancies.Educ_lvl_idEduc_lvl, Areas_idAreas, capacities_idcapacities FROM vacancies
            INNER JOIN users ON vacancies.User_publicou = users.idUser
            INNER JOIN user_has_region ON vacancies.User_publicou = user_has_region.User_idUser_region
            INNER JOIN areas ON vacancies.Areas_idAreas = areas.idAreas
            INNER JOIN region ON vacancies.Region_idRegion = region.idRegion
            INNER JOIN educ_lvl ON vacancies.Educ_lvl_idEduc_lvl = educ_lvl.idEduc_lvl
            INNER JOIN vacancies_has_capacities ON vacancies.idVacancies = vacancies_has_capacities.vacancies_idVacancies
            WHERE User_type_idUser_type = 7 
            AND Areas_idAreas IN (SELECT Areas_idAreas FROM user_has_areas WHERE user_has_areas.User_idUser = ?) 
            AND vacancies.Region_idRegion IN (SELECT user_has_region.Region_idRegion FROM user_has_region WHERE user_has_region.User_idUser_region= ?)
            AND capacities_idcapacities IN (SELECT capacities FROM capacities_has_users WHERE users_idUser = ?)
            AND vacancies.Educ_lvl_idEduc_lvl <= ?";
$nome_comp = [];


$capacidades_match = [];
$capacidades_jovem = array();
if (mysqli_stmt_prepare($stmt2, $query20)) {
    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result($stmt2, $Educ_lvl_idEduc_lvl_young);
    if (mysqli_stmt_fetch($stmt2)) {
        //echo $Educ_lvl_idEduc_lvl_young;

        if (mysqli_stmt_prepare($stmt3, $query21)) {
            mysqli_stmt_bind_param($stmt3, 'iiii', $idUser, $idUser, $idUser, $Educ_lvl_idEduc_lvl_young);

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $idVacancies, $vacancie_name, $Region_idRegion, $User_publicou, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $capacities_idcapacities_match);
            while (mysqli_stmt_fetch($stmt3)) {
                //array capacidades jovem (que já fazem match)
                if (!in_array($capacities_idcapacities_match, $capacidades_jovem)) {
                    array_push($capacidades_jovem, $capacities_idcapacities_match);
                }
                $query22 = "SELECT vacancies_idVacancies, capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";

                if (mysqli_stmt_prepare($stmt2, $query22)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancies);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $vacancies_idVacancies, $capacities_idcapacities);
                    while (mysqli_stmt_fetch($stmt2)) {
                        //array_push($capacidades_match, $capacities_idcapacities_match);
                        //array com as capacidades da vaga
                        if ($capacidades_match[$idVacancies] === NULL) {
                            $capacidades_match[$idVacancies] = [];
                        }
                        if (!in_array($capacities_idcapacities, $capacidades_match[$idVacancies])) {
                            array_push($capacidades_match[$idVacancies], $capacities_idcapacities);
                        }
                    } //fim do segundo while
                } //fecho do if da query22
            } //fecho do primeiro while
        }
        if ($nome_comp[$User_publicou] === NULL) {
            $nome_comp[$User_publicou] = [];
        }
        if (!in_array($nome_comp, $nome_comp[$User_publicou])) {
            array_push($nome_comp[$User_publicou], $vacancie_name);
        }
    } //fim do if da query20
}
echo "<pre>" . print_r($nome_comp, true) . "</pre>";

//inserir quando dá match/percurso
$query23 = "INSERT INTO user_has_vacancies (User_young, Vacancies_idVacancies, match_perc) VALUES (?, ?, ?)";
//inserir capacidades para o percurso
$query24 = "INSERT INTO learning_path_capacities (fk_match_vac, missing_learn) VALUES (?, ?)";
//verificar o que existe na tabela do match com a VAGA
$query25 = "SELECT User_young, Vacancies_idVacancies, login_young FROM user_has_vacancies WHERE User_young = ? AND Vacancies_idVacancies = ?";


$capacidades_final = $capacidades_match;
foreach ($capacidades_match as $vaga => $capacidades) {
    $capacidades_final[$vaga] = array_diff($capacidades, $capacidades_jovem);
    //verificação do que é (match/percurso/não match)
    if (count($capacidades_final[$vaga]) <= 1) {
//        echo "match!";
//        echo "<br> vaga: $vaga";
//        echo "<br>";
        /***********/
        //Verificar se já existe alguma coisa inserida
        if (mysqli_stmt_prepare($stmt5, $query25)) {
            mysqli_stmt_bind_param($stmt5, 'ii', $idUser, $vaga);

            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $fk_idVacancies, $login_young_comp);
            if (mysqli_stmt_fetch($stmt5)) {
                //echo "match já existe <br>";
                //echo "$login_young";
            } else {
                //echo "match ainda não existe vai inserir <br>";
                $match_vac = 1;
                //insere os dados que faz match
                if (mysqli_stmt_prepare($stmt4, $query23)) {
                    mysqli_stmt_bind_param($stmt4, 'iii', $idUser, $vaga, $match_vac);

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt4)) {
                        echo "Error: " . mysqli_stmt_error($stmt4);
                    } else {
                        //echo "match feito <br>";
                        // SUCCESS ACTION
                        //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");

                        //noti
                        foreach ($nome_comp as $id => $vagas2) {
                            if (mysqli_stmt_prepare($stmt5, $query13)) {
                                mysqli_stmt_bind_param($stmt5, 'i', $id);
                                mysqli_stmt_execute($stmt5);
                                mysqli_stmt_bind_result($stmt5, $name_comp);
                                if (mysqli_stmt_fetch($stmt5)) {
//                                    echo "$name_comp";
//                                    echo "$login_young_comp";
                                    foreach ($vagas2 as $vaga2) {
                                        if ($login_young_comp == 0) {
                                            $text = "Tens uma nova ligação na vaga " . $vaga2 . " com a " . $name_comp . ".";
                                            echo "$text";
                                            //Insere a notificação
                                            if (mysqli_stmt_prepare($stmt5, $query12)) {
                                                mysqli_stmt_bind_param($stmt5, 'si', $text, $idUser);
                                                mysqli_stmt_execute($stmt5);
                                                if (!mysqli_stmt_execute($stmt5)) {
                                                    echo "Error: " . mysqli_stmt_error($stmt5);
                                                } else {
                                                    //echo "inseriu";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    // ERROR ACTION
                    //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
                    //mysqli_close($link);
                }
            }
            $query11 = "UPDATE user_has_vacancies
                                            SET login_young = 1
                                            WHERE User_young = ? AND Vacancies_idVacancies = ?";
            if (mysqli_stmt_prepare($stmt6, $query11)) {
                mysqli_stmt_bind_param($stmt6, 'ii', $idUser, $vaga);
                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt6)) {
                    echo "Error: " . mysqli_stmt_error($stmt6);
                }
            }

        } //fim da query25 no match
        /******************/
        /***********************************/
    } else if (count($capacidades_final[$vaga]) == 2 || count($capacidades_final[$vaga]) == 3) {
//        echo "percurso";
//        echo "<br> vaga: $vaga";
//        echo "<br>";
        /***********/
        //Verificar se já existe alguma coisa inserida
        if (mysqli_stmt_prepare($stmt5, $query25)) {
            mysqli_stmt_bind_param($stmt5, 'ii', $idUser, $vaga);

            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $fk_idVacancies, $login_young_comp);
            if (mysqli_stmt_fetch($stmt5)) {
                //echo "match já existe <br>";
            } else {
                //echo "match ainda não existe vai inserir <br>";
                $percurso = 0;

                //insere os dados que faz o percurso
                if (mysqli_stmt_prepare($stmt4, $query23)) {
                    mysqli_stmt_bind_param($stmt4, 'iii', $idUser, $vaga, $percurso);

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt4)) {
                        echo "Error: " . mysqli_stmt_error($stmt4);
                    } else {
                        //echo "percurso feito <br>";
                        $id_percurso = mysqli_insert_id($link4);
                        //echo "ID depois de inserir o percurso: " . "$id_percurso <br>";
                        // SUCCESS ACTION
                        //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");

                        //noti
                        foreach ($nome_comp as $id => $vagas2) {
                            if (mysqli_stmt_prepare($stmt5, $query13)) {
                                mysqli_stmt_bind_param($stmt5, 'i', $id);
                                mysqli_stmt_execute($stmt5);
                                mysqli_stmt_bind_result($stmt5, $name_comp);
                                if (mysqli_stmt_fetch($stmt5)) {
                                    foreach ($vagas2 as $vaga2) {
                                        echo "$login_young_comp";
                                        if ($login_young_comp == 0) {
                                            $text = "Tens um novo percurso na vaga " . $vaga2 . " com a " . $name_comp . ".";
                                            echo "$text";
                                            //Insere a notificação
                                            if (mysqli_stmt_prepare($stmt5, $query12)) {
                                                mysqli_stmt_bind_param($stmt5, 'si', $text, $idUser);
                                                mysqli_stmt_execute($stmt5);
                                                if (!mysqli_stmt_execute($stmt5)) {
                                                    echo "Error: " . mysqli_stmt_error($stmt5);
                                                } else {
                                                    //echo "inseriu";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }

                    }
                } else {
                    // ERROR ACTION
                    //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
                    //mysqli_close($link);
                }
                //insere os dados das capacidades que faltam
                if (mysqli_stmt_prepare($stmt4, $query24)) {
                    mysqli_stmt_bind_param($stmt4, 'ii', $id_percurso, $id_capacidades);
                    //para todas as capacidades sem match
                    foreach ($capacidades_final[$vaga] as $id_capacidades) {
                        //echo "id da cpacidade sem match: $id_capacidades<br>";
                        /* execute the prepared statement */
                        if (!mysqli_stmt_execute($stmt4)) {
                            //ERRO
                            //echo "Error: " . mysqli_stmt_error($stmt);
                        } else {
                            //echo "capacidades inseridas do percurso <br>";
                            // SUCCESS ACTION
                            //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");
                        }
                    }
                } else {
                    // ERROR ACTION
                    //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
                    //mysqli_close($link);
                }
            }

            $query11 = "UPDATE user_has_vacancies
                                            SET login_young = 1
                                            WHERE User_young = ? AND Vacancies_idVacancies = ?";
            if (mysqli_stmt_prepare($stmt6, $query11)) {
                mysqli_stmt_bind_param($stmt6, 'ii', $idUser, $vaga);
                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt6)) {
                    echo "Error: " . mysqli_stmt_error($stmt6);
                }
            }



        } //fim da query25 no percurso
        /******************/
        /***********************************/
    } else if (count($capacidades_final[$vaga]) >= 4) {
//        echo "não tem match";
//        echo "<br> vaga: $vaga";
//        echo "<br>";
    }
}
//echo "<pre>" . print_r($capacidades_final, true) . "</pre>";





