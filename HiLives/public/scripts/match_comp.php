<?php
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);


$query23 = "INSERT INTO user_has_vacancies (User_young, Vacancies_idVancancies) VALUES (?, ?)";


//MATCH COM REGIAO, CAPACIDADES, ESCOLARIDADE, AREA
$query20 = "SELECT Educ_lvl_idEduc_lvl FROM users WHERE idUser = ?";
$query21= "SELECT idVacancies, vacancies.Region_idRegion, User_publicou, vacancies.Educ_lvl_idEduc_lvl, Areas_idAreas, capacities_idcapacities FROM vacancies
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


if (mysqli_stmt_prepare($stmt2, $query20)) {
    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result($stmt2, $Educ_lvl_idEduc_lvl_young);
    if (mysqli_stmt_fetch($stmt2)) {

        if (mysqli_stmt_prepare($stmt3, $query21)) {
            mysqli_stmt_bind_param($stmt3, 'iii', $idUser, $idUser, $idUser);

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $idVacancies, $Region_idRegion, $User_publicou, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $capacities_idcapacities_match);
            if (mysqli_stmt_fetch($stmt3)) {

                $query22 = "SELECT vacancies_idVacancies, capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";

                if (mysqli_stmt_prepare($stmt2, $query22)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancies);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $vacancies_idVacancies, $capacities_idcapacities);
                    while (mysqli_stmt_fetch($stmt2)) {
                        echo "<br>Idvaga: $vacancies_idVacancies";
                        echo "<br>vaga: $capacities_idcapacities";

                        echo "<br>match: $capacities_idcapacities_match";

                    }
                }
            }
        }
    }
}
