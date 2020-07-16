<?php

$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);
$link5 = new_db_connection();
$stmt5 = mysqli_stmt_init($link5);
$link6 = new_db_connection();
$stmt6 = mysqli_stmt_init($link6);

$query8 = "INSERT INTO young_university (User_young, User_university, Area) VALUES (?, ?, ?)";
 
$query9 = "SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area, name_region FROM user_has_areas
INNER JOIN users ON user_has_areas.User_idUser = users.idUser
INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas
INNER JOIN user_has_region ON user_has_region.User_idUser_region = users.idUser
INNER JOIN region ON region.idRegion = user_has_region.Region_idRegion
WHERE User_type_idUser_type = 13
AND Areas_idAreas IN (SELECT Areas_idAreas FROM user_has_areas WHERE user_has_areas.User_idUser = ? )
AND Region_idRegion IN (SELECT Region_idRegion FROM user_has_region WHERE user_has_region.User_idUser_region= ?)";

$query10 = "SELECT User_young, User_university, Area, login_young FROM young_university WHERE User_young = ? AND User_university = ? AND Area = ?";
 
$query12 = "INSERT INTO notifications(text_noti, User_idUser) VALUES (?,?)";
$query13 = "SELECT name_user FROM users
            WHERE idUser = ?";
 
$nome_uni = [];

if (mysqli_stmt_prepare($stmt3, $query9)) {
    mysqli_stmt_bind_param($stmt3, 'ii', $idUser, $idUser);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $User_idUser, $Areas_idAreas, $User_type_idUser_type, $name_interested_area, $name_region);
    while (mysqli_stmt_fetch($stmt3)) {
        if (mysqli_stmt_prepare($stmt5, $query10)) {
            mysqli_stmt_bind_param($stmt5, 'iis', $idUser, $User_idUser, $name_interested_area);
 
            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $User_university, $Area, $login_young);
            if (mysqli_stmt_fetch($stmt5)) {
                
                if ($login_young == 0) {
                    $query11 = "UPDATE young_university
                                    SET login_young = 1
                                    WHERE User_young = ? AND User_university = ? AND Area = ?";
                    if (mysqli_stmt_prepare($stmt6, $query11)) {
                        mysqli_stmt_bind_param($stmt6, 'iis', $idUser, $User_idUser, $name_interested_area);
                       
                        if (!mysqli_stmt_execute($stmt6)) {
                            
                        }
                    }
                }
            } else {
                
                if (mysqli_stmt_prepare($stmt4, $query8)) {
                    mysqli_stmt_bind_param($stmt4, 'iis', $idUser, $User_idUser, $name_interested_area);
 
                    if (!mysqli_stmt_execute($stmt4)) {
                       
                    } else {
                        $query11 = "UPDATE young_university
                                    SET login_young = 1
                                    WHERE User_young = ? AND User_university = ? AND Area = ?";
                        if (mysqli_stmt_prepare($stmt6, $query11)) {
                            mysqli_stmt_bind_param($stmt6, 'iis', $idUser, $User_idUser, $name_interested_area);
                        
                            if (!mysqli_stmt_execute($stmt6)) {
                               
                            }
                        }
                    }
                } else {
                   
                }
                
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
        mysqli_stmt_bind_result($stmt5, $name_uni);
        if (mysqli_stmt_fetch($stmt5)) {
            if (mysqli_stmt_prepare($stmt5, $query13)) {
                mysqli_stmt_bind_param($stmt5, 'i', $idUser);
                mysqli_stmt_execute($stmt5);
                mysqli_stmt_bind_result($stmt5, $name_jovem);
                if (mysqli_stmt_fetch($stmt5)) {
                    foreach ($areas as $area) {
                        
                        if ($login_young == 0) {
                            $text = "Parabéns " . $name_jovem . ", tens uma nova ligação na área " . $area . " com a " . $name_uni . ".";
                            
                            if (mysqli_stmt_prepare($stmt5, $query12)) {
                                mysqli_stmt_bind_param($stmt5, 'si', $text, $idUser);
                                mysqli_stmt_execute($stmt5);
                                if (!mysqli_stmt_execute($stmt5)) {
                                    
                                } 
                            }
                        }
                    }
                }
            }
        }
    }
}
 
/***********************************************/

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);
 

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
        
        if (mysqli_stmt_prepare($stmt3, $query21)) {
            mysqli_stmt_bind_param($stmt3, 'iiii', $idUser, $idUser, $idUser, $Educ_lvl_idEduc_lvl_young);
 
            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $idVacancies, $vacancie_name, $Region_idRegion, $User_publicou, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $capacities_idcapacities_match);
            while (mysqli_stmt_fetch($stmt3)) {
                
                if (!in_array($capacities_idcapacities_match, $capacidades_jovem)) {
                    array_push($capacidades_jovem, $capacities_idcapacities_match);
                }
                $query22 = "SELECT vacancies_idVacancies, capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";
 
                if (mysqli_stmt_prepare($stmt2, $query22)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancies);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $vacancies_idVacancies, $capacities_idcapacities);
                    while (mysqli_stmt_fetch($stmt2)) {
                        
                        if ($capacidades_match[$idVacancies] === NULL) {
                            $capacidades_match[$idVacancies] = [];
                        }
                        if (!in_array($capacities_idcapacities, $capacidades_match[$idVacancies])) {
                            array_push($capacidades_match[$idVacancies], $capacities_idcapacities);
                        }
                    } 
                } 
            } 
        }
        if ($nome_comp[$User_publicou] === NULL) {
            $nome_comp[$User_publicou] = [];
        }
        if (!in_array($nome_comp, $nome_comp[$User_publicou])) {
            array_push($nome_comp[$User_publicou], $vacancie_name);
        }
    } 
}

$query23 = "INSERT INTO user_has_vacancies (User_young, Vacancies_idVacancies, match_perc) VALUES (?, ?, ?)";

$query24 = "INSERT INTO learning_path_capacities (fk_match_vac, missing_learn) VALUES (?, ?)";

$query25 = "SELECT User_young, Vacancies_idVacancies, login_young FROM user_has_vacancies WHERE User_young = ? AND Vacancies_idVacancies = ?";
 
 
$capacidades_final = $capacidades_match;
foreach ($capacidades_match as $vaga => $capacidades) {
    $capacidades_final[$vaga] = array_diff($capacidades, $capacidades_jovem);
    
    if (count($capacidades_final[$vaga]) <= 1) {
      
        if (mysqli_stmt_prepare($stmt5, $query25)) {
            mysqli_stmt_bind_param($stmt5, 'ii', $idUser, $vaga);
 
            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $fk_idVacancies, $login_young_comp);
            if (mysqli_stmt_fetch($stmt5)) {
                
            } else {
               
                $match_vac = 1;
               
                if (mysqli_stmt_prepare($stmt4, $query23)) {
                    mysqli_stmt_bind_param($stmt4, 'iii', $idUser, $vaga, $match_vac);
 
                    if (!mysqli_stmt_execute($stmt4)) {
                        
                    } 
                } 
            }
            $query11 = "UPDATE user_has_vacancies
                                            SET login_young = 1
                                            WHERE User_young = ? AND Vacancies_idVacancies = ?";
            if (mysqli_stmt_prepare($stmt6, $query11)) {
                mysqli_stmt_bind_param($stmt6, 'ii', $idUser, $vaga);
               
                if (!mysqli_stmt_execute($stmt6)) {
                   
                }
            }
        }
 
        foreach ($nome_comp as $id => $vagas2) {
            if (mysqli_stmt_prepare($stmt5, $query13)) {
                mysqli_stmt_bind_param($stmt5, 'i', $id);
                mysqli_stmt_execute($stmt5);
                mysqli_stmt_bind_result($stmt5, $name_comp);
                if (mysqli_stmt_fetch($stmt5)) {
                    if (mysqli_stmt_prepare($stmt5, $query13)) {
                        mysqli_stmt_bind_param($stmt5, 'i', $idUser);
                        mysqli_stmt_execute($stmt5);
                        mysqli_stmt_bind_result($stmt5, $name_jovem);
                        if (mysqli_stmt_fetch($stmt5)) {
                            foreach ($vagas2 as $vaga2) {
                                if ($login_young_comp == 0) {
                                    $text = "Parabéns " . $name_jovem . ", tens uma nova ligação na vaga " . $vaga2 . " com a " . $name_comp . ".";
                                    
                                    if (mysqli_stmt_prepare($stmt5, $query12)) {
                                        mysqli_stmt_bind_param($stmt5, 'si', $text, $idUser);
                                        mysqli_stmt_execute($stmt5);
                                        if (!mysqli_stmt_execute($stmt5)) {
                                           
                                        } 
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
 
    } else if (count($capacidades_final[$vaga]) == 2 || count($capacidades_final[$vaga]) == 3) {
        
        if (mysqli_stmt_prepare($stmt5, $query25)) {
            mysqli_stmt_bind_param($stmt5, 'ii', $idUser, $vaga);
 
            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $fk_idVacancies, $login_young_comp);
            if (mysqli_stmt_fetch($stmt5)) {
               
            } else {
                $percurso = 0;
 
                if (mysqli_stmt_prepare($stmt4, $query23)) {
                    mysqli_stmt_bind_param($stmt4, 'iii', $idUser, $vaga, $percurso);
 
                    if (!mysqli_stmt_execute($stmt4)) {
                        
                    } else {
                        $id_percurso = mysqli_insert_id($link4);
                        
                    }
                } 
                
                if (mysqli_stmt_prepare($stmt4, $query24)) {
                    mysqli_stmt_bind_param($stmt4, 'ii', $id_percurso, $id_capacidades);
                   
                    foreach ($capacidades_final[$vaga] as $id_capacidades) {
                       
                        if (!mysqli_stmt_execute($stmt4)) {
                            
                        } 
                    }
                } 
            }
 
            $query11 = "UPDATE user_has_vacancies
                                            SET login_young = 1
                                            WHERE User_young = ? AND Vacancies_idVacancies = ?";
            if (mysqli_stmt_prepare($stmt6, $query11)) {
                mysqli_stmt_bind_param($stmt6, 'ii', $idUser, $vaga);
               
                if (!mysqli_stmt_execute($stmt6)) {
                   
                }
            }
        } 
        //noti
        foreach ($nome_comp as $id => $vagas2) {
            if (mysqli_stmt_prepare($stmt5, $query13)) {
                mysqli_stmt_bind_param($stmt5, 'i', $id);
                mysqli_stmt_execute($stmt5);
                mysqli_stmt_bind_result($stmt5, $name_comp);
                if (mysqli_stmt_fetch($stmt5)) {
                    if (mysqli_stmt_prepare($stmt5, $query13)) {
                        mysqli_stmt_bind_param($stmt5, 'i', $idUser);
                        mysqli_stmt_execute($stmt5);
                        mysqli_stmt_bind_result($stmt5, $name_jovem);
                        if (mysqli_stmt_fetch($stmt5)) {
                            foreach ($vagas2 as $vaga2) {
                                
                                if ($login_young_comp == 0) {
                                    $text = "Parabéns " . $name_jovem . ", tens um novo percurso na vaga " . $vaga2 . " com a " . $name_comp . ".";
                            
                                    //Insere a notificação
                                    if (mysqli_stmt_prepare($stmt5, $query12)) {
                                        mysqli_stmt_bind_param($stmt5, 'si', $text, $idUser);
                                        mysqli_stmt_execute($stmt5);
                                        if (!mysqli_stmt_execute($stmt5)) {
                                           
                                        } 
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
 
    } else if (count($capacidades_final[$vaga]) >= 4) {
        
    }
}
