<?php
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
 
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);
 
$link5 = new_db_connection();
$stmt5 = mysqli_stmt_init($link5);
 
$link6 = new_db_connection();
$stmt6 = mysqli_stmt_init($link6);
 
$idComp = $_SESSION["idUser"];
 
//MATCH COM REGIAO, CAPACIDADES, ESCOLARIDADE, AREA
$query20 = "SELECT Educ_lvl_idEduc_lvl FROM vacancies WHERE idVacancies = ?";
$query21 = "SELECT idUser, name_user, users.Educ_lvl_idEduc_lvl, user_has_region.Region_idRegion, user_has_areas.Areas_idAreas, capacities_has_users.capacities
            FROM users
            INNER JOIN user_has_region ON users.idUser = user_has_region.User_idUser_region
            INNER JOIN user_has_areas ON users.idUser = user_has_areas.User_idUser
            INNER JOIN capacities_has_users ON users.idUser = capacities_has_users.users_idUser
            WHERE User_type_idUser_type = 10
            AND Areas_idAreas IN (SELECT Areas_idAreas FROM vacancies WHERE idVacancies = ?)
            AND user_has_region.Region_idRegion IN (SELECT Region_idRegion FROM vacancies WHERE idVacancies = ?)
            AND capacities IN (SELECT capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?)
            AND users.Educ_lvl_idEduc_lvl >= ?";
$query30 = "SELECT vacancie_name FROM vacancies WHERE idVacancies = ?";
 
$query31 = "SELECT name_user FROM users
            WHERE idUser = ?";
$query32 = "INSERT INTO notifications(text_noti, User_idUser) VALUES (?,?)";
$nome_jovem = [];
$capacidades_jovens = [];
$capacidades_vaga = [];
if (mysqli_stmt_prepare($stmt3, $query20)) {
    mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $Educ_lvl_idEduc_lvl_young);
    if (mysqli_stmt_fetch($stmt3)) {
 
        if (mysqli_stmt_prepare($stmt4, $query21)) {
            mysqli_stmt_bind_param($stmt4, 'iiii', $idVacancies, $idVacancies, $idVacancies, $Educ_lvl_idEduc_lvl_young);
 
            mysqli_stmt_execute($stmt4);
            mysqli_stmt_bind_result($stmt4, $idUser, $name_user, $Educ_lvl, $region, $areas, $capacities_match);
            while (mysqli_stmt_fetch($stmt4)) {
                if ($capacidades_jovens[$idUser] === NULL) {
                    $capacidades_jovens[$idUser] = [];
                }
                if (!in_array($capacities_match, $capacidades_jovens[$idUser])) {
                    array_push($capacidades_jovens[$idUser], $capacities_match);
                }
            }
            /* close statement */
            mysqli_stmt_close($stmt4);
        }
    }
    if (mysqli_stmt_prepare($stmt3, $query30)) {
        mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $vacancie_name);
        if (mysqli_stmt_fetch($stmt3)) {
            if ($nome_jovem[$idUser] === NULL) {
                $nome_jovem[$idUser] = [];
            }
            if (!in_array($nome_jovem, $nome_jovem[$idUser])) {
                array_push($nome_jovem[$idUser], $vacancie_name);
            }
        }
    }
 
    /* close statement */
    mysqli_stmt_close($stmt3);
}
 
 
$query22 = "SELECT vacancies_idVacancies, capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";
$stmt3 = mysqli_stmt_init($link3);
if (mysqli_stmt_prepare($stmt3, $query22)) {
    mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $vacancies_idVacancies, $capacities_idcapacities);
    while (mysqli_stmt_fetch($stmt3)) {
        if ($capacidades_vaga[$vacancies_idVacancies] === NULL) {
            $capacidades_vaga[$vacancies_idVacancies] = [];
        }
        if (!in_array($capacities_idcapacities, $capacidades_vaga[$vacancies_idVacancies])) {
            array_push($capacidades_vaga[$vacancies_idVacancies], $capacities_idcapacities);
        }
    }
    /* close statement */
    mysqli_stmt_close($stmt3);
}
 
//inserir quando dá match/percurso
$query23 = "INSERT INTO user_has_vacancies (User_young, Vacancies_idVacancies, match_perc) VALUES (?, ?, ?)";
//inserir capacidades para o percurso
$query24 = "INSERT INTO learning_path_capacities (fk_match_vac, missing_learn) VALUES (?, ?)";
//verificar o que existe na tabela do match com a VAGA
$query25 = "SELECT User_young, Vacancies_idVacancies, login_comp FROM user_has_vacancies WHERE User_young = ? AND Vacancies_idVacancies = ?";
 
 
$vagas = $capacidades_jovens;
foreach ($capacidades_vaga as $vaga => $capacidades) {
    foreach ($capacidades_jovens as $jovem => $cap_jovem) {
        $vagas[$jovem] = array_diff($capacidades, $cap_jovem);
        /* echo count($vagas[$jovem]);
        echo "<pre>" . print_r($vagas[$jovem], true) . "</pre>"; */
        //verificação do que é (match/percurso/não match)
        if (count($vagas[$jovem]) <= 1) {
            //            echo "match!";
            //            echo "<br> jovem: $jovem";
            //            echo "<br>";
            /***********/
            //Verificar se já existe alguma coisa inserida
            if (mysqli_stmt_prepare($stmt5, $query25)) {
                mysqli_stmt_bind_param($stmt5, 'ii', $jovem, $vacancies_idVacancies);
 
                mysqli_stmt_execute($stmt5);
                mysqli_stmt_bind_result($stmt5, $User_young, $fk_idVacancies, $login_comp);
                if (mysqli_stmt_fetch($stmt5)) {
                    //echo "match já existe <br>";
                } else {
                    //echo "match ainda não existe vai inserir <br>";
                    $match_vac = 1;
                    //insere os dados que faz match
                    $stmt4 = mysqli_stmt_init($link4);
                    if (mysqli_stmt_prepare($stmt4, $query23)) {
                        mysqli_stmt_bind_param($stmt4, 'iii', $jovem, $vacancies_idVacancies, $match_vac);
 
                        // VALIDAÇÃO DO RESULTADO DO EXECUTE
                        if (!mysqli_stmt_execute($stmt4)) {
                            echo "Error: " . mysqli_stmt_error($stmt4);
                        } else {
                            //echo "match feito <br>";
 
                            //mysqli_stmt_close($stmt4);
                        }
                    } else {
                        // ERROR ACTION
                        echo "Error: " . mysqli_stmt_error($stmt4);
                    }
                }
                //noti
                if (mysqli_stmt_prepare($stmt6, $query31)) {
                    mysqli_stmt_bind_param($stmt6, 'i', $idComp);
                    mysqli_stmt_execute($stmt6);
                    mysqli_stmt_bind_result($stmt6, $name_comp);
                    if (mysqli_stmt_fetch($stmt6)) {
                        if ($login_comp == 0) {
                            $text = "Parabéns " . $name_comp . ", tem uma nova ligação com o " . $name_user . " na vaga " . $vacancie_name . ".";
                            //echo "$text";
                            //Insere a notificação
                            if (mysqli_stmt_prepare($stmt6, $query32)) {
                                mysqli_stmt_bind_param($stmt6, 'si', $text, $idComp);
                                mysqli_stmt_execute($stmt6);
                                if (!mysqli_stmt_execute($stmt6)) {
                                    echo "Error: " . mysqli_stmt_error($stmt6);
                                } else {
                                    //echo "inseriu";
                                }
                            }
                        }
                    }
                }
 
                $query32 = "UPDATE user_has_vacancies
                                            SET login_comp = 1
                                            WHERE User_young = ? AND Vacancies_idVacancies = ?";
                if (mysqli_stmt_prepare($stmt5, $query32)) {
                    mysqli_stmt_bind_param($stmt5, 'ii', $jovem, $vacancies_idVacancies);
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt5)) {
                        echo "Error: " . mysqli_stmt_error($stmt5);
                    }
                }
 
                /* close statement */
               // mysqli_stmt_close($stmt5);
            }
 
 
 
 
            /******************/
        } else if (count($vagas[$jovem]) == 2 || count($vagas[$jovem]) == 3) {
            //            echo "percurso";
            //            echo "<br> jovem: $jovem";
            //            echo "<br>";
            /***********/
            //Verificar se já existe alguma coisa inserida
            $stmt5 = mysqli_stmt_init($link5);
            if (mysqli_stmt_prepare($stmt5, $query25)) {
                mysqli_stmt_bind_param($stmt5, 'ii', $jovem, $vacancies_idVacancies);
 
                mysqli_stmt_execute($stmt5);
                mysqli_stmt_bind_result($stmt5, $User_young, $fk_idVacancies, $login_comp);
                if (mysqli_stmt_fetch($stmt5)) {
                    //echo "match já existe <br>";
                } else {
                    //echo "match ainda não existe vai inserir <br>";
                    $percurso = 0;
                    //insere os dados que faz o percurso
                    $stmt4 = mysqli_stmt_init($link4);
                    if (mysqli_stmt_prepare($stmt4, $query23)) {
                        mysqli_stmt_bind_param($stmt4, 'iii', $jovem, $vacancies_idVacancies, $percurso);
 
                        // VALIDAÇÃO DO RESULTADO DO EXECUTE
                        if (!mysqli_stmt_execute($stmt4)) {
                            echo "Error: " . mysqli_stmt_error($stmt4);
                        } else {
                            //echo "percurso feito <br>";
                            $id_percurso = mysqli_insert_id($link4);
 
                            //echo "ID depois de inserir o percurso: " . "$id_percurso <br>";
                            // SUCCESS ACTION
                            //mysqli_stmt_close($stmt4);
                        }
                    } else {
                        // ERROR ACTION
                        echo "Error: " . mysqli_stmt_error($stmt4);
                    }
                    //insere os dados das capacidades que faltam
                    $stmt4 = mysqli_stmt_init($link4);
                    if (mysqli_stmt_prepare($stmt4, $query24)) {
                        mysqli_stmt_bind_param($stmt4, 'ii', $id_percurso, $id_capacidades);
                        //para todas as capacidades sem match
                        foreach ($vagas[$jovem] as $id_capacidades) {
                            //echo "id da cpacidade sem match: $id_capacidades<br>";
                            /* execute the prepared statement */
                            if (!mysqli_stmt_execute($stmt4)) {
                                //ERRO
                                echo "Error: " . mysqli_stmt_error($stmt);
                            } else {
                                //echo "capacidades inseridas do percurso <br>";
                                // SUCCESS ACTION
 
 
                            }
                        }
                    } else {
                        // ERROR ACTION
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
                if (mysqli_stmt_prepare($stmt6, $query31)) {
                    mysqli_stmt_bind_param($stmt6, 'i', $idComp);
                    mysqli_stmt_execute($stmt6);
                    mysqli_stmt_bind_result($stmt6, $name_comp);
                    if (mysqli_stmt_fetch($stmt6)) {
                        //noti
                        if ($login_comp == 0) {
                            $text = "Parabéns ". $name_comp.", foi criado um novo percurso com o " . $name_user . " na vaga " . $vacancie_name . ".";
                            //echo "$text";
                            //Insere a notificação
                            if (mysqli_stmt_prepare($stmt6, $query32)) {
                                mysqli_stmt_bind_param($stmt6, 'si', $text, $idComp);
                                mysqli_stmt_execute($stmt6);
                                if (!mysqli_stmt_execute($stmt6)) {
                                    echo "Error: " . mysqli_stmt_error($stmt6);
                                } else {
                                    //echo "inseriu";
                                }
                            }
                        }
                    }
                }
                $query32 = "UPDATE user_has_vacancies
                                            SET login_comp = 1
                                            WHERE User_young = ? AND Vacancies_idVacancies = ?";
                if (mysqli_stmt_prepare($stmt5, $query32)) {
                    mysqli_stmt_bind_param($stmt5, 'ii', $jovem, $vacancies_idVacancies);
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt5)) {
                        echo "Error: " . mysqli_stmt_error($stmt5);
                    }
                }
            }
 
 
            /******************/
        } else if (count($vagas[$jovem]) >= 4) {
            //            echo "não tem match";
            //            echo "<br> jovem: $jovem";
            //            echo "<br>";
        }
    }
}
 
 
/*
echo "<pre>" . print_r($capacidades_vaga, true) . "</pre>";
echo "<pre>" . print_r($capacidades_vaga, true) . "</pre>"; */