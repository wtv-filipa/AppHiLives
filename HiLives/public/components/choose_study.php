<?php
include "navbar_2.php";

if (isset ($_SESSION["idUser"]) && isset($_SESSION["type"])) {

    $idUser = $_SESSION["idUser"];
    $type = $_SESSION["type"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_match, User_university, Area, name_user, profile_img, favorite 
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser 
            WHERE User_young = ?
            ORDER BY id_match DESC";

    $query2 = "SELECT id_match, User_young, Area, name_user, profile_img 
            FROM young_university 
            INNER JOIN users ON young_university.User_young = users.idUser 
            WHERE User_university = ?
            ORDER BY id_match DESC";

?>

            <div class="div_geral2 mx-auto">
                <div id='wrapper_title'>
                    <div class='tagpost-top section' id='tagpost-top'>
                        <div class='widget HTML' id='HTML5'>
                            <div data-aos="fade-up">
                                <?php
                                if ($type == 10) {
                                    echo " <h3 class=\"mb-4 main_title\">As minhas ligações | Estudar</h3>";
                                } else
                                if ($type == 13) {
                                    echo " <h3 class=\"mb-4 main_title\">As minhas ligações</h3>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cards-circle">
                    <div class="row">
                        <?php
                        if ($type == 10) {
                            if (mysqli_stmt_prepare($stmt, $query)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $id_match, $User_university, $Area, $name_user, $profile_img, $favorite);
                                mysqli_stmt_store_result($stmt); // Store the result into memory
                                if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                                    while (mysqli_stmt_fetch($stmt)) {
                        ?>
                                        <div class="card-container col-lg-4">
                                            <div class="card">
                                                <?php
                                                if ($favorite == 0) {
                                                    echo "";
                                                ?>
                                                    <a href="scripts/update_fav.php?match=<?= $id_match ?>&fav=<?= $favorite ?>">
                                                        <button class="btn rounded-circle btn_fav">
                                                            <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i>
                                                        </button>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="scripts/update_fav.php?match=<?= $id_match ?>&fav=<?= $favorite ?>">
                                                        <button class="btn rounded-circle btn_fav">
                                                            <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i>
                                                        </button>
                                                    </a>
                                                <?php
                                                }
                                                if (isset($profile_img)) {
                                                ?>
                                                    <a href="profile.php?user=<?= $User_university ?>">
                                                        <div class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="profile.php?user=<?= $User_university ?>">
                                                        <div class="image" style="background-image: url('img/index_2.jpg')"></div>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <a href="profile.php?user=<?= $User_university ?>">
                                                    <div class="card-info">
                                                        <h4 class="card-intro description_title">
                                                            <i class="fas fa-book" aria-hidden="true"></i>
                                                            Estudar</h4>
                                                        <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                                        <p class="card-intro description_title2"><?= $Area ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    /* close statement */
                                    mysqli_stmt_close($stmt);
                                } else {
                                    ?>
                                    <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                        </svg>
                                        Ainda não existem ligações com Universidades.
                                    </p>
                                    <?php
                                }
                            }
                        } else
                if ($type == 13) {
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $id_match, $User_young, $Area, $name_user, $profile_img);
                                mysqli_stmt_store_result($stmt); // Store the result into memory
                                if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                                    while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                        <div class="card-container col-lg-4">
                                            <div class="card">
                                                <?php
                                                if (isset($profile_img)) {
                                                ?>
                                                    <a href="profile.php?user=<?= $User_young ?>">
                                                        <div class="image mt-4" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="profile.php?user=<?= $User_young ?>">
                                                        <div class="image mt-4" style="background-image: url('img/def_jovem.png')"></div>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <a href="profile.php?user=<?= $User_young ?>">
                                                    <div class="card-info">
                                                        <h4 class="card-intro description_title">
                                                            <i class="fas fa-book" aria-hidden="true"></i> Estudar</h4>
                                                        <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                                        <p class="card-intro description_title2"><?= $Area ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    /* close statement */
                                    mysqli_stmt_close($stmt);
                                } else {
                                    ?>
                                    <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                        </svg>
                                        Ainda não existem ligações com Jovens.
                                    </p>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
<?php
} else {
    include("404.php");
}
/* close connection */
mysqli_close($link);
