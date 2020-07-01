<?php
session_start();
// We need the function!
require_once("../connections/connection.php");
// Create a new DB connection
$link = new_db_connection();
/* create a prepared statement */
$stmt = mysqli_stmt_init($link);

$id_xp = $_GET["update_xp"];

if (isset($_GET["update_xp"]) && isset($_SESSION["idUser"]) && !empty($_POST["nomeVideo"])) {
    $id_navegar = $_SESSION["idUser"];
    $title_exp = $_POST['nomeVideo'];
    $description = $_POST['descricao'];

    $query = "UPDATE experiences
      SET title_exp = ?, description = ?
      WHERE idExperiences = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssi', $title_exp, $description, $id_xp);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            //ERRO
            header("Location: ../edit_xp.php?edit_xp=$id_xp");
            $_SESSION["xp_jovem"] = 1;
            //echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            //SUCESSO
            header("Location: ../profile.php?user=$id_navegar#xp_jovem");
            $_SESSION["xp_jovem"] = 2;
        }
    } else {
        //ERRO
        header("Location: ../edit_xp.php?edit_xp=$id_xp");
        $_SESSION["xp_jovem"] = 1;
        //echo "Error: " . mysqli_stmt_error($stmt);
    }
} else {
    //ERRO
    header("Location: ../edit_xp.php?edit_xp=$id_xp");
    $_SESSION["xp_jovem"] = 2;
}
