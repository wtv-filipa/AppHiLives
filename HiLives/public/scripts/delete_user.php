<?php
session_start();
if (isset($_GET["apaga"])) {
    $idUser = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $link3 = new_db_connection();
    $stmt3 = mysqli_stmt_init($link3);

    $link4 = new_db_connection();
    $stmt4 = mysqli_stmt_init($link4);

    /*QUERYS PARA TODOS OS USERS*/
    //verificar que tipo de user é
    $query = "SELECT type_user FROM user_type INNER JOIN users ON user_type.idUser_type = users.User_type_idUser_type WHERE idUser = ?";
    //apagar user
    $query2 = "DELETE FROM users WHERE idUser = ?";
    //apagar content
    $query3 = "DELETE FROM content WHERE users_idUser = ?";
    //apagar da região
    $query4 = "DELETE FROM user_has_region WHERE User_idUser_region = ?";
    //apagar das areas
    $query5 = "DELETE FROM user_has_areas WHERE User_idUser = ?";
    //selecionar o nome da imagem de perfil do utilizador para que se possa apaga-la da pasta
    $query6 = "SELECT profile_img FROM users WHERE idUser = ?";
    //selecionar o nome do conteúdo para que possa apagá-lo da pasta
    $query7 = "SELECT content_name FROM content WHERE users_idUser = ?";
    //apagar as capacidades do percurso de aprendizagem
    $query20 = "DELETE FROM learning_path_capacities WHERE fk_match_vac = ?";
    /**********************************************************/
    /*QUERYS PARA OS JOVENS*/
    //apagar capacidades
    $query8 = "DELETE FROM capacities_has_users WHERE users_idUser = ?";
    //apagar UC's feitas
    $query9 = "DELETE FROM done_cu WHERE User_idUser = ?";
    //apagar experiências
    $query10 = "DELETE FROM experiences WHERE User_idUser = ?";
    //apagar match com as VAGAS
    $query11 = "DELETE FROM user_has_vacancies WHERE User_young = ?";
    //apagar ambientes favoritos
    $query12 = "DELETE FROM work_environment_has_users WHERE users_idUser = ?";
    //apagar match com as UNIVERSIDADES
    $query13 = "DELETE FROM young_university WHERE User_young = ?";
    //selecionar os macths com vagas
    $query19 = "SELECT id_match_vac FROM user_has_vacancies WHERE User_young = ?";
    /**********************************************************/
    /*QUERYS PARA AS EMPRESAS*/
    $query14 = "DELETE FROM vacancies WHERE User_publicou = ?";
    $query15 = "SELECT idVacancies FROM vacancies WHERE User_publicou = ?";
    $query16 = "DELETE FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";
    $query17 = "DELETE FROM user_has_vacancies WHERE vacancies_idVacancies = ?";
    //selecionar o id do match
    $query21 = "SELECT id_match_vac FROM user_has_vacancies WHERE Vacancies_idVacancies = ?";
    /**********************************************************/
    /*QUERYS PARA AS UNIVERSIDADES*/
    //apagar match com os JOVENS
    $query18 = "DELETE FROM young_university WHERE User_university = ?";
    /**********************************************************/
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $type_user);
        while (mysqli_stmt_fetch($stmt)) {

            if ($type_user == "Jovem") {
                /*JOVEM*/
                echo "apagar jovem <br>";
                //APAGAR REGIÕES
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as regiões <br>";
                    }
                } else {
                    //echo "erro nas regiões <br>";
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                //APAGAR AS AREAS
                if (mysqli_stmt_prepare($stmt2, $query5)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as areas <br>";

                    }
                } else {
                    echo "erro nas areas <br>";
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                //apagar conteúdos da pasta e tabela
                if (mysqli_stmt_prepare($stmt2, $query7)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $content_name);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $xp = "../uploads/xp/" . $content_name;
                        echo "Experiência diretório: $xp <br>";
                        if (!unlink($xp)) {
                            //echo "erro a apagar o ficheiro da pasta <br>";
                            //ERRO
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 2;
                        } else {
                            echo "sucesso a apagar o ficheiro da pasta <br>";
                            //apagar da tabela
                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                                // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                if (!mysqli_stmt_execute($stmt3)) {
                                    //ERRO
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 2;
                                    //echo "Error: " . mysqli_stmt_error($stmt3);
                                } else {
                                    //echo "sucesso a apagar os conteudos <br>";                                   
                                }
                            } else {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                            }
                        }
                    }
                }
                /**********************************************************/
                //apagar img de perfil da pasta
                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../uploads/img_perfil/" . $profile_img;
                            echo "diretorio img perfil: $img <br>";
                            if (!unlink($img)) {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                            } else {
                                //echo "sucesso a apagar a img da pasta <br>";
                            }
                        }
                    }
                }
                /**********************************************************/
                //apagar capacidades
                if (mysqli_stmt_prepare($stmt2, $query8)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as capacidades <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                //apagar UC's feitas
                if (mysqli_stmt_prepare($stmt2, $query9)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as UC's feitas <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                //apagar experiências
                if (mysqli_stmt_prepare($stmt2, $query10)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as experiências <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                //ver as vagas associadas para obter o id e apagar o percurso
                if (mysqli_stmt_prepare($stmt2, $query19)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $id_match_vac);
                    while (mysqli_stmt_fetch($stmt2)) {
                        //apagar os PERCURSOS associados por match
                        if (mysqli_stmt_prepare($stmt3, $query20)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $id_match_vac);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt3)) {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                                //echo "Error: " . mysqli_stmt_error($stmt3);
                            } else {
                                //echo "sucesso a apagar os percursos macth <br>";
                            }
                        } else {
                            //ERRO
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 2;
                        }
                        /**********************************************************/
                        //apagar VAGAS associadas por match
                        if (mysqli_stmt_prepare($stmt3, $query11)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt3)) {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                                //echo "Error: " . mysqli_stmt_error($stmt3);
                            } else {
                                //echo "sucesso a apagar as vagas macth <br>";
                            }
                        } else {
                            //ERRO
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 2;
                        }
                        /**********************************************************/
                    }
                }
                /**********************************************************/
                //apagar ambientes de trabalho preferidos
                if (mysqli_stmt_prepare($stmt2, $query12)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar os ambientes <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                //apagar macth com as UNIVERSIDADES
                if (mysqli_stmt_prepare($stmt2, $query13)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar os matchs areas <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                //apagar da tabela dos users
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar o utilizador <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                header("Location: ../../index.php");
                /**********************************************************/
            } else if ($type_user == "Empresa") {
                /*EMPRESA*/
                echo "apagar Empresa <br>";
                //APAGAR REGIÕES
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        // echo "sucesso a apagar as regiões <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                //apagar img de perfil da pasta
                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../uploads/img_perfil/" . $profile_img;
                            echo "diretorio img perfil: $img <br>";
                            if (!unlink($img)) {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                            } else {
                                //echo "sucesso a apagar a img da pasta <br>";
                            }
                        }
                    }
                }
                /**********************************************************/
                //Selecionar as VAGAS e a partir destas apagar as capacidades ligadas e os match que estas poderiam ter
                if (mysqli_stmt_prepare($stmt2, $query15)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $idVacancies);
                    while (mysqli_stmt_fetch($stmt2)) {
                        //APAGAR capacidades
                        if (mysqli_stmt_prepare($stmt3, $query16)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt3)) {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                                //echo "Error capacidades: " . mysqli_stmt_error($stmt3);
                            } else {
                                // echo "sucesso a apagar as capacidades da vaga <br>";
                            }
                        } else {
                            //ERRO
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 1;
                        }
                        /*****/
                        //selecionar o matchs
                        if (mysqli_stmt_prepare($stmt3, $query21)) {

                            mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
                            mysqli_stmt_execute($stmt3);
                            mysqli_stmt_bind_result($stmt3, $id_match_vac);
                            while (mysqli_stmt_fetch($stmt3)) {
                                //APAGAR PERCURSOS do match
                                if (mysqli_stmt_prepare($stmt4, $query20)) {
                                    mysqli_stmt_bind_param($stmt4, 'i', $id_match_vac);
                                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                    if (!mysqli_stmt_execute($stmt4)) {
                                        //ERRO
                                        header("Location: ../settings.php");
                                        $_SESSION["delete"] = 1;
                                        //echo "Error: " . mysqli_stmt_error($stmt4);
                                    } else {
                                        //echo "sucesso a apagar os percursos matchs <br>";
                                    }
                                } else {
                                    //ERRO
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 1;
                                }
                                /*****/
                                //APAGAR matchs com as vagas
                                if (mysqli_stmt_prepare($stmt4, $query17)) {
                                    mysqli_stmt_bind_param($stmt4, 'i', $idVacancies);
                                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                    if (!mysqli_stmt_execute($stmt4)) {
                                        //ERRO
                                        header("Location: ../settings.php");
                                        $_SESSION["delete"] = 1;
                                        // echo "Error: " . mysqli_stmt_error($stmt4);
                                    } else {
                                        //echo "sucesso a apagar os matchs <br>";
                                    }
                                } else {
                                    //ERRO
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 1;
                                }
                                /*****/
                            }
                        }
                        /***********************************/
                    }
                }
                //apagar conteúdos da pasta e tabela
                if (mysqli_stmt_prepare($stmt2, $query7)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $content_name);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $xp = "../uploads/vid_vac/" . $content_name;
                        echo "Experiência diretório: $xp <br>";
                        if (!unlink($xp)) {
                            //ERRO
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 1;
                        } else {
                            //echo "sucesso a apagar o ficheiro da pasta <br>";
                            //apagar da tabela
                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                                // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                if (!mysqli_stmt_execute($stmt3)) {
                                    //ERRO
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 1;
                                    //echo "Error content: " . mysqli_stmt_error($stmt3);
                                } else {
                                    //echo "sucesso a apagar os conteudos <br>";
                                }
                            } else {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                            }
                        }
                    }
                }
                /**********************************************************/
                /**********************************************************/
                //Apagar as vagas
                if (mysqli_stmt_prepare($stmt3, $query14)) {
                    mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt3)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as vagas <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                //apagar da tabela dos users
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar o utilizador <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                header("Location: ../../index.php");
                /**********************************************************/
            } else if ($type_user == "Universidade") {
                /*UNIVERSIDADE*/
                echo "apagar Universidade <br>";
                //APAGAR REGIÕES
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as regiões <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                //APAGAR AS AREAS
                if (mysqli_stmt_prepare($stmt2, $query5)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar as areas <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                //apagar img de perfil da pasta
                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../uploads/img_perfil/" . $profile_img;
                            echo "diretorio img perfil: $img <br>";
                            if (!unlink($img)) {
                                //ERRO
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                            } else {
                                //echo "sucesso a apagar a img da pasta <br>";
                            }
                        }
                    }
                }
                /**********************************************************/
                //apagar match com os JOVENS
                if (mysqli_stmt_prepare($stmt2, $query18)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar os matchs areas com os jovens <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                //apagar da tabela dos users
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (!mysqli_stmt_execute($stmt2)) {
                        //ERRO
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        //echo "Error: " . mysqli_stmt_error($stmt2);
                    } else {
                        //echo "sucesso a apagar o utilizador <br>";
                    }
                } else {
                    //ERRO
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                header("Location: ../../index.php");
                /**********************************************************/
            } else {
                //ERRO
                header("Location: ../settings.php");
                $_SESSION["delete"] = 1;
            }
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);
            mysqli_close($link);
            mysqli_close($link2);
            mysqli_close($link3);
        } //fim do while da query7
    } //fim do if da query7

} else {
    if (isset($_SESSION["type"])) {
        $user_type = $_SESSION["type"];
        if ($user_type == 7) {
            //ERRO
            header("Location: ../settings.php");
            $_SESSION["delete"] = 1;
        } else if ($user_type == 10) {
            //ERRO
            header("Location: ../settings.php");
            $_SESSION["delete"] = 2;
        }
    }
}
