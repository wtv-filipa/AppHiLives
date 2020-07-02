<?php
include "navbar_2.php";

if ($_SESSION["idUser"]) {
$idUser = $_SESSION["idUser"];

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT Area, name_user, profile_img, id_match, favorite, idUser
            FROM young_university
            INNER JOIN users ON young_university.User_university = users.idUser
            WHERE User_young = ? AND favorite=1";

$query2 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, vacancie_name, name_user, profile_img
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
            INNER JOIN users ON vacancies.User_publicou = users.idUser
            WHERE User_young = ? AND favorite=1";
?>
<div class="w-75 mx-auto list_links">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title">Os meus favoritos de estudar</h3>
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
                                mysqli_stmt_bind_result($stmt, $Area, $name_user, $profile_img, $id_match, $favorite, $idUser1);
                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <a href="profile.php?user=<?= $idUser1 ?>">
                                        <li class='clearfix_uni mt-2'>
                                            <?php
                                            if ($favorite == 0) {
                                                echo "";
                                                ?>
                                            <a href="scripts/update_fav.php?match=<?= $id_match ?>&fav=<?= $favorite ?>">
                                                <button class="btn rounded-circle btn_fav">
                                                    <i class="fa fa-heart-o" aria-hidden="true"
                                                       style="color: #2F2F2F"></i>
                                                </button>
                                            </a>
                                            <?php
                                            } else {
                                            ?>
                                            <a href="scripts/update_fav.php?match=<?= $id_match ?>&fav=<?= $favorite ?>">
                                                <button class="btn rounded-circle btn_fav">
                                                    <i class="fa fa-heart" aria-hidden="true"
                                                       style="color: #A31621"></i>
                                                </button>
                                            </a>
                                            <?php
                                            }
                                            if (isset($profile_img)) {
                                                ?>
                                                <img alt="" title="" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                <?php
                                            } else {
                                                ?>
                                                <img alt="" title="" class="tagpost_thumb" src="img/index_2.jpg">
                                                <?php
                                            }
                                            ?>
                                            <p class="mb-0 link_info">
                                                <i class="fas fa-book" aria-hidden="true"></i> Estudar
                                            </p>
                                            <a href='profile.php?user=<?= $idUser1 ?>'>
                                                <h4 class="mb-0 link_title"><?= $name_user ?></h4>
                                                <h5 class="mb-0 link_subtitle"><?= $Area ?></h5>
                                            </a>
                                        </li>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="w-75 mx-auto list_links">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title">Os meus favoritos de trabalhar</h3>
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
                        if (mysqli_stmt_prepare($stmt, $query2)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $vacancie_name, $name_user_emp, $profile_img_emp);
                            while (mysqli_stmt_fetch($stmt)) {

                                if($match_perc == 1){
                                    ?>
                                    <a href='vacancie.php?vac=<?= $Vacancies_idVacancies ?>'>
                                    <?php
                                } else {
                                    ?>
                                        <a href='vacancie_learn.php?vac=<?= $Vacancies_idVacancies ?>'>
                                            <?php
                                }
                                ?>
                                <li class='clearfix_uni mt-2'>
                                    <?php
                                    if ($favorite == 0) {
                                        echo "";
                                        ?>
                                        <a href="scripts/update_fav.php?m=<?= $id_match_vac ?>&f=<?= $favorite ?>">
                                            <button class="btn rounded-circle btn_fav">
                                                <i class="fa fa-heart-o" aria-hidden="true"
                                                   style="color: #2F2F2F"></i>
                                            </button>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="scripts/update_fav.php?m=<?= $id_match_vac ?>&f=<?= $favorite ?>">
                                            <button class="btn rounded-circle btn_fav">
                                                <i class="fa fa-heart" aria-hidden="true"
                                                   style="color: #A31621"></i>
                                            </button>
                                        </a>
                                        <?php
                                    }
                                    if (isset($profile_img)) {
                                        ?>
                                        <img alt="" title="" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?=$profile_img_emp?>">
                                        <?php
                                    } else {
                                        ?>
                                        <img alt="" title="" class="tagpost_thumb" src="img/index_3.jpg">
                                        <?php
                                    }
                                    ?>
                                    <p class="mb-0 link_info">
                                        <i class="fas fa-suitcase" aria-hidden="true"></i> Trabalhar
                                    </p>
                                    <?php
                                    if($match_perc == 1){
                                    ?>
                                    <a href='vacancie.php?vac=<?= $Vacancies_idVacancies ?>'>
                                        <?php
                                        } else {
                                        ?>
                                        <a href='vacancie_learn.php?vac=<?= $Vacancies_idVacancies ?>'>
                                            <?php
                                            }
                                    ?>
                                        <h4 class="mb-0 link_title"><?= $vacancie_name ?></h4>
                                        <h5 class="mb-0 link_subtitle"><?= $name_user_emp ?></h5>
                                    </a>
                                </li>
                            </a>
                                <?php
                            }
                        }
                                ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}