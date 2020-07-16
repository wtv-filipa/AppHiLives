<?php
session_start();
require_once "../connections/connection.php";

if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["data_nasc"]) && !empty($_POST["def"]) && !empty($_POST["password"])) {

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

        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);
            
        }
       
        if (!empty($_POST["regiao"])) {
            $query2 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query2)) {                
                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idRegion);
                foreach ($_POST["regiao"] as $idRegion) {
                                     
                    if (!mysqli_stmt_execute($stmt)) {                        
                        header("Location: ../register.php");
                        $_SESSION["register"] = 1;                        
                    }
                }
            }
        } else {
            header("Location: ../register.php");
            $_SESSION["register"] = 2;
        }
        
        if (!empty($_POST["area"])) {
            $query3 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
            VALUES (?, ?)";
            if (mysqli_stmt_prepare($stmt, $query3)) {
                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idAreas);
                
                foreach ($_POST["area"] as $idAreas) {                    
                    if (!mysqli_stmt_execute($stmt)) {                        
                        header("Location: ../register.php");
                        $_SESSION["register"] = 1;                       
                    }
                }
            }
        } else {
            header("Location: ../register.php");
            $_SESSION["register"] = 2;
        }
        
        if (!empty($_POST["capacity"])) {
            $query4 = "INSERT INTO capacities_has_users (capacities, users_idUser)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query4)) {               
                mysqli_stmt_bind_param($stmt, 'ii', $capacities, $last_id); 
                foreach ($_POST["capacity"] as $capacities) {                   
                    if (!mysqli_stmt_execute($stmt)) {                        
                        header("Location: ../register.php");
                        $_SESSION["register"] = 1;
                    }
                }
            }
        } else {
            header("Location: ../register.php");
            $_SESSION["register"] = 2;
        }
       
        if (!empty($_POST["environment"])) {
            $query5 = "INSERT INTO work_environment_has_users (favorite_environment, users_idUser)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query5)) {
                mysqli_stmt_bind_param($stmt, 'ii', $environment, $last_id);

                foreach ($_POST["environment"] as $environment) {                   
                    if (!mysqli_stmt_execute($stmt)) {
                       
                        header("Location: ../register.php");
                        $_SESSION["register"] = 1;
                       
                    }
                }
            }
        } else {
          
            header("Location: ../register.php");
            $_SESSION["register"] = 2;
        }   
        mysqli_stmt_close($stmt);
        mysqli_close($link);
     
        header("Location: ../login.php");
        $_SESSION["login"] = 4;
    } else {
        header("Location: ../register.php");
        $_SESSION["register"] = 1;
    }
} else {
    header("Location: ../register.php");
    $_SESSION["register"] = 2;
}
