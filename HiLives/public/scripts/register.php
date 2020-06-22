<?php
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

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);
            echo "ID depois de inserir o user: " . "$last_id";
            //mysqli_stmt_close($stmt);
            //mysqli_close($link);
            // SUCCESS ACTION
            //echo "ESTÁ NA BD <br>";
        }
        //JÁ INSERIU OS USERS
        //AGORA VAI INSERIR REGIÕES
        if (!empty($_POST["regiao"])) {
            $query2 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query2)) {
                echo "id do user nas regiões: $last_id <br>";

                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idRegion);

                echo "id da região: $idRegion<br>";
                // PARA TODOS OS JOGADORES QUE FORAM ESCOLHIDOS
                foreach ($_POST["regiao"] as $idRegion) {
                    echo "id da região: $idRegion<br>";
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
            }
        } else {
            echo "Região não escolhida";
        }
        //JÁ INSERIU AS REGIÕES
        //INSERIR AS ÁREAS
        if (!empty($_POST["area"])) {
            $query3 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
            VALUES (?, ?)";
            if (mysqli_stmt_prepare($stmt, $query3)) {
                echo "id do user nas areas: $last_id <br>";

                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idAreas);
                echo "id das áreas: $idAreas<br>";
                // PARA TODAS AS ÁREAS QUE FORAM ESCOLHIDAS
                foreach ($_POST["area"] as $idAreas) {
                    echo "id das áreas: $idAreas<br>";
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
            }
        } else {
            echo "não inseriu àreas";
        }
        //JÁ INSERIU AS ÁREAS
        //AGORA VAI INSERIR AS COMPETÊNCIAS
         if (!empty($_POST["capacity"])) {
            $query4 = "INSERT INTO capacities_has_users (capacities, users_idUser)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query4)) {
                echo "id do user nas competencias: $last_id <br>";

                mysqli_stmt_bind_param($stmt, 'ii', $capacities, $last_id);

                echo "id da competencia: $capacities<br>";
                // PARA TODOS OS JOGADORES QUE FORAM ESCOLHIDOS
                foreach ($_POST["capacity"] as $capacities) {
                    echo "id da competencia: $capacities<br>";
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
            }
        } else {
            echo "nada inserido nas capacidades";
        }
        //JÁ INSERIU AS COMPETÊNCIAS
        //AGORA VAI INSERIR OS AMBIENTES
        if (!empty($_POST["environment"])) {
            $query5 = "INSERT INTO work_environment_has_users (favorite_environment, users_idUser)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query5)) {
                echo "id do user nos ambientes: $last_id <br>";

                mysqli_stmt_bind_param($stmt, 'ii', $environment, $last_id);

                echo "id dos ambientes: $environment<br>";
                // PARA TODOS OS JOGADORES QUE FORAM ESCOLHIDOS
                foreach ($_POST["environment"] as $environment) {
                    echo "id dos ambientes: $environment<br>";
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
            }
        } else {
            echo "nada inserido nos ambientes favoritos";
        }
        //JÁ INSERIU OS AMBIENTES
        //INSERIR O MATCH
        include "match_uni.php";
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        //header("Location: ../login.php");
    }
}else{
    echo"falta o preenchimento de campos obrigatórios";
}
