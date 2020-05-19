<?php
require_once("../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
//MATCH
                    $query3 = "SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area FROM user_has_areas 
                                INNER JOIN users ON user_has_areas.User_idUser = users.idUser 
                                INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas WHERE User_type_idUser_type LIKE 13 OR User_idUser= ?";
                    $query2 = "INSERT INTO young_university (User_young, User_university, Area) VALUES (?, ?, ?)";

                    $query1 ="SELECT User_idUser, Areas_idAreas, User_type_idUser_type, name_interested_area FROM user_has_areas INNER JOIN users ON user_has_areas.User_idUser = users.idUser INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas WHERE User_type_idUser_type = 13 AND Areas_idAreas IN (SELECT Areas_idAreas FROM user_has_areas WHERE user_has_areas.User_idUser = 2)";

                    if (mysqli_stmt_prepare($stmt, $query1)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $User_idUser, $Areas_idAreas, $User_type_idUser_type, $name_interested_area);
                        //$array_jovem = array();
                        while (mysqli_stmt_fetch($stmt)) {

                            /*Array que guarda todas as areas dos jovens e uni*/
                            //array_push($array_jovem, $Areas_idAreas);
                            //var_dump($array_jovem);
                            echo "<br>";
                            /*Deteta areas iguais = match!*/
                            //$respostas_iguais = array_count_values($array_jovem);

                            //var_dump($respostas_iguais);
//                            foreach ($respostas_iguais as $value) {
//                                    if ($value > 1) {
//                                        if (mysqli_stmt_prepare($stmt, $query2)) {
//                                            if ($User_idUser != $idUser) {
//                                                mysqli_stmt_bind_param($stmt, 'iis', $idUser, $User_idUser, $name_interested_area);
//                                            }
//                                            echo "<br>FEZ O MATCH<br>";
//                                            if (!mysqli_stmt_execute($stmt)) {
//                                                echo "Error: " . mysqli_stmt_error($stmt);
//                                            }
//                                            /* close statement */ mysqli_stmt_close($stmt);
//                                        }
//                                    } else{
//                                        echo "não estamos a inserir :( <br>";
//                                    }
//                                echo "Value: $value<br>";
//                            }
                        }
                    }
                    /***********************************************/