<?php
session_start();
$id_navegar = $_SESSION["idUser"];
if (isset($_GET["id"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["def"])) {
    echo "estou a editar um jovem";
    $idUser = $_GET["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tlm = $_POST["phone"];
    $data_nasc = $_POST["data_nasc"];
    $info_young = $_POST["def"];
    $work_xp = $_POST["work"];
    $school = $_POST["esc"];
    
    require_once("../connections/connection.php");
    
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
   
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query10 = "SELECT Region_idRegion FROM user_has_region WHERE User_idUser_region = ?";
    $query11 = "DELETE FROM young_university
            WHERE User_young = ? AND User_university IN (
	        SELECT idUser FROM users
	        INNER JOIN user_has_region
	        ON users.idUser = user_has_region.User_idUser_region
	        WHERE users.User_type_idUser_type = 13 AND Region_idRegion = ?)";
    $regiao = $_POST["regiao"];

    if (mysqli_stmt_prepare($stmt, $query10)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Region_idRegion);
        while (mysqli_stmt_fetch($stmt)) {
            $search_val = in_array($Region_idRegion, $regiao);
            if ($search_val == false) {
               
                if (mysqli_stmt_prepare($stmt2, $query11)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Region_idRegion);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                       
                    } 
                } else {
                  
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
            }
        }
    }
    /************************************************************/
   
    $query12 = "SELECT Areas_idAreas, name_interested_area 
FROM user_has_areas 
INNER JOIN areas 
ON user_has_areas.Areas_idAreas = areas.idAreas
WHERE User_idUser = ?";

    $query13 = "DELETE FROM young_university
WHERE User_young = ?  AND User_university IN 
(SELECT idUser FROM users
INNER JOIN user_has_areas
ON users.idUser = user_has_areas.User_idUser
INNER JOIN areas
ON areas.idAreas = user_has_areas.Areas_idAreas
WHERE users.User_type_idUser_type = 13 AND young_university.Area = ?)";
    $area = $_POST["area"];

    if (mysqli_stmt_prepare($stmt, $query12)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Areas_idAreas, $name_interested_area);
        while (mysqli_stmt_fetch($stmt)) {
           
            $search_area = in_array($Areas_idAreas, $area);
           
            if ($search_area == false) {
                
                if (mysqli_stmt_prepare($stmt2, $query13)) {
                    mysqli_stmt_bind_param($stmt2, 'is', $idUser, $name_interested_area);
                  
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                       
                    } 
                } else {
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
            }
        }
    }

    $query14 = "DELETE FROM user_has_vacancies
WHERE User_young = ? AND Vacancies_idVacancies IN (
SELECT idVacancies FROM vacancies
WHERE Region_idRegion = ? AND match_perc = 1)";

    $query15 = "DELETE FROM learning_path_capacities
WHERE fk_match_vac IN (
SELECT id_match_vac FROM user_has_vacancies
INNER JOIN vacancies 
ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
WHERE Region_idRegion = ? AND match_perc = 0 AND User_young = ?)";
  
    $query16 = "DELETE FROM user_has_vacancies
WHERE User_young = ? AND Vacancies_idVacancies IN (
SELECT idVacancies FROM vacancies
WHERE Region_idRegion = ? AND match_perc = 0)";

    if (mysqli_stmt_prepare($stmt, $query10)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Region_idRegion);
        while (mysqli_stmt_fetch($stmt)) {
            $search_regiao = in_array($Region_idRegion, $regiao);
            if ($search_regiao == false) {
               
                if (mysqli_stmt_prepare($stmt2, $query14)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Region_idRegion);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                       
                    } 
                } else {
                   
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                
                if (mysqli_stmt_prepare($stmt2, $query15)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $Region_idRegion, $idUser);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        
                    } 
                } else {
                   
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                
                if (mysqli_stmt_prepare($stmt2, $query16)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Region_idRegion);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        
                    } 
                } else {
                   
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
            }
        }
    }
    /************************************************************/
   
    $query30 = "SELECT Areas_idAreas
FROM user_has_areas 
WHERE User_idUser = ?";
    
    $query31 = "DELETE FROM user_has_vacancies WHERE User_young = ? AND Vacancies_idVacancies IN ( SELECT idVacancies FROM vacancies WHERE Areas_idAreas = ? AND match_perc = 1)";
    
    $query32 = "DELETE FROM learning_path_capacities
WHERE fk_match_vac IN (
SELECT id_match_vac FROM user_has_vacancies
INNER JOIN vacancies 
ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
WHERE Areas_idAreas = ? AND match_perc = 0 AND User_young = ?)";
    
    $query33 = "DELETE FROM user_has_vacancies
WHERE User_young = ? AND Vacancies_idVacancies IN (
SELECT idVacancies FROM vacancies
WHERE Areas_idAreas = ? AND match_perc = 0)";

    if (mysqli_stmt_prepare($stmt, $query30)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Areas_idAreas);
        while (mysqli_stmt_fetch($stmt)) {
            $procura = in_array($Areas_idAreas, $area);
           
            if ($procura == false) {
                
                if (mysqli_stmt_prepare($stmt2, $query31)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Areas_idAreas);
                   
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                       
                    } 
                } else {
                    
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                
                if (mysqli_stmt_prepare($stmt2, $query32)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $Areas_idAreas, $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                       
                    } 
                } else {
                    
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                
                if (mysqli_stmt_prepare($stmt2, $query33)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $Areas_idAreas);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        
                    } 
                } else {
                    
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
            }
        }
    }
    
    $query34 = "SELECT Educ_lvl_idEduc_lvl  FROM users WHERE idUser = ?";
    
    $query35 = "DELETE FROM user_has_vacancies 
    WHERE User_young = ? AND Vacancies_idVacancies IN (
    SELECT idVacancies FROM vacancies 
    WHERE Educ_lvl_idEduc_lvl > ? AND match_perc = 1)";
   
    $query36 = "DELETE FROM learning_path_capacities
    WHERE fk_match_vac IN (
    SELECT id_match_vac FROM user_has_vacancies
    INNER JOIN vacancies 
    ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
    WHERE Educ_lvl_idEduc_lvl > ? AND match_perc = 0 AND User_young = ?)";
    
    $query37 = "DELETE FROM user_has_vacancies
    WHERE User_young = ? AND Vacancies_idVacancies IN (
    SELECT idVacancies FROM vacancies
    WHERE Educ_lvl_idEduc_lvl > ? AND match_perc = 0)";

    if (mysqli_stmt_prepare($stmt, $query34)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Educ_lvl_idEduc_lvl);
        while (mysqli_stmt_fetch($stmt)) {
            if ($Educ_lvl_idEduc_lvl > $school &&  $Educ_lvl_idEduc_lvl != $school) {
               
                if (mysqli_stmt_prepare($stmt2, $query35)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $school);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        
                    } 
                } else {
                    
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                
                if (mysqli_stmt_prepare($stmt2, $query36)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $school, $idUser);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        
                    } 
                } else {
                    
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
                
                if (mysqli_stmt_prepare($stmt2, $query37)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $school);
                    
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                        
                    } 
                } else {
                    
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                /*****/
            }
        }
    }
    /************************************************************/

    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?, info_young=?, work_xp=?, Educ_lvl_idEduc_lvl=?
      WHERE idUser = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssssii', $nome, $email, $tlm, $data_nasc, $info_young, $work_xp, $school, $idUser);

        if (!mysqli_stmt_execute($stmt)) {
        
            header("Location: ../edit_profile.php?edit=$id_navegar");
            $_SESSION["edit_jovem"] = 3;
            
        } else {
            
            //REGIÃO
            if (!empty($_POST["regiao"])) {
                
                $query2 = "DELETE FROM user_has_region
    WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                       
                    }
                    
                    mysqli_stmt_close($stmt);
                }
               
                $stmt = mysqli_stmt_init($link);

                $query3 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
                  VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query3)) {
                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);
                    foreach ($_POST["regiao"] as $idRegion) {                        
                        if (!mysqli_stmt_execute($stmt)) {                           
                            header("Location: ../edit_profile.php?edit=$id_navegar");
                            $_SESSION["edit_jovem"] = 3;                            
                        }
                    }
                   
                    mysqli_stmt_close($stmt);
                }
               
                mysqli_close($link);
            } 
            if (!empty($_POST["area"])) {
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query4 = "DELETE FROM user_has_areas
 WHERE User_idUser = ?";

                if (mysqli_stmt_prepare($stmt, $query4)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                    }
                    mysqli_stmt_close($stmt);
                }
                
                $stmt = mysqli_stmt_init($link);
                $query5 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
               VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query5)) {
                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idAreas);
                    foreach ($_POST["area"] as $idAreas) {
                        if (!mysqli_stmt_execute($stmt)) {
                            header("Location: ../edit_profile.php?edit=$id_navegar");
                            $_SESSION["edit_jovem"] = 3;
                        }
                    }
                   
                    mysqli_stmt_close($stmt);
                }
               
                mysqli_close($link);
            } 
        }
        if (!empty($_POST["capacity"])) {
            $link = new_db_connection();
            
            $stmt = mysqli_stmt_init($link);
            $query6 = "DELETE FROM capacities_has_users
 WHERE users_idUser = ?";

            if (mysqli_stmt_prepare($stmt, $query6)) {
                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                if (!mysqli_stmt_execute($stmt)) {
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;                   
                }

                mysqli_stmt_close($stmt);
            }
           
            $stmt = mysqli_stmt_init($link);

            $query7 = "INSERT INTO capacities_has_users (capacities, users_idUser)
               VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query7)) {
                mysqli_stmt_bind_param($stmt, 'ii', $capacities, $idUser);
                foreach ($_POST["capacity"] as $capacities) {
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                    }
                }
                mysqli_stmt_close($stmt);
            }
        }

        if (!empty($_POST["spot"])) {
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
          
            $query8 = "DELETE FROM work_environment_has_users
 WHERE users_idUser = ?";
            if (mysqli_stmt_prepare($stmt, $query8)) {
                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                if (!mysqli_stmt_execute($stmt)) {
                    header("Location: ../edit_profile.php?edit=$id_navegar");
                    $_SESSION["edit_jovem"] = 3;
                }
                mysqli_stmt_close($stmt);
            }
            $stmt = mysqli_stmt_init($link);

            $query9 = "INSERT INTO work_environment_has_users (favorite_environment, users_idUser)
               VALUES (?, ?)";
            if (mysqli_stmt_prepare($stmt, $query9)) {
                mysqli_stmt_bind_param($stmt, 'ii', $favorite_environment, $idUser);
                foreach ($_POST["spot"] as $favorite_environment) {
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                    }
                }
                mysqli_stmt_close($stmt);
            }
        }
      
        include "match_uni_login.php";
        header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit_jovem"] = 1; 
    } else {
        header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit_jovem"] = 3;
    }
  
} else if (isset($_GET["id_uni_emp"]) && !empty($_POST["nome"]) && !empty($_POST["email"])) {
 
    $idUser = $_GET["id_uni_emp"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tlm = $_POST["phone"];
    $data_fund = $_POST["data_fund"];
    $site = $_POST["site"];
    $face = $_POST["face"];
    $insta = $_POST["insta"];
    $desc = $_POST["desc"];
    $hist = $_POST["hist"];
  
    require_once("../connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
  
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query14 = "SELECT type_user FROM user_type INNER JOIN users ON user_type.idUser_type = users.User_type_idUser_type WHERE users.idUser = ?";

    $query15 = "SELECT Areas_idAreas, name_interested_area 
FROM user_has_areas 
INNER JOIN areas 
ON user_has_areas.Areas_idAreas = areas.idAreas
WHERE User_idUser = ?";

    $query16 = "DELETE FROM young_university
WHERE User_university = ?  AND User_young IN 
(SELECT idUser FROM users
INNER JOIN user_has_areas
ON users.idUser = user_has_areas.User_idUser
INNER JOIN areas
ON areas.idAreas = user_has_areas.Areas_idAreas
WHERE users.User_type_idUser_type = 10 AND young_university.Area = ?)";

    $area = $_POST["area"];

    if (mysqli_stmt_prepare($stmt, $query14)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $type_user);
        while (mysqli_stmt_fetch($stmt)) {
            if ($type_user == "Universidade") {
                if (mysqli_stmt_prepare($stmt, $query15)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $Areas_idAreas, $name_interested_area);
                    while (mysqli_stmt_fetch($stmt)) {                        
                        $search_area = in_array($Areas_idAreas, $area);
                        if ($search_area == false) {
                            if (mysqli_stmt_prepare($stmt2, $query16)) {
                                mysqli_stmt_bind_param($stmt2, 'is', $idUser, $name_interested_area);                                
                                if (!mysqli_stmt_execute($stmt2)) {                                    
                                    header("Location: ../edit_profile.php?edit=$id_navegar");
                                    $_SESSION["edit"] = 3;
                                } 
                            } else {                                
                                header("Location: ../edit_profile.php?edit=$id_navegar");
                                $_SESSION["edit"] = 3;
                            }
                        }
                    }
                }
            }
        }
    }

    /************************************************************/
    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?, website_ue = ?, facebook_ue = ?, instagram_ue = ?, description_ue = ?, history_ue = ?
      WHERE idUser = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssssssssi', $nome, $email, $tlm, $data_fund, $site, $face, $insta, $desc, $hist, $idUser);

        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../edit_profile.php?edit=$id_navegar");
            $_SESSION["edit"] = 3;
        } else {
            if (!empty($_POST["regiao"])) {
                $query2 = "DELETE FROM user_has_region
WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit"] = 3;
                    }
                    mysqli_stmt_close($stmt);
                }
                $stmt = mysqli_stmt_init($link);

                $query3 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
              VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query3)) {
                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);
                    $idRegion = $_POST["regiao"];
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit"] = 3;                       
                    } 
                    mysqli_stmt_close($stmt);
                }
                mysqli_close($link);
            } 
            if (!empty($_POST["area"])) {
            
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
              
                $query4 = "DELETE FROM user_has_areas
 WHERE User_idUser = ?";

                if (mysqli_stmt_prepare($stmt, $query4)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$id_navegar");
                        $_SESSION["edit"] = 3;
                    }
                    mysqli_stmt_close($stmt);
                }
                $stmt = mysqli_stmt_init($link);

            
                $query5 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
               VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query5)) {
                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idAreas);
                    foreach ($_POST["area"] as $idAreas) {
                        if (!mysqli_stmt_execute($stmt)) {
                            header("Location: ../edit_profile.php?edit=$id_navegar");
                            $_SESSION["edit"] = 3;
                        }
                    }
                    
                }
            } 
        }
      
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $query14)) {
            mysqli_stmt_bind_param($stmt, 'i', $idUser);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $type_user);
            while (mysqli_stmt_fetch($stmt)) {
                if ($type_user == "Universidade") {
                    include "match_young_login.php";
                }
            }
        }
       
        mysqli_stmt_close($stmt);
        
        header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit"] = 1;
    } else {
        header("Location: ../edit_profile.php?edit=$id_navegar");
        $_SESSION["edit"] = 3;
    }
} else {
    header("Location: ../edit_profile.php?edit=$id_navegar");
    $_SESSION["edit_jovem"] = 2;
    $_SESSION["edit"] = 2;
}
