<?php
//ESTE MATCH (ENTRE UNIVERSIDADES E JOVENS) É PARA QUANDO O UTILIZADOR (UNIVERSIDADE) JÁ EXISTE E PRETENDEMOS VERIFICAR SE JÁ TEM TODOS OS MATCH FEITOS OU NÃO (PODE SER COLOCADO NO LOGIN, OU NO UPDATE DO PERFIL)- SÓ PARA A UNIVERSIDADE!!!!!
$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);
$link4 = new_db_connection();
$stmt4 = mysqli_stmt_init($link4);
$link5 = new_db_connection();
$stmt5 = mysqli_stmt_init($link5);

//MATCH
$query17 = "INSERT INTO young_university (User_young, User_university, Area) VALUES (?, ?, ?)";
//Esta query vai fazr um select dos users que são jovens e ao mesmo tempo já os relaciona com as universidades que têm a mesma area
$query18 = "SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area, name_region FROM user_has_areas 
INNER JOIN users ON user_has_areas.User_idUser = users.idUser 
INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas 
INNER JOIN user_has_region ON user_has_region.User_idUser_region = users.idUser 
INNER JOIN region ON region.idRegion = user_has_region.Region_idRegion 
WHERE User_type_idUser_type = 10 
AND Areas_idAreas IN (SELECT Areas_idAreas FROM user_has_areas WHERE user_has_areas.User_idUser = ? ) 
AND Region_idRegion IN (SELECT Region_idRegion FROM user_has_region WHERE user_has_region.User_idUser_region= ?)";
//verificar o que existe na tabela do match
$query19 = "SELECT User_young, User_university, Area, login_uni FROM young_university WHERE User_young = ? AND User_university = ? AND Area = ?";


$query20 = "INSERT INTO notifications(text_noti, User_idUser) VALUES (?,?)";
$query21 = "SELECT name_user FROM users
            WHERE idUser = ?";

$nome_jovem = [];
//prepare da query que seleciona o que está em comum
if (mysqli_stmt_prepare($stmt3, $query18)) {
    mysqli_stmt_bind_param($stmt3, 'ii', $idUser, $idUser);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $User_idUser, $Areas_idAreas, $User_type_idUser_type, $name_interested_area, $name_region);
    while (mysqli_stmt_fetch($stmt3)) {
        //echo "$name_interested_area<br>";
        //Verificar se já existe alguma coisa inserida
        if (mysqli_stmt_prepare($stmt5, $query19)) {
            mysqli_stmt_bind_param($stmt5, 'iis', $User_idUser, $idUser, $name_interested_area);

            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $User_young, $User_university, $Area, $login_uni);
            if (mysqli_stmt_fetch($stmt5)) {
                //echo "areas já inseridas <br>";

                if($login_uni == 0) {
                    $query23 = "UPDATE young_university
                                    SET login_uni = 1
                                    WHERE User_young = ? AND User_university = ? AND Area = ?";
                    if (mysqli_stmt_prepare($stmt4, $query23)) {
                        mysqli_stmt_bind_param($stmt4, 'iis',$User_idUser, $idUser, $name_interested_area);
                        /* execute the prepared statement */
                        if (!mysqli_stmt_execute($stmt4)) {
                            echo "Error: " . mysqli_stmt_error($stmt4);
                        }
                    }
                }


            } else {
                //Faz o prepare da query2 que é a que vai inserir os dados
                if (mysqli_stmt_prepare($stmt4, $query17)) {
                    mysqli_stmt_bind_param($stmt4, 'iis', $User_idUser, $idUser, $name_interested_area);

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt4)) {
                        echo "Error: " . mysqli_stmt_error($stmt4);
                    } else {
//                        echo "match feito <br>";
//                        echo "JOVEM: $User_idUser";
//                        echo "UNI: $idUser";
                        // SUCCESS ACTION
                        //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");
                        $query23 = "UPDATE young_university
                                    SET login_uni = 1
                                    WHERE User_young = ? AND User_university = ? AND Area = ?";
                        if (mysqli_stmt_prepare($stmt4, $query23)) {
                            mysqli_stmt_bind_param($stmt4, 'iis',$User_idUser, $idUser, $name_interested_area);
                            /* execute the prepared statement */
                            if (!mysqli_stmt_execute($stmt4)) {
                                echo "Error: " . mysqli_stmt_error($stmt4);
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
        if ($nome_jovem[$User_idUser] === NULL) {
            $nome_jovem[$User_idUser] = [];
        }
        if (!in_array($nome_jovem, $nome_jovem[$User_idUser])) {
            array_push($nome_jovem[$User_idUser], $name_interested_area);
        }
    }
}



//noti
foreach ($nome_jovem as $id => $areas) {
    if (mysqli_stmt_prepare($stmt5, $query21)) {
        mysqli_stmt_bind_param($stmt5, 'i', $id);
        mysqli_stmt_execute($stmt5);
        mysqli_stmt_bind_result($stmt5, $name_user_jovem);
        if (mysqli_stmt_fetch($stmt5)) {

            foreach ($areas as $area) {
                if ($login_uni == 0) {
                    $text = "Tens uma nova ligação com " . $name_user_jovem . " na área " . $area . ".";
                    echo "$text<br>";
//                    echo "$login_young";
                    //Insere a notificação
                    if (mysqli_stmt_prepare($stmt5, $query20)) {
                        mysqli_stmt_bind_param($stmt5, 'si', $text, $idUser);
                        mysqli_stmt_execute($stmt5);
                        if (!mysqli_stmt_execute($stmt5)) {
                            //echo "Error: " . mysqli_stmt_error($stmt5);
                        } else {
                            echo "inseriu";
                        }
                    }
                }
            }
        }
    }
}
/***********************************************/