<?php
session_start();
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
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../edit_profile.php?edit=$idUser");
            $_SESSION["erro"] = 1;
        } else {
            //REGIÃO
            if (!empty($_POST["regiao"])) {
                // APAGAR TODOS AS REGIÕES ASSOCIADAS AO USER
                $query2 = "DELETE FROM user_has_region
WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$idUser");
                        $_SESSION["erro"] = 1;
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../edit_profile.php?edit=$idUser");
                    $_SESSION["erro"] = 1;
                }

                $stmt = mysqli_stmt_init($link);
                // INSERIR AS NOVAS REGIÕES ESCOLHIDAS
                $query3 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
              VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query3)) {

                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);

                    $idRegion = $_POST["regiao"];
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$idUser");
                        $_SESSION["erro"] = 1;
                    }
                    /* close statement */
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../edit_profile.php?edit=$idUser");
                    $_SESSION["erro"] = 1;
                }
                /* close connection */
                mysqli_close($link);
            } //FIM DO ISSET DA REGIÃO
        }
        //SUCCESS
        header("Location: ../index.php");
        $_SESSION["erro"] = 2;
    } else {
        header("Location: ../edit_profile.php?edit=$idUser");
        $_SESSION["erro"] = 1;
    }
} else {
    header("Location: ../edit_profile.php?edit=$idUser");
    $_SESSION["erro"] = 2;
}
