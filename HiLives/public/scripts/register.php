<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["data_nasc"]) && isset($_POST["def"]) && isset($_POST["password"])) {

    $type = 10;

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, info_young, work_xp, password, User_type_idUser_type, Educ_lvl_idEduc_lvl) VALUES (?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssii', $name, $email, $contact_user, $birth_date, $info_young, $work_xp, $password_hash, $User_type_idUser_type, $Educ_lvl_idEduc_lvl);

        $name = $_POST['nome'];
        $email = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_nasc'];
        $info_young = $_POST['def'];
        $work_xp = $_POST["work"];
        $Educ_lvl_idEduc_lvl = $_POST["esc"];
        $User_type_idUser_type = $type;
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            //echo "ESTÁ NA BD <br>";

            //INSERIR REGIAO
            if (isset($_POST["regiao"])) {

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query1 = "SELECT MAX(idUser) FROM users";

                if (mysqli_stmt_prepare($stmt, $query1)) {
                    /* execute the prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $idUser);

                        /* fetch values */
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "id do user: $idUser <br>";
                            $query2 = "INSERT INTO user_has_region (User_idUser, Region_idRegion)
                  VALUES (?, ?)";
                            //parte do insert
                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                echo "id do user: $idUser <br>";

                                mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);
                                echo "id da região: $idRegion<br>";
                                // PARA TODOS OS JOGADORES QUE FORAM ESCOLHIDOS
                                foreach ($_POST["regiao"] as $idRegion) {
                                    echo "id da região: $idRegion<br>";
                                    /* execute the prepared statement */
                                    if (!mysqli_stmt_execute($stmt)) {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                }
                                /* close statement */
                                mysqli_stmt_close($stmt);
                            }
                            //fim da cena do insert
                        }
                    }
                }
            } else {
                ///isto é do isset
                echo "ERRO de não temos nada inserido";
                // header("Location: ../register.php?msg=2");
            }

            //INSERIR AREA
            if (isset($_POST["area"])) {

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query1 = "SELECT MAX(idUser) FROM users";

                if (mysqli_stmt_prepare($stmt, $query1)) {
                    /* execute the prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $idUser);

                        /* fetch values */
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "id do user: $idUser <br>";
                            $query2 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
                  VALUES (?, ?)";
                            //parte do insert
                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                echo "id do user: $idUser <br>";

                                mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idAreas);
                                echo "id das áreas: $idAreas<br>";
                                // PARA TODAS AS ÁREAS QUE FORAM ESCOLHIDAS
                                foreach ($_POST["area"] as $idAreas) {
                                    echo "id das áreas: $idAreas<br>";
                                    /* execute the prepared statement */
                                    if (!mysqli_stmt_execute($stmt)) {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                }
                                /* close statement */
                                mysqli_stmt_close($stmt);
                            }
                            //fim da cena do insert
                        }
                    }
                }
            } else {
                ///isto é do isset
                echo "ERRO de não temos nada inserido";
                // header("Location: ../register.php?msg=2");
            }


            //TESTE DE PERSONALIDADE
            if (isset($_POST["pergunta1"]) && isset($_POST["pergunta2"]) && isset($_POST["pergunta3"]) && isset($_POST["pergunta4"])) {

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query1 = "SELECT MAX(idUser) FROM users";
                $query3 = "SELECT idPersonality, name_perso FROM personality WHERE name_perso = 'Comunicativo'";
                $query4 = "SELECT idPersonality, name_perso FROM personality WHERE name_perso = 'Organizado'";
                $query5 = "SELECT idPersonality, name_perso FROM personality WHERE name_perso = 'Previsível'";
                $query6 = "SELECT idPersonality, name_perso FROM personality WHERE name_perso = 'Determinado'";

                if (mysqli_stmt_prepare($stmt, $query1)) {
                    /* execute the prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $idUser);

                        /* fetch values */
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "id do user: $idUser <br>";


                            /*Variáveis que recebem as respostas por POST. O que está a ser passado é o NAME do SELECT do HTML*/
                            $answer1 = $_POST['pergunta1'];
                            $answer2 = $_POST['pergunta2'];
                            $answer3 = $_POST['pergunta3'];
                            $answer4 = $_POST['pergunta4'];


                            /*Array que guarda todas as respostas*/
                            $arrayRespostas = array(
                                1 => $answer1,
                                2 => $answer2,
                                3 => $answer3,
                                4 => $answer4
                            );

                            /*Deteta as vezes que uma resposta foi selecionada*/
                            $respostas_iguais = array_count_values($arrayRespostas);


                            /*A $key representa a chave do array (comunicativo, organizado, etc...) e a $value vai representar as vezes que este se repete*/
                            echo "<h1>Sou um jovem:</h1>";

                            foreach ($respostas_iguais as $key => $value) {

                                switch ($value) {
                                    case $key == "comunicativo" && $value > 1:
                                        //INÍCIO DA QUERY 3
                                        if (mysqli_stmt_prepare($stmt, $query3)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $c = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $c);
                                                        echo "id comunicativo: $c<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        break;
                                    case $key == "organizado" && $value > 1:
                                        $stmt = mysqli_stmt_init($link);
                                        //INÍCIO DA QUERY 4
                                        if (mysqli_stmt_prepare($stmt, $query4)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $o = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $o);
                                                        echo "id comunicativo: $o<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        break;
                                    case $key == "previsivel" && $value > 1:
                                        $stmt = mysqli_stmt_init($link);
                                        //INÍCIO DA QUERY 5
                                        if (mysqli_stmt_prepare($stmt, $query5)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $pr = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $pr);
                                                        echo "id comunicativo: $pr<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        break;
                                    case $key == "determinado" && $value > 1:
                                        $stmt = mysqli_stmt_init($link);
                                        //INÍCIO DA QUERY 6
                                        if (mysqli_stmt_prepare($stmt, $query6)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $d = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $d);
                                                        echo "id comunicativo: $d<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        break;
                                    case $key == "comunicativo" && $value == 1 && $key == "organizado" && $value == 1 && $key == "previsivel" && $value == 1 && $key == "determinado" && $value == 1:

                                        $stmt = mysqli_stmt_init($link);
                                        //AQUI TÊM DE IR 4 PARA A BD
                                        //INÍCIO DA QUERY 3
                                        if (mysqli_stmt_prepare($stmt, $query3)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $c = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $c);
                                                        echo "id comunicativo: $c<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        $stmt = mysqli_stmt_init($link);
                                        //INÍCIO DA QUERY 4
                                        if (mysqli_stmt_prepare($stmt, $query4)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $o = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $o);
                                                        echo "id comunicativo: $o<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        $stmt = mysqli_stmt_init($link);
                                        //INÍCIO DA QUERY 5
                                        if (mysqli_stmt_prepare($stmt, $query5)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $pr = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $pr);
                                                        echo "id comunicativo: $pr<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        $stmt = mysqli_stmt_init($link);
                                        //INÍCIO DA QUERY 6
                                        if (mysqli_stmt_prepare($stmt, $query6)) {
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $d = $idPersonality;
                                                    //INICIO DA QUERY DE INSERT
                                                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality)
                                                    VALUES (?, ?)";
                                                    //parte do insert
                                                    if (mysqli_stmt_prepare($stmt, $query7)) {
                                                        echo "id do user: $idUser <br>";

                                                        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $d);
                                                        echo "id comunicativo: $d<br>";
                                                        if (!mysqli_stmt_execute($stmt)) {
                                                            echo "Error: " . mysqli_stmt_error($stmt);
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                    //fim da cena do insert

                                                }
                                            }
                                        }
                                        break;
                                }
                            }
                        }
                    }
                }
            }
          header("Location: ../login.php");
        } else {
            // ERROR ACTION
            echo "Error: " . mysqli_stmt_error($stmt);
            echo "NAO DEU POR ERRO DA BD <br>";
            //header("Location: ../register.php?msg=0");
        }
    } else {
        // ERROR ACTION
        echo "ERRO <br>";
        //header("Location: ../register.php?msg=0");
        mysqli_close($link);
    }
} else {
    echo "ERRO de não temos nada inserido <br>";
    // header("Location: ../register.php?msg=2");
}
