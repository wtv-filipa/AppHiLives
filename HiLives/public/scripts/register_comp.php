<?php
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
        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);

            // SUCCESS ACTION
            //echo "ESTÁ NA BD <br>";

            //INSERIR REGIAO
            if (!empty($_POST["regiao"])) {
                $idRegion = $_POST["regiao"];
                $query2 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion) VALUES (?, ?)";
                //parte do insert
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    //echo "id do user: $idUser <br>";

                    mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idRegion);
                    //echo"id da região: $idRegion<br>";
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                //fim da cena do insert

            } else {
                ///isto é do isset
                echo "Região não inserida";
                // header("Location: ../register.php?msg=2");
            }
            //FIM DO INSERT REGIAO

            //header("Location: ../login.php");
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
    echo "faltam campos <br>";
    // header("Location: ../register.php?msg=2");
}
