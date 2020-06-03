<?php

if (isset($_GET["apaga"])) {
    $idUser = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);
    //verificar que tipo de user é
    $query7 = "SELECT type_user FROM user_type INNER JOIN users ON user_type.idUser_type = users.User_type_idUser_type WHERE idUser = ?";
    /********************************************************* */
    //apagar das areas
    $query = "DELETE FROM user_has_areas WHERE User_idUser = ?";
    //apagar da região
    $query2 = "DELETE FROM user_has_region WHERE User_idUser_region = ?";
    //apagar das capacidades
    $query3 = "DELETE FROM capacities_has_users WHERE users_idUser = ?";
    //apagar dos ambientes
    $query8 = "DELETE FROM work_environment_has_users WHERE users_idUser = ?";
    //apagar user
    $query4 = "DELETE FROM users WHERE idUser = ?";
    //apagar match com UNI
    $query5 = "DELETE FROM young_university WHERE User_young = ?";
    //verificar o que existe na tabela do match
    $query6 = "SELECT User_young, User_university, Area FROM young_university WHERE User_young = ?";
    //apagar match com EMP
    $query9 = "DELETE FROM user_has_vacancies WHERE User_young = ?";
    //verificar o que existe na tabela do match da vaga
    $query10 = "SELECT User_young, Vacancies_idVacancies FROM user_has_vacancies WHERE User_young = ?";
    //apagar UC feita
    $query11 = "DELETE FROM done_CU WHERE User_idUser = ?";
    //apagar experiências
    $query12 = "DELETE FROM experiences WHERE Content_idContent = ?";
    //apagar content
    $query13 = "DELETE FROM content WHERE idContent = ?";
    //verificar se existem XP
    $query14 = "SELECT idExperiences FROM experiences WHERE User_idUser = ?";
    //verificar se existe algum content
    $query15 = "SELECT idContent FROM content WHERE users_idUser = ?";

    if (mysqli_stmt_prepare($stmt2, $query7)) {

        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2, $type_user);
        while (mysqli_stmt_fetch($stmt2)) {
            if ($type_user == "Jovem") {
                echo "apagar jovem";
                //PRIMEIRA QUERY- APAGAR DA RELAÇÃO COM AS AREAS
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);


                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {

                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "erro";
                    //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                }
                //SEGUNDA QUERY- APAGAR A RELAÇÃO COM AS REGIÕES
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);


                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {

                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "erro";
                    //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                }
                //TERCEIRA QUERY- APAGAR DA RELAÇÃO COM AS CAPACIDADES
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query3)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);


                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {

                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "erro";
                    //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                }
                //OITAVA QUERY- APAGAR A RELAÇÃO COM OS AMBIENTES DE TRABALHO
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query8)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);


                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {

                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "erro";
                    //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                }
                //DECIMA PRIMEIRA QUERY- APAGAR AS UCS JÁ FEITAS
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query11)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);


                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {

                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "erro";
                    //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                }
                //QUARTA QUERY- APAGAR DA TABELA DOS USERS
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query4)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);


                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt)) {

                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "erro";
                    //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                }

                //Verificar se já existe alguma coisa inserida na tabela do match entre universidade e jovem e só faz a query de apagar se existir
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query6)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $User_young, $User_university, $Area);
                    if (mysqli_stmt_fetch($stmt)) {
                        echo "areas já inseridas <br>";
                        //QUINTA QUERY
                        $stmt = mysqli_stmt_init($link);
                        if (mysqli_stmt_prepare($stmt, $query9)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt)) {
                                //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                                echo "Error: " . mysqli_stmt_error($stmt);
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            echo "erro";
                            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        }
                    } else {
                        echo "areas ainda não inseridas <br>";
                    }
                }

                //Verificar se já existe alguma coisa inserida na tabela do match entre VAGA e jovem e só faz a query de apagar se existir
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query10)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $User_young, $Vacancies_idVacancies);
                    if (mysqli_stmt_fetch($stmt)) {
                        echo "Match com a vaga <br>";
                        //QUINTA QUERY
                        $stmt = mysqli_stmt_init($link);
                        if (mysqli_stmt_prepare($stmt, $query5)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt)) {
                                //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                                echo "Error: " . mysqli_stmt_error($stmt);
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            echo "erro";
                            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        }
                    } else {
                        echo "Ainda não existiam match com vagas <br>";
                    }
                }

                //Verificar se já existe alguma coisa inserida na tabela das XP
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query14)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $idExperiences);
                    if (mysqli_stmt_fetch($stmt)) {
                        echo "XP inseridas <br>";
                        //QUINTA QUERY
                        $stmt = mysqli_stmt_init($link);
                        if (mysqli_stmt_prepare($stmt, $query12)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt)) {
                                //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                                echo "Error: " . mysqli_stmt_error($stmt);
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            echo "erro";
                            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        }
                    } else {
                        echo "ainda não existiam XP <br>";
                    }
                }

                //Verificar se já existe alguma coisa inserida na tabela dos VIDEOS
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query15)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $idContent);
                    if (mysqli_stmt_fetch($stmt)) {
                        echo "existem conteudos <br>";
                        //QUINTA QUERY
                        $stmt = mysqli_stmt_init($link);
                        if (mysqli_stmt_prepare($stmt, $query13)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt)) {
                                //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                                echo "Error: " . mysqli_stmt_error($stmt);
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            echo "erro";
                            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                        }
                    } else {
                        echo "ainda não existiam conteudos <br>";
                    }
                    mysqli_close($link);
                    echo "utilizador apagado com sucesso";
                    //header("Location:../index.php");
                    /**********************************************************************/
                } else if ($type_user == "Empresa") {
                    echo "apagar empresa";
                    /*********************************************************************/
                } else if ($type_user == "Universidade") {
                    echo "apagar universidade";
                    //PRIMEIRA QUERY- APAGAR A RELAÇÃO COM AREAS
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);


                        // VALIDAÇÃO DO RESULTADO DO EXECUTE
                        if (!mysqli_stmt_execute($stmt)) {

                            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "erro";
                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                    }
                    //SEGUNDA QUERY- APAGAR RELAÇÃO COM REGIÕES
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);


                        // VALIDAÇÃO DO RESULTADO DO EXECUTE
                        if (!mysqli_stmt_execute($stmt)) {

                            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "erro";
                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                    }
                    //QUARTA QUERY- APAGAR DA TABELA DOS USERS
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query4)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);


                        // VALIDAÇÃO DO RESULTADO DO EXECUTE
                        if (!mysqli_stmt_execute($stmt)) {

                            //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "erro";
                        //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                    }

                    //Verificar se já existe alguma coisa inserida na tabela do match entre universidade e jovem e só faz a query de apagar se existir
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query6)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $User_young, $User_university, $Area);
                        if (mysqli_stmt_fetch($stmt)) {
                            echo "areas já inseridas <br>";
                            //QUINTA QUERY
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query9)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                if (!mysqli_stmt_execute($stmt)) {
                                    //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                                    echo "Error: " . mysqli_stmt_error($stmt);
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                echo "erro";
                                //header("Location: ../comentarios.php?id_g=$id_f&msg=0");
                            }
                        } else {
                            echo "areas ainda não inseridas <br>";
                        }
                    }
                }
            }
        }
    }
}
