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
            WHERE User_publicou = ? AND match_perc = 1";
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
                                    mysqli_stmt_store_result($stmt); 
                                    if (mysqli_stmt_num_rows($stmt) > 0) { 
                                        while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                            <li class='clearfix_companies'>
                                                <?php
                                                if (isset($profile_img)) {
                                                ?>
                                                    <a href="profile.php?user=<?= $User_young ?>">
                                                        <img alt="Imagem de perfil do jovem" title="<?= $name_user ?>" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="profile.php?user=<?= $User_young ?>">
                                                        <img alt="Imagem default do jovem" title="Imagem default" class="tagpost_thumb" src="img/def_jovem.png">
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if (strlen($vacancie_name) > 45) {
                                                ?>
                                                    <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1" aria-hidden="true"></i><?= substr($vacancie_name, 0, 45) ?>...</p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1" aria-hidden="true"></i><?= $vacancie_name ?></p>
                                                <?php
                                                }
                                                ?>
                                                <a href="profile.php?user=<?= $User_young ?>">
                                                    <p class="mb-0 link_title"><?= $name_user ?></p>
                                                </a>
                                            </li>
                                        <?php


                                        }
                                       
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        ?>
                                        <p class="mx-auto mt-3 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                            </svg>
                                            Ainda não tem nenhuma ligação com jovens.
                                        </p>
                                <?php
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
                <?php
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $profile_img, $vacancie_name, $name_user);
                    mysqli_stmt_store_result($stmt); 
                    if (mysqli_stmt_num_rows($stmt) > 0) { 
                        if (mysqli_stmt_fetch($stmt)) {
                ?>
                            <a href="can_choose_work.php">
                                <button class="btn_cards mx-auto">Ver todas</button>
                            </a>
                <?php
                        }
                        mysqli_stmt_close($stmt);
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php
    mysqli_close($link);
} else {
    include("404.php");
}
