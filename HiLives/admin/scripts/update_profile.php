<?php
session_start();
if (isset($_GET["id"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["data_nasc"])) {
    echo "estou a editar o administrador";
    $idUser = $_GET["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tlm = $_POST["phone"];
    $data_nasc = $_POST["data_nasc"];
   
    require_once("../connections/connection.php");
   
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "UPDATE users
      SET name_user = ?, email_user=?, contact_user=?, birth_date = ?
      WHERE idUser = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $email, $tlm, $data_nasc, $idUser);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../edit_profile.php?edit=$idUser");
            $_SESSION["erro"] = 1;
        } else {
            
            if (!empty($_POST["regiao"])) {
                $query2 = "DELETE FROM user_has_region
WHERE User_idUser_region = ?";

                if (mysqli_stmt_prepare($stmt, $query2)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$idUser");
                        $_SESSION["erro"] = 1;
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../edit_profile.php?edit=$idUser");
                    $_SESSION["erro"] = 1;
                }

                $stmt = mysqli_stmt_init($link);
                $query3 = "INSERT INTO user_has_region (User_idUser_region, Region_idRegion)
              VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt, $query3)) {

                    mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idRegion);

                    $idRegion = $_POST["regiao"];
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../edit_profile.php?edit=$idUser");
                        $_SESSION["erro"] = 1;
                    }
                   
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../edit_profile.php?edit=$idUser");
                    $_SESSION["erro"] = 1;
                }
                mysqli_close($link);
            }
        }
        
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
