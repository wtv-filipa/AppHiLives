<?php
if (isset($_GET["id"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["data_nasc"])) {
    echo "estou a editar o administrador";
    $idUser = $_GET["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tlm = $_POST["phone"];
    $data_nasc = $_POST["data_nasc"];
    // We need the function!
    require_once("../connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);
    // Create a new DB connection
    $link2 = new_db_connection();
    /* create a prepared statement */
    $stmt2 = mysqli_stmt_init($link2);


    /*UPDATE DO PERFIL*/
    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?
      WHERE idUser = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $email, $tlm, $data_nasc, $idUser);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            /*header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");
            */
            echo "erro da stmt execute <br/>";
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            echo "we did it";
            //REGIÃO
            if (!empty($_POST["regiao"])) {
                // APAGAR TODOS AS REGIÕES ASSOCIADAS AO USER
                $query2 = "DELETE FROM user_has_region
WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

                // INSERIR AS NOVAS REGIÕES ESCOLHIDAS
                $query3 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
              VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query3)) {

                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);

                    $idRegion = $_POST["regiao"];
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        echo "inseriu a região";
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                }
                /* close connection */
                mysqli_close($link);
            } //FIM DO ISSET DA REGIÃO
        }
        /* close statement */
        //mysqli_stmt_close($stmt);
        echo $idUser;
        //header("Location: ../edit_profile.php?edit=$idUser");
        echo "sucesso";
    } else {
        //header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");*/
        echo " erro do stmt prepare <br/>";
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    /* close connection */
    //mysqli_close($link);
}else {
    echo "faltam campos obrigatórios";
}
