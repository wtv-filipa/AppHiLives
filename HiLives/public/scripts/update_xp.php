<?php
// We need the function!
require_once("../connections/connection.php");
// Create a new DB connection
$link = new_db_connection();
/* create a prepared statement */
$stmt = mysqli_stmt_init($link);
if (isset($_GET["update_xp"]) && !empty($_POST["nomeVideo"])) {
    $id_xp = $_GET["update_xp"];
    $title_exp = $_POST['nomeVideo'];
    $description = $_POST['descricao'];

    $query = "UPDATE experiences
      SET title_exp = ?, description = ?
      WHERE idExperiences = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssi', $title_exp, $description, $id_xp);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            /*header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");
            */
            echo "erro da stmt execute <br/>";
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            echo "we did it";
            header("Location: ../edit_xp.php?edit_xp=$id_xp");
        }
    } else {
        /* $nickname = $_POST["edit"];
            echo $nickname;
            header("Location: ../editar_conta.php?edit=" . $nickname . "&msg=1");*/
        echo " erro do stmt prepare <br/>";
        echo "Error: " . mysqli_stmt_error($stmt);
    }
} else {
    echo "página não encontrada";
}
