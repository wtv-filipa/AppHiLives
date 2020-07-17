<?php
include "navbar_2.php";

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"])) {
    $idUser = $_SESSION["idUser"];

    $query = "SELECT id_match, User_university, Area, name_user, profile_img, favorite 
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser 
            WHERE User_young = ?
            ORDER BY id_match DESC";

    $query2 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON vacancies.User_publicou = users.idUser
            WHERE User_young = ?
            ORDER BY id_match_vac DESC";


?>

    <div class="div_geral2 mx-auto">
        <div id='wrapper_title'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title">As minhas ligações | Estudar</h3>
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
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        while (mysqli_stmt_fetch($stmt)) {
                ?>
                            <div class="card-container col-lg-4">
                                <div class="card">
                                    <?php
                                    if ($favorite == 0) {
                                    ?>
                                        <button class="btn rounded-circle btn_fav fav" id="<?= $id_match ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i><span class="sr-only">(Marcar como favorito)</span>
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn rounded-circle btn_fav fav" id="<?= $id_match ?>">
                                            <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i><span class="sr-only">(Remover favorito)</span>
                                        </button>
                                    <?php
                                    }
                                    if (isset($profile_img)) {
                                    ?>
                                        <a href="profile.php?user=<?= $User_university ?>">
                                            <div role="img" alt="imagem da universidade <?= $name_user ?>" aria-label="imagem da universidade <?= $name_user ?>" class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="profile.php?user=<?= $User_university ?>">
                                            <div role="img" alt="imagem padrão" aria-label="imagem padrão" class="image" style="background-image: url('img/index_2.jpg')"></div>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    <div class="card-info">
                                        <h4 class="card-intro description_title">
                                            <i class="fas fa-book" aria-hidden="true"></i> Estudar</h4>
                                        <?php
                                        if (strlen($name_user) > 45) {
                                        ?>
                                            <h2 class="card-title sub_title"><?= substr($name_user, 0, 45) ?>...</h2>
                                        <?php
                                        } else {
                                        ?>
                                            <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                        <?php
                                        }
                                        ?>
                                        <p class="card-intro description_title2"><?= $Area ?></p>
                                        <a href="profile.php?user=<?= $User_university ?>">
                                            <p class="btn_cards card-intro description_title2">Ver perfil</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php

                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        ?>
                        <p class="mx-auto mt-3 mb-5" style="font-size: 1rem;">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                            </svg>
                            Ainda não existem ligações com universidades.
                        </p>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="div_geral2 mx-auto">
        <div id='wrapper_title'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title">As minhas ligações | Trabalhar</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="cards-circle">
            <div class="row">
                <?php
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $profile_img2, $vacancie_name, $name_user);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        while (mysqli_stmt_fetch($stmt)) {
                ?>

                            <div class="card-container col-lg-4">
                                <div class="card">
                                    <?php
                                    if ($favorite == 0) {
                                    ?>
                                        <button class="btn rounded-circle btn_fav fav_emp" id="<?= $id_match_vac ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i><span class="sr-only">(Marcar como favorito)</span>
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn rounded-circle btn_fav fav_emp" id="<?= $id_match_vac ?>">
                                            <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i><span class="sr-only">(Remover favorito)</span>
                                        </button>
                                    <?php
                                    }
                                    if (isset($profile_img)) {
                                    ?>
                                        <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                            <div role="img" alt="imagem da empresa <?= $name_user ?>" aria-label="imagem da empresa <?= $name_user ?>" class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img2 ?>')"></div>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                            <div role="img" alt="imagem padrão" aria-label="imagem padrão" class="image" style="background-image: url('img/index_3.jpg')"></div>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    <div class="card-info">
                                        <h4 class="card-intro description_title"><i class="fa fa-briefcase" style="color: #2f2f2f;"></i>
                                            Trabalhar</h4>
                                        <?php
                                        if (strlen($vacancie_name) > 40) {
                                        ?>
                                            <h2 class="card-title sub_title"><?= substr($vacancie_name, 0, 40) ?>...</h2>
                                        <?php
                                        } else {
                                        ?>
                                            <h2 class="card-title sub_title"><?= $vacancie_name ?></h2>
                                        <?php
                                        }
                                        ?>
                                        <p class="card-intro description_title2"><?= $name_user ?></p>
                                        <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                            <p class="btn_cards card-intro description_title2">Ver informação</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        ?>
                        <p class="mx-auto mt-3 mb-5" style="font-size: 1rem;">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                            </svg>
                            Ainda não existem ligações com vagas.
                        </p>
                <?php
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
