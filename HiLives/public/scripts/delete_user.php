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

    $query = "SELECT type_user FROM user_type INNER JOIN users ON user_type.idUser_type = users.User_type_idUser_type WHERE idUser = ?";
    
    $query2 = "DELETE FROM users WHERE idUser = ?";
   
    $query3 = "DELETE FROM content WHERE users_idUser = ?";
    
    $query4 = "DELETE FROM user_has_region WHERE User_idUser_region = ?";
   
    $query5 = "DELETE FROM user_has_areas WHERE User_idUser = ?";
   
    $query6 = "SELECT profile_img FROM users WHERE idUser = ?";
   
    $query7 = "SELECT content_name FROM content WHERE users_idUser = ?";
   
    $query20 = "DELETE FROM learning_path_capacities WHERE fk_match_vac = ?";

    $query22 = "DELETE FROM notifications WHERE User_idUser = ?";
    /**********************************************************/
    $query8 = "DELETE FROM capacities_has_users WHERE users_idUser = ?";
   
    $query9 = "DELETE FROM done_cu WHERE User_idUser = ?";
    
    $query10 = "DELETE FROM experiences WHERE User_idUser = ?";
   
    $query11 = "DELETE FROM user_has_vacancies WHERE User_young = ?";
    
    $query12 = "DELETE FROM work_environment_has_users WHERE users_idUser = ?";
    
    $query13 = "DELETE FROM young_university WHERE User_young = ?";
 
    $query19 = "SELECT id_match_vac FROM user_has_vacancies WHERE User_young = ?";
    /**********************************************************/
    $query14 = "DELETE FROM vacancies WHERE User_publicou = ?";
    $query15 = "SELECT idVacancies FROM vacancies WHERE User_publicou = ?";
    $query16 = "DELETE FROM vacancies_has_capacities WHERE vacancies_idVacancies = ?";
    $query17 = "DELETE FROM user_has_vacancies WHERE vacancies_idVacancies = ?";
    $query21 = "SELECT id_match_vac FROM user_has_vacancies WHERE Vacancies_idVacancies = ?";
    /**********************************************************/
    
    $query18 = "DELETE FROM young_university WHERE User_university = ?";
    /**********************************************************/
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $type_user);
        while (mysqli_stmt_fetch($stmt)) {

            if ($type_user == "Jovem") {
                
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                    }
                   
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query5)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                    }  
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query7)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $content_name);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $xp = "../../admin/uploads/xp/" . $content_name;
                        if (!unlink($xp)) {
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 2;
                        } else {
                            
                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                                
                                if (!mysqli_stmt_execute($stmt3)) {
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 2;
                                }
                                mysqli_stmt_close($stmt3);
                            } else {
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                            }
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                /**********************************************************/
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../../admin/uploads/img_perfil/" . $profile_img;
                            if (!unlink($img)) {
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                            } 
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                /**********************************************************/
               
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query8)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                       
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                   
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query9)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                      
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                       
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query10)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                    
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query19)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $id_match_vac);
                    while (mysqli_stmt_fetch($stmt2)) {
                      
                        $link3 = new_db_connection();
                        if (mysqli_stmt_prepare($stmt3, $query20)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $id_match_vac);
                            
                            if (!mysqli_stmt_execute($stmt3)) {
                                
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                            } 
                            mysqli_stmt_close($stmt3);
                        } else {
                           
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 2;
                        }
                        /**********************************************************/
                    
                        $link3 = new_db_connection();
                        if (mysqli_stmt_prepare($stmt3, $query11)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                            
                            if (!mysqli_stmt_execute($stmt3)) {
                                
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 2;
                            } 
                            mysqli_stmt_close($stmt3);
                        } else {
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 2;
                        }
                        /**********************************************************/
                    }
                    mysqli_stmt_close($stmt2);
                }
                /**********************************************************/
               
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query12)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query13)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                  
                    if (!mysqli_stmt_execute($stmt2)) {
                     
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                /**********************************************************/
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query22)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 2;
                       
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                    
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 2;
                }
                session_destroy();
                header("Location: ../../index.php");
                /**********************************************************/
            } else if ($type_user == "Empresa") {
             
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                 
                    if (!mysqli_stmt_execute($stmt2)) {
                    
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                    
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../../admin/uploads/img_perfil/" . $profile_img;
                            
                            if (!unlink($img)) {
                                
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                            } 
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                /**********************************************************/
               
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query15)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $idVacancies);
                    while (mysqli_stmt_fetch($stmt2)) {
                       
                        $stmt3 = mysqli_stmt_init($link3);
                        if (mysqli_stmt_prepare($stmt3, $query16)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
                            
                            if (!mysqli_stmt_execute($stmt3)) {
                                
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                            } 
                            mysqli_stmt_close($stmt3);
                        } else {
                            
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 1;
                        }
                        /*****/
                        $stmt3 = mysqli_stmt_init($link3);
                        if (mysqli_stmt_prepare($stmt3, $query21)) {

                            mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
                            mysqli_stmt_execute($stmt3);
                            mysqli_stmt_bind_result($stmt3, $id_match_vac);
                            while (mysqli_stmt_fetch($stmt3)) {
                                if (mysqli_stmt_prepare($stmt4, $query20)) {
                                    mysqli_stmt_bind_param($stmt4, 'i', $id_match_vac);
                                
                                    if (!mysqli_stmt_execute($stmt4)) {
                                        
                                        header("Location: ../settings.php");
                                        $_SESSION["delete"] = 1;
                                    } 
                                    mysqli_stmt_close($stmt4);
                                } else {
                                   
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 1;
                                }
                                /*****/
                           
                                $stmt4 = mysqli_stmt_init($link4);
                                if (mysqli_stmt_prepare($stmt4, $query17)) {
                                    mysqli_stmt_bind_param($stmt4, 'i', $idVacancies);
                                    
                                    if (!mysqli_stmt_execute($stmt4)) {
                                        
                                        header("Location: ../settings.php");
                                        $_SESSION["delete"] = 1;
                                    } 
                                    mysqli_stmt_close($stmt4);
                                } else {
                                   
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 1;
                                }
                            }
                            mysqli_stmt_close($stmt3);
                        }
                        /***********************************/
                    }
                    mysqli_stmt_close($stmt2);
                }
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query7)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $content_name);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $xp = "../../admin/uploads/vid_vac/" . $content_name;
                        if (!unlink($xp)) {
                            
                            header("Location: ../settings.php");
                            $_SESSION["delete"] = 1;
                        } else {
                            $stmt3 = mysqli_stmt_init($link3);
                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                                
                                if (!mysqli_stmt_execute($stmt3)) {
                                  
                                    header("Location: ../settings.php");
                                    $_SESSION["delete"] = 1;
                                }
                                mysqli_stmt_close($stmt3);
                            } else {
                                
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                            }
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                /**********************************************************/
            
                $stmt3 = mysqli_stmt_init($link3);
                if (mysqli_stmt_prepare($stmt3, $query14)) {
                    mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt3)) {
                        
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                    } 
                    mysqli_stmt_close($stmt3);
                } else {
                    
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query22)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                session_destroy();
                header("Location: ../../index.php");
                /**********************************************************/
            } else if ($type_user == "Universidade") {
             
                echo "apagar Universidade <br>";
               
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
               
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query5)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                  
                    if (!mysqli_stmt_execute($stmt2)) {
                   
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                   
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
             
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../../admin/uploads/img_perfil/" . $profile_img;
                           
                            if (!unlink($img)) {
                            
                                header("Location: ../settings.php");
                                $_SESSION["delete"] = 1;
                            } 
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                /**********************************************************/
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query18)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        
                    }  
                    mysqli_stmt_close($stmt2);
                } else {
                    
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                /**********************************************************/
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query22)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                  
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../settings.php");
                        $_SESSION["delete"] = 1;
                        
                    } 
                    mysqli_stmt_close($stmt2);
                } else {
                   
                    header("Location: ../settings.php");
                    $_SESSION["delete"] = 1;
                }
                session_destroy();
                header("Location: ../../index.php");
                /**********************************************************/
            } else {
                
                header("Location: ../settings.php");
                $_SESSION["delete"] = 1;
            }
        }
       
        mysqli_stmt_close($stmt); 
    }
  
    mysqli_close($link);
    mysqli_close($link2);
    mysqli_close($link3);
    mysqli_close($link4);
 

} else {
    if (isset($_SESSION["type"])) {
        $user_type = $_SESSION["type"];
        if ($user_type == 7 || $user_type == 13) {
           
            header("Location: ../settings.php");
            $_SESSION["delete"] = 1;
        } else if ($user_type == 10) {
           
            header("Location: ../settings.php");
            $_SESSION["delete"] = 2;
        }
    }
}
