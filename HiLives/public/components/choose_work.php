<?php
include "navbar_2.php";

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
//query para mostrar os match dependendo do perfil
    $query0 = "SELECT type_user FROM users
            INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
            WHERE idUser = ?";
//query para mostrar os match dos jovens com as vagas
    $query = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, profile_img, vacancie_name
            FROM user_has_vacancies
            INNER JOIN users ON user_has_vacancies.User_young = users.idUser
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
            WHERE User_young LIKE ?";

    $query2 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON users.idUser = user_has_vacancies.User_young
            WHERE User_publicou LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query0)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $type_user);

        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <!------------------------MATCH--------------------->
            <div class="w-75 mx-auto">
                <div id='wrapper_title'>
                    <div class='tagpost-top section' id='tagpost-top'>
                        <div class='widget HTML' id='HTML5'>
                            <div data-aos="fade-up">
                                <?php
                                if ($type_user == "Jovem") {
                                    ?>
                                    <h3 class="mb-1 main_title">Vagas de trabalho que posso escolher</h3>
                                    <p>Aqui encontras as vagas onde cumpres todos os requisitos</p>
                                    <?php
                                } else
                                    if ($type_user == "Empresa") {
                                        ?>
                                        <h3 class="mb-1 main_title">Os meus candidatos</h3>
                                        <p>Aqui encontra todos os candidatos para as suas vagas</p>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-slider mt-5">
                    <?php
                    if ($type_user == "Jovem") {
                        if (mysqli_stmt_prepare($stmt, $query)) {

                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $profile_img, $vacancie_name);

                            while (mysqli_stmt_fetch($stmt)) {
                                if ($match_perc == 1) {
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="card w-100">
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
                                                <div class="image"
                                                     style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="image"
                                                     style="background-image: url('img/index_3.jpg')"></div>
                                                <?php
                                            }
                                            ?>
                                            <div class="card-info">
                                                <h4 class="card-intro description_title"><i class="fas fa-suitcase"></i>
                                                    Trabalhar</h4>
                                                <h2 class="card-title sub_title"><?= $vacancie_name ?></h2>
                                                <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>">
                                                    <p class="btn_cards card-intro description_title2">Ver descrição da
                                                        vaga</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    } else {
                        if ($type_user == "Empresa") {
                            if (mysqli_stmt_prepare($stmt, $query2)) {

                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $profile_img, $vacancie_name, $name_user);

                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($match_perc == 1) {
                                        ?>
                                        <div class="col-lg-12">
                                            <div class="card w-100">
                                                <?php
                                                if (isset($profile_img)) {
                                                    ?>
                                                    <div class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="image" style="background-image: url('img/def_jovem.png')"></div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="card-info">
                                                    <h4 class="card-intro description_title">
                                                        <i class="fas fa-suitcase"></i> <?= $vacancie_name ?>
                                                    </h4>
                                                    <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                                    <a href="profile.php?user=<?= $User_young ?>">
                                                        <p class="btn_cards card-intro description_title2">Ver perfil</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>

            <!------------------------PERCURSO DE APRENDIZAGEM--------------------->
            <div class="w-75 mx-auto">
                <div id='wrapper_title'>
                    <div class='tagpost-top section' id='tagpost-top'>
                        <div class='widget HTML' id='HTML5'>
                            <div data-aos="fade-up">
                                <?php
                                if ($type_user == "Jovem") {
                                    ?>
                                    <h3 class="mb-1 main_title">Ainda não foi desta...</h3>
                                    <p> Vê o que precisas de fazer para cumprires os requisitos destas vagas</p>
                                    <?php
                                } else
                                    if ($type_user == "Empresa") {
                                        ?>
                                        <h3 class="mb-1 main_title">Candidatos para percurso de aprendizagem</h3>
                                        <p>Aqui encontra todos os candidatos que dão quase ligação com as suas vagas</p>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-slider mt-5">
                    <?php
                    if ($type_user == "Jovem") {

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $profile_img, $vacancie_name);

                            while (mysqli_stmt_fetch($stmt)) {
                                if ($match_perc == 0) {
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="card w-100">
                                            <a href="vacancie_learn.php">
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
                                                    <div class="image"
                                                         style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="image"
                                                         style="background-image: url('img/index_3.jpg')"></div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="card-info">
                                                    <h4 class="card-intro description_title">
                                                        <i class="fas fa-suitcase"></i>Trabalhar</h4>
                                                    <h2 class="card-title sub_title"><?= $vacancie_name ?></h2>
                                                    <a href="">
                                                        <p class="btn_cards card-intro description_title2">Ver o que me falta</p>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    } else {
                        if ($type_user == "Empresa") {
                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $profile_img, $vacancie_name, $name_user);

                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($match_perc == 0) {
                                        ?>
                                        <div class="col-lg-12">
                                            <div class="card w-100">
                                                <a href="vacancie_learn.php">
                                                    <?php
                                                    if (isset($profile_img)) {
                                                        ?>
                                                        <div class="image"
                                                             style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="image" style="background-image: url('img/def_jovem.png')"></div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="card-info">
                                                        <h4 class="card-intro description_title">
                                                            <i class="fas fa-suitcase"></i> <?= $vacancie_name ?>
                                                        </h4>
                                                        <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                                        <a href="profile.php?user=<?= $User_young ?>">
                                                            <p class="btn_cards card-intro description_title2">Ver perfil</p>
                                                        </a>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>


            <?php
        }
    }
}