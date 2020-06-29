<?php
//ESTE MATCH (UNIVERSIDADE) É PARA QUANDO O UTILIZADOR JÁ EXISTE E PRETENDEMOS VERIFICAR SE JÁ TEM TODOS OS MATCH FEITOS OU NÃO (PODE SER COLOCADO NO LOGIN, OU NO UPDATE DO PERFIL)
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);
$link5 = new_db_connection();
$stmt5 = mysqli_stmt_init($link5);
//MATCH

$query8 = "INSERT INTO young_university (User_young, User_university, Area) VALUES (?, ?, ?)";
//Esta query vai fazr um select dos users que são universidades e ao mesmo tempo já os relaciona com os jovens que têm a mesma àrea
$query9 = "SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area, name_region FROM user_has_areas 
INNER JOIN users ON user_has_areas.User_idUser = users.idUser 
INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas 
INNER JOIN user_has_region ON user_has_region.User_idUser_region = users.idUser 
INNER JOIN region ON region.idRegion = user_has_region.Region_idRegion 
WHERE User_type_idUser_type = 13 
AND Areas_idAreas IN (SELECT Areas_idAreas FROM user_has_areas WHERE user_has_areas.User_idUser = ? ) 
AND Region_idRegion IN (SELECT Region_idRegion FROM user_has_region WHERE user_has_region.User_idUser_region= ?)";
//verificar o que existe na tabela do match
$query10 = "SELECT User_young, User_university, Area FROM young_university WHERE User_young = ? AND User_university = ? AND Area = ?";

//prepare da query que seleciona o que está em comum
if (mysqli_stmt_prepare($stmt3, $query9)) {
    mysqli_stmt_bind_param($stmt3, 'ii', $idUser, $idUser);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $User_idUser, $Areas_idAreas, $User_type_idUser_type, $name_interested_area, $name_region);
    while (mysqli_stmt_fetch($stmt3)) {
        echo "$name_interested_area<br>";
        //Verificar se já existe alguma coisa inserida
        if (mysqli_stmt_prepare($stmt5, $query10)) {
            mysqli_stmt_bind_param($stmt5, 'iis', $idUser, $User_idUser, $name_interested_area);

            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $User_university, $Area);
            if (mysqli_stmt_fetch($stmt5)) {
                //echo "areas já inseridas <br>";
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
                    }
                } else {
                    // ERROR ACTION
                    //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
                    //mysqli_close($link);
                }
                echo "areas ainda não inseridas <br>";
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
$query21 = "SELECT idVacancies, vacancies.Region_idRegion, User_publicou, vacancies.Educ_lvl_idEduc_lvl, Areas_idAreas, capacities_idcapacities FROM vacancies
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

//inserir quando dá match/percurso
$query23 = "INSERT INTO user_has_vacancies (User_young, Vacancies_idVacancies, match_perc) VALUES (?, ?, ?)";
//inserir capacidades para o percurso
$query24 = "INSERT INTO learning_path_capacities (fk_match_vac, missing_learn) VALUES (?, ?)";

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
            mysqli_stmt_bind_result($stmt3, $idVacancies, $Region_idRegion, $User_publicou, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $capacities_idcapacities_match);
            while (mysqli_stmt_fetch($stmt3)) {
                //                echo "<br>IDVAGA: $idVacancies ____ Nível de educação: $Educ_lvl_idEduc_lvl";
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
                        //array capacidades jovem (que já fazem match)
                        if (!in_array($capacities_idcapacities_match, $capacidades_jovem)) {
                            array_push($capacidades_jovem, $capacities_idcapacities_match);
                        }
                        //match
                        //vagas= capacidades todas dentro da vaga aka key

                        /* echo "<br>idvaga_primeiro: $idVacancies";
                        echo "<br>idvaga: $vacancies_idVacancies";
                        echo "<br>vaga: $capacities_idcapacities";
                        echo "<br>match: $capacities_idcapacities_match<br>"; */

                        //                        $search_val = in_array($capacities_idcapacities, $capacidades_match);
                        //                        echo "<br>PROCURA: $search_val";
                        //                        if ($search_val == false) {
                        //                            //echo "REGIÃO NÃO EXISTE NO ARRAY! <br>";
                        //                            echo "<br>$vacancies_idVacancies";
                        //                            echo "<br>Capacidades da vaga: $capacities_idcapacities";
                        //
                        //                        }
                    }
                    foreach ($capacidades_match as $key => $vagas) {
                        $capacidades_matched = array();
                        $capacidades_not_matched = array();
                        foreach ($vagas as $capacidades) {

                            if (in_array($capacidades, $capacidades_jovem)) {
                                array_push($capacidades_matched, $capacidades);
                            } else {
                                array_push($capacidades_not_matched, $capacidades);
                            }
                        }
                    } //fim do primeiro foreach
                    if (count($capacidades_not_matched) <= 1) {
                        # MATCH! :)
                        echo "match!";
                        echo "<br> vaga: $key";
                        echo "<br>";
                    } else  if (count($capacidades_not_matched) == 2 || count($capacidades_not_matched) == 3) {

                        # programa de aprendizagem
                        echo "percurso";
                        echo "<br> vaga: $key";
                        echo "<br>";
                    } else if (count($capacidades_not_matched) >= 4) {
                        echo "não tem match";
                        echo "<br> vaga: $key";
                        echo "<br>";
                        /***********************************/
                    }

                    /*  print_r($capacidades_match); */
                }
            }
        }
    }
}
