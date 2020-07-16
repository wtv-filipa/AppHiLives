<?php
session_start();
require_once "../connections/connection.php";

if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["data_fund"]) && !empty($_POST["phone"]) && !empty($_POST["desc"]) && !empty($_POST["password"])) {

    $type = 7;

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, password, website_ue, facebook_ue, instagram_ue, description_ue, User_type_idUser_type) VALUES (?,?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssssi', $name, $email, $contact_user, $birth_date, $password_hash, $website_ue, $facebook_ue, $instagram_ue, $description_ue, $User_type_idUser_type);

        $name = $_POST['nome'];
        $email = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_fund'];
        $website_ue = $_POST["site"];
        $facebook_ue = $_POST["face"];
        $instagram_ue = $_POST["insta"];
        $description_ue = $_POST["desc"];
        $User_type_idUser_type = $type;
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);

            if (!empty($_POST["regiao"])) {
                $idRegion = $_POST["regiao"];
                $query2 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion) VALUES (?, ?)";
               
                if (mysqli_stmt_prepare($stmt, $query2)) {                   
                    mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idRegion);
                   
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../register_comp.php");
                        $_SESSION["register"] = 1;
                    }
                  
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../register_comp.php");
                    $_SESSION["register"] = 1;
                }

            } else {
                header("Location: ../register_comp.php");
                $_SESSION["register"] = 2;
            }
            
            header("Location: ../login.php");
            $_SESSION["login"] = 4;
        } else {
            
            header("Location: ../register_comp.php");
            $_SESSION["register"] = 1;
            
        }
    } else {
        
        header("Location: ../register_comp.php");
        $_SESSION["register"] = 1;
        mysqli_close($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    
    header("Location: ../register_comp.php");
    $_SESSION["register"] = 2;
}
