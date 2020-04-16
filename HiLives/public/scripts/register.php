<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["def"]) && isset($_POST["laudo"]) && isset($_POST["password"]))  {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, disability_name, date_report, work_xp, password) VALUES (?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssss', $name, $email, $contact_user, $birth_date, $disability, $date_report, $work_xp, $password_hash);
        $name = $_POST['nome'];
        $email = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_nasc'];
        $disability = $_POST['def'];
        $date_report = $_POST["laudo"];
        $work_xp = $_POST["work"];

        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            echo "ESTÁ NA BD";
            //header("Location: ../login.php?msg=2");
        } else {
            // ERROR ACTION
            echo "Error:" . mysqli_stmt_error($stmt);
            echo "Não está a ir para a bd";
            
            //header("Location: ../register.php?msg=0");
        }

    } else {
        // ERROR ACTION
        echo "Error:" . mysqli_error($link);
        echo "ERRO";
        //header("Location: ../register.php?msg=0");
        mysqli_close($link);
    }
} else {
    echo "ERRO de não temos nada inserido";
   // header("Location: ../register.php?msg=2");
}