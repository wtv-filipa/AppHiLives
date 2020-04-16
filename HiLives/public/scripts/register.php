<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["study_work"]) && isset($_POST["def"]) && isset($_POST["laudo"]) && isset($_POST["password"])) {

    $type = 3;

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, disability_name, date_report, work_xp, password, User_type_idUser_type, Educ_lvl_idEduc_lvl, Study_work_idStudy_work) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssiii', $name, $email, $contact_user, $birth_date, $disability, $date_report, $work_xp, $password_hash, $User_type_idUser_type, $Educ_lvl_idEduc_lvl, $Study_work_idStudy_work);
        $name = $_POST['nome'];
        $email = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_nasc'];
        $disability = $_POST['def'];
        $date_report = $_POST["laudo"];
        $work_xp = $_POST["work"];
        $Study_work_idStudy_work = $_POST["study_work"];
        $Educ_lvl_idEduc_lvl = $_POST["esc"];
        $User_type_idUser_type = $type;
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            //echo "ESTÁ NA BD <br>";
            //header("Location: ../login.php?msg=2");
        } else {
            // ERROR ACTION
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

                    mysqli_stmt_bind_param($stmt, 'ii',$idUser, $idRegion);
                    echo"id da região: $idRegion<br>";
                    // PARA TODOS OS JOGADORES QUE FORAM ESCOLHIDOS
                    foreach ($_POST["regiao"] as $idRegion) {
                        echo"id da região: $idRegion<br>";
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
