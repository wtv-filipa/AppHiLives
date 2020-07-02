<?php
include "navbar_2.php";

if ($_SESSION["idUser"]) {
    $idUser = $_SESSION["idUser"];

    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON users.idUser = user_has_vacancies.User_young
            WHERE User_publicou LIKE ?";
    ?>
    <div class="w-75 mx-auto list_links">
        <div id='wrapper_title'>

            <div class='tagpost-top section adjustment_top' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title adjustment_top">Ligações recentes</h3>
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
                                mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $profile_img, $vacancie_name, $name_user);

                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($match_perc == 1) {
                                        ?>
                                <li class='clearfix_companies'>
                                        <?php
                                        if (isset($profile_img)) {
                                        ?>
                                        <a href="profile.php?user=<?= $User_young?>">
                                            <img alt="Imagem da FNAC2" title="" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="profile.php?user=<?= $User_young?>">
                                            <img alt="Imagem da FNAC2" title="" class="tagpost_thumb" src="img/def_jovem.png">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1" aria-hidden="true"></i><?= $vacancie_name ?></p>
                                    <p class="mb-0 link_title"><?= $name_user ?></p>
                                </li>
                                        <?php
                                    }
                                }
                            }
                                        ?>
                            </ul>
                        </div>
                        <div class='clear'></div>
                    </div>
                </div>
            </div>
            <div id='footer'>
                <a href="">
                    <button class="btn_cards mx-auto">Ver mais</button>
                </a>
            </div>
        </div>
    </div>
    <?php
}
