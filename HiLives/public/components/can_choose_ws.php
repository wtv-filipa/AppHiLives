<?php
include "navbar_2.php";
if ($_SESSION["idUser"]) {

$idUser = $_SESSION["idUser"];

require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT id_match, User_university, Area, name_user, profile_img, favorite 
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser 
            WHERE User_young LIKE ?";

$query2 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON vacancies.User_publicou = users.idUser
            WHERE User_young LIKE ?";


?>

<div class="div_geral2 mx-auto">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title">As minhas ligações | Estudar e trabalhar</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="cards-circle">
        <div class="row">
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_match, $User_university, $Area, $name_user, $profile_img, $favorite);
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
                                        <i class="fas fa-book" aria-hidden="true"></i>Estudar</h4>
                                    <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                    <p class="card-intro description_title2"><?= $Area ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php

                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $profile_img2, $vacancie_name, $name_user);

                        while (mysqli_stmt_fetch($stmt)) {
                            ?>

                            <div class="card-container col-lg-4">
                                <div class="card">
                                    <?php
                                    if ($favorite == 0) {
                                        echo "";
                                        ?>
                                        <a href="scripts/update_fav.php?m=<?= $id_match ?>&f=<?= $favorite ?>">
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
                                        <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                            <div class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img2 ?>')"></div>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                            <div class="image" style="background-image: url('img/index_3.jpg')"></div>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                        <div class="card-info">
                                            <h4 class="card-intro description_title"><i class="fas fa-suitcase"></i>
                                                Trabalhar</h4>
                                            <h2 class="card-title sub_title"><?= $vacancie_name ?></h2>
                                            <p class="card-intro description_title2"><?= $name_user ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
}