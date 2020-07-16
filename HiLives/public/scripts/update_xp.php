<?php
session_start();

require_once("../connections/connection.php");
$link = new_db_connection();
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
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../edit_xp.php?edit_xp=$id_xp");
            $_SESSION["xp_jovem"] = 1;
        } else {
            header("Location: ../profile.php?user=$id_navegar#xp_jovem");
            $_SESSION["xp_jovem"] = 2;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../edit_xp.php?edit_xp=$id_xp");
        $_SESSION["xp_jovem"] = 1;
    }
    mysqli_close($link);
} else {
    header("Location: ../edit_xp.php?edit_xp=$id_xp");
    $_SESSION["xp_jovem"] = 2;
}
