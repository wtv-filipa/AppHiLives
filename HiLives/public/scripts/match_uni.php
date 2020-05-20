<?php
//require_once("../connections/connection.php");
//MATCH COM A UNIVERSIDADE NO REGISTO
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);
//MATCH

$query8 = "INSERT INTO young_university (User_young, User_university, Area) VALUES (?, ?, ?)";
//Esta query vai fazr um select dos users que são universidades e ao mesmo tempo já os relaciona com os jovens que têm a mesma àrea
$query9 = "SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area, name_region FROM user_has_areas INNER JOIN users ON user_has_areas.User_idUser = users.idUser INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas INNER JOIN user_has_region ON user_has_region.User_idUser_region = users.idUser INNER JOIN region ON region.idRegion = user_has_region.Region_idRegion WHERE User_type_idUser_type = 13 AND Areas_idAreas IN (SELECT Areas_idAreas FROM user_has_areas WHERE user_has_areas.User_idUser = ? ) AND Region_idRegion IN (SELECT Region_idRegion FROM user_has_region WHERE user_has_region.User_idUser_region= ?)";

//prepare da query que seleciona o que está em comum
if (mysqli_stmt_prepare($stmt3, $query9)) {
    mysqli_stmt_bind_param($stmt3, 'ii', $last_id, $last_id);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $idUser, $Areas_idAreas, $User_type_idUser_type, $name_interested_area);
    while (mysqli_stmt_fetch($stmt3)) {
        //Faz o prepare da query2 que é a que vai inserir os dados
        if (mysqli_stmt_prepare($stmt4, $query8)) {
            mysqli_stmt_bind_param($stmt4, 'iis', $last_id, $idUser, $name_interested_area);

            // VALIDAÇÃO DO RESULTADO DO EXECUTE
            if (!mysqli_stmt_execute($stmt4)) {
                echo "Error: " . mysqli_stmt_error($stmt4);
            } else {
                echo "match feito <br>";
                // SUCCESS ACTION
                //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");
            }
        } else {
            // ERROR ACTION
            //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
            //mysqli_close($link);
        }
    }
}
/***********************************************/
