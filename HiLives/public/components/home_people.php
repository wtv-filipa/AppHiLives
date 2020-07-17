<?php
include "navbar_2.php";

if ($_SESSION["idUser"]) {
    $idUser = $_SESSION["idUser"];

    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "SELECT Area, name_user, profile_img, id_match, user_university, favorite
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser
            WHERE User_young = ? 
            ORDER BY id_match DESC 
            LIMIT 6";

    $query3 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON users.idUser = vacancies.User_publicou
            WHERE User_young = ? AND match_perc = 1";
  

?>
    <input type="hidden" id="show_modal" value="<?php echo isset($_GET['model']) && $_GET['model'] === true ? 1 : 0; ?>">
    <div class="w-75 mx-auto list_links">
        <div id='wrapper_title'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title">Ligações recentes com universidades</h3>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include('components/modal_vid_explain.php');
        ?>
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
                                    mysqli_stmt_bind_result($stmt, $Area, $name_user, $profile_img, $id_match, $user_university, $favorite);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) > 0) {
                                        while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                            <li class='clearfix_uni'>
                                                <a href="">
                                                    <?php
                                                    if (isset($profile_img)) {
                                                    ?>
                                                        <a href="profile.php?user=<?= $user_university ?>">
                                                            <img alt="<?= $profile_img ?>" title="<?= $name_user ?>" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                        </a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="profile.php?user=<?= $user_university ?>">
                                                            <img alt="imagem de perfil default da universidade" title="Imagem padrão" class="tagpost_thumb" src="img/index_2.jpg">
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php

                                                    if ($favorite == 0) {
                                                    ?>
                                                        <button class="btn rounded-circle btn_fav fav" id="<?= $id_match ?>"><i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i><span class="sr-only">(Marcar como favorito)</span></button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn rounded-circle btn_fav fav" id="<?= $id_match ?>"><i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i><span class="sr-only">(Remover favorito)</span></button>
                                                    <?php
                                                    }
                                                    ?>

                                                    <p class="mb-0 link_info"><i class="fa fa-book mr-1" aria-hidden="true"></i>Estudar</p>
                                                    <a href="profile.php?user=<?= $user_university ?>">
                                                        <h4 class="mb-0 link_title"><?= $name_user ?></h4>
                                                        <h5 class="mb-0 link_subtitle"><?= $Area ?></h5>
                                                    </a>

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
                                            Ainda não tens nenhuma ligação com universidades.
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
                    mysqli_stmt_bind_result($stmt, $Area, $name_user, $profile_img, $id_match, $user_university, $favorite);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        if (mysqli_stmt_fetch($stmt)) {
                ?>
                            <a href="can_choose_study.php">
                                <button class="btn_cards mx-auto">Ver todas</button>
                            </a>
                <?php
                        }
                        /* close statement */
                        mysqli_stmt_close($stmt);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!--CARDS DESTAQUES-->
    <div class="w-75 mx-auto">
        <div id='wrapper_title'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title">Destaques</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row container_highlights ">
            <?php

            $query4 = "SELECT COUNT(idUser) FROM users WHERE User_type_idUser_type = 13";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $query4)) {

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $nr_total);

                if (mysqli_stmt_fetch($stmt)) {

                    $array_destaques = array();
                    $registos_mostra = 2;

                    if ($nr_total >= $registos_mostra) {

                        for ($i = 1; $i <= $registos_mostra; $i++) {

                            $n_ale = rand(1, $nr_total);
                            $registo_ja_existe = in_array($n_ale, $array_destaques);

                            if ($registo_ja_existe == "") {
                                array_push($array_destaques, $n_ale);

                                $offset = $n_ale - 1;
                                $query2 = "SELECT idUser, name_user, profile_img, history_ue FROM users 
                            WHERE User_type_idUser_type = 13
                            LIMIT 1 OFFSET $offset";
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query2)) {

                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $id_uni, $name_user, $profile_img, $history_ue);

                                    mysqli_stmt_fetch($stmt2)
            ?>

                                    <div class="cards col-xs-12 col-md-6">
                                        <div class="card-item">

                                            <div class="card-image">
                                                <?php
                                                if (isset($profile_img)) {
                                                ?>
                                                    <img alt="<?= $profile_img ?>" title="<?= $name_user ?>" class="imagem" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                <?php
                                                } else {
                                                ?>
                                                    <img alt="imagem de perfil default da universidade" title="Imagem padrão" class="imagem" src="img/destaque.jpg">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="card-info">
                                                <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                                <p class="card-intro description_title"><?= substr($history_ue, 0, 168) ?>...</p>
                                                <a href="about_university.php?u=<?= $id_uni ?>">
                                                    <button class="btn_destaques">Ver mais</button>
                                                </a>
                                            </div>

                                        </div>
                                    </div>


                        <?php
                                }
                                mysqli_stmt_close($stmt2);
                            } else {
                                $i--;
                            }
                        }
                    } else {
                        ?>
                        <p class="mx-auto mt-3 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                            </svg>
                            Ainda não existe nenhum destaque para te mostrar.
                        </p>
            <?php
                    }
                }

                mysqli_stmt_close($stmt);
            }

            ?>
        </div>
    </div>


    <div class="w-75 mx-auto list_links">
        <div id='wrapper_title'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title adjustment_top">Ligações recentes com empresas</h3>
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
                                if (mysqli_stmt_prepare($stmt, $query3)) {

                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $profile_img, $vacancie_name, $name_user);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) > 0) {
                                        while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                            <li class='clearfix_companies'>
                                                <?php
                                                if ($favorite == 0) {
                                                ?>
                                                    <button class="btn rounded-circle btn_fav fav_emp" id="<?= $id_match_vac ?>">
                                                        <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i><span class="sr-only">(Marcar como favorito)
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn rounded-circle btn_fav fav_emp" id="<?= $id_match_vac ?>">
                                                        <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i><span class="sr-only">(Remover favorito)
                                                    </button>
                                                <?php
                                                }
                                                if (isset($profile_img)) {
                                                ?>
                                                    <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                                        <img alt="Imagem da <?= $name_user ?>" title="<?= $name_user ?>" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                                        <img alt="Imagem da <?= $name_user ?>" title="<?= $name_user ?>" class="tagpost_thumb" src="img/index_3.jpg">
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1" aria-hidden="true"></i>Trabalhar
                                                </p>
                                                <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
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
                                                    <h5 class="mb-0 link_subtitle"><?= $name_user ?></h5>
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
                                            Ainda não tens nenhuma ligação com vagas publicadas por empresas.
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
                if (mysqli_stmt_prepare($stmt, $query3)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $profile_img, $vacancie_name, $name_user);
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
