<?php
include "navbar_2.php";
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"])) {
    $idUser = $_SESSION["idUser"];

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
                                    mysqli_stmt_store_result($stmt); 
                                    if (mysqli_stmt_num_rows($stmt) > 0) {
                                        while (mysqli_stmt_fetch($stmt)) {
                                ?>

                                            <li class='clearfix_uni mt-2'>
                                                <?php
                                                if ($favorite == 0) {
                                                    echo "";
                                                ?>
                                                    <button class="btn rounded-circle btn_fav fav" id="<?= $id_match ?>">
                                                        <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn rounded-circle btn_fav fav" id="<?= $id_match ?>">
                                                        <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i>
                                                    </button>
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
                                                <a href="profile.php?user=<?= $idUser1 ?>">
                                                    <p class="mb-0 link_info">
                                                        <i class="fas fa-book" aria-hidden="true"></i> Estudar
                                                    </p>
                                                    <h4 class="mb-0 link_title"><?= $name_user ?></h4>
                                                    <h5 class="mb-0 link_subtitle"><?= $Area ?></h5>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        ?>
                                        <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                            </svg>
                                            Ainda não adicionaste nenhuma área aos teus favoritos.
                                        </p>
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
                                $stmt = mysqli_stmt_init($link);
                                if (mysqli_stmt_prepare($stmt, $query2)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $vacancie_name, $name_user_emp, $profile_img_emp);
                                    mysqli_stmt_store_result($stmt); 
                                    if (mysqli_stmt_num_rows($stmt) > 0) { 
                                        while (mysqli_stmt_fetch($stmt)) {
                                ?>

                                            <li class='clearfix_uni mt-2'>
                                                <?php
                                                if ($favorite == 0) {
                                                ?>
                                                    <button class="btn rounded-circle btn_fav fav_emp" id="<?= $id_match_vac ?>">
                                                        <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn rounded-circle btn_fav fav_emp" id="<?= $id_match_vac ?>">
                                                        <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i>
                                                    </button>
                                                <?php
                                                }
                                                if (isset($profile_img)) {
                                                ?>
                                                    <img alt="" title="" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img_emp ?>">
                                                <?php
                                                } else {
                                                ?>
                                                    <img alt="" title="" class="tagpost_thumb" src="img/index_3.jpg">
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                if ($match_perc == 1) {
                                                ?>
                                                    <a href='vacancie.php?vac=<?= $Vacancies_idVacancies ?>'>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <a href='vacancie_learn.php?vac=<?= $Vacancies_idVacancies ?>'>
                                                        <?php
                                                    }
                                                        ?>
                                                        <p class="mb-0 link_info">
                                                            <i class="fas fa-suitcase" aria-hidden="true"></i> Trabalhar
                                                        </p>
                                                        <?php
                                                        if (strlen($vacancie_name) > 32) {
                                                        ?>
                                                            <h4 class="mb-0 link_title"><?= substr($vacancie_name, 0, 32) ?>...</h4>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <h4 class="mb-0 link_title"><?= $vacancie_name ?></h4>
                                                        <?php
                                                        }
                                                        ?>
                                                        <h5 class="mb-0 link_subtitle"><?= $name_user_emp ?></h5>
                                                        </a>
                                            </li>

                                        <?php
                                        }
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        ?>
                                        <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                            </svg>
                                            Ainda não adicionaste nenhuma vaga aos teus favoritos.
                                        </p>
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
} else {
    include("404.php");
}
mysqli_close($link);
