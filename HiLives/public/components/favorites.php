

<?php
include "navbar_2.php";


if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT Area, name_user, profile_img, id_match, favorite
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser
            WHERE User_young LIKE ? AND favorite=1";

    ?>


    <div class="w-75 mx-auto list_links">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title">Os meus favoritos</h3>
                </div>
            </div>
        </div>
    </div>

    <div id='wrapper'>
    <div id='recenttags'>
    <div class='tagpost-top section' id='tagpost-top'>
    <div class='widget HTML' id='HTML5'>
    <div class='widget-content'>

            <ul class='taglabel'>
    <?php
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Area, $name_user, $profile_img, $id_match, $favorite);

        while (mysqli_stmt_fetch($stmt)) {
            ?>
                <li class='clearfix_uni mt-2'>
                    <a href="">
                        <?php
                        if (isset($profile_img)) {
                            ?>
                            <img alt="<?= $profile_img ?>" title="" class="tagpost_thumb"
                                 src="../uploads/img_perfil/<?= $profile_img ?>">
                            <?php
                        } else {
                            ?>
                            <img alt="imagem de perfil default da universidade" title="" class="tagpost_thumb"
                                 src="img/index_2.jpg">
                            <?php
                        }
                        ?>
                        <?php

                        if ($favorite == 0){
                            ?>
                            <a href="scripts/update_fav.php?match=<?= $id_match?>&fav=<?= $favorite?>"> <button class="btn rounded-circle btn_fav"><i class="fa fa-heart-o" aria-hidden="true"  style="color: #2F2F2F"></i></button></a>
                            <?php
                        } else {
                            ?>
                            <a href="scripts/update_fav.php?match=<?= $id_match?>&fav=<?= $favorite?>"> <button class="btn rounded-circle btn_fav"><i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i> </button></a>
                            <?php
                        }
                        ?>

                        <p class="mb-0 link_info"><i class="fa fa-book mr-1" aria-hidden="true"></i>Estudar
                        </p>
                        <h4 class="mb-0 link_title"><?= $name_user ?></h4>
                        <h5 class="mb-0 link_subtitle"><?= $Area ?></h5>
                    </a>
                </li>     <?php
        }
        ?>
            </ul>

        </div>
        <div class='clear'></div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <?php
    }
} else {
    include("404.php");
}
?>