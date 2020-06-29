<?php
include "navbar_2.php";


if (isset($_GET["u"])) {
    $idUser = $_GET["u"];

    // We need the function!
    require_once("connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);
    //query que vai selecionar informações do user
    $query = "SELECT name_user, profile_img, history_ue
                FROM users
                WHERE idUser = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i',$idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_user, $profile_img, $history_ue);
        while (mysqli_stmt_fetch($stmt)) {
            ?>

<div class="w-75 mx-auto">
    <div class=mt-5">
        <h3 class="title mt-5 mb-4"><?= $name_user?></h3>
        <?php
        if (isset($profile_img)) {
            ?>
            <img class="img-fluid imagem mr-3 mb-2" src="../admin/uploads/img_perfil/<?= $profile_img ?>"
                 alt="<?= $profile_img ?>" align=left width="350px"/>
            <?php
        } else {
            ?>
            <img class="img-fluid imagem mr-3 mb-2" src="img/uni_icon.png" alt="sem imagem de perfil" align=left width="350px"/>
            <?php
        }
        ?>

        <p class="text-justify mb-4"><?= $history_ue ?></p>
    </div>
</div>
<?php
}
    }
}