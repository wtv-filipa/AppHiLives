<?php
include "navbar_2.php";
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {

    $idUser = $_SESSION["idUser"];
    $type = $_SESSION["type"];

    //query para mostrar os match dos jovens com as vagas
    $query = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, name_user, profile_img, vacancie_name
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON  vacancies.User_publicou = users.idUser
            WHERE User_young = ? AND match_perc = 1";

    $query2 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON users.idUser = user_has_vacancies.User_young
            WHERE User_publicou = ? AND match_perc = 1";

    $query3 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, name_user, profile_img, vacancie_name
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON  vacancies.User_publicou = users.idUser
            WHERE User_young = ? AND match_perc = 0";

    $query4 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON users.idUser = user_has_vacancies.User_young
            WHERE User_publicou = ? AND match_perc = 0";

?>
    <!------------------------MATCH--------------------->
    <div class="w-75 mx-auto">
        <div id='wrapper_title'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <?php
                        if ($type == 10) {
                        ?>
                            <h3 class="mb-1 main_title">Vagas de trabalho que posso escolher</h3>
                            <p style="opacity:0.8; font-size: 14px;">Aqui encontras todas as ligações com vagas de emprego que estão completas, ou seja, cumpres todos os requisitos e capacidades necessários para te candidatares. Lembra-te que tens de contactar a empresa caso estejas interessado na sua vaga.</p>
                        <?php
                        } else if ($type == 7) {
                        ?>
                            <h3 class="mb-1 main_title">Os meus candidatos</h3>
                            <p style="opacity:0.8; font-size: 14px;">Aqui encontra todas as ligações com candidatos a vagas de emprego, onde estes cumprem todos os requisitos e capacidades necessários para se candidatarem.</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-slider mt-4">
            <?php
            if ($type == 10) {
                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $name_user, $profile_img, $vacancie_name);
                    mysqli_stmt_store_result($stmt); // Store the result into memory
                    if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                        while (mysqli_stmt_fetch($stmt)) {
            ?>
                            <div class="col-lg-12">
                                <div class="card w-100">
                                    <?php
                                    if ($favorite == 0) {
                                        echo "";
                                    ?>
                                        <a href="scripts/update_fav.php?m=<?= $id_match_vac ?>&f=<?= $favorite ?>">
                                            <button class="btn rounded-circle btn_fav">
                                                <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i><span class="sr-only">(Marcar como favorito)</span>
                                            </button>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="scripts/update_fav.php?m=<?= $id_match_vac ?>&f=<?= $favorite ?>">
                                            <button class="btn rounded-circle btn_fav">
                                                <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i><span class="sr-only">(Remover favorito)</span>
                                            </button>
                                        </a>
                                    <?php
                                    }
                                    if (isset($profile_img)) {
                                    ?>
                                        <div role="img" alt="imagem da empresa <?=$name_user?>" aria-label="imagem da empresa <?=$name_user?>" class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                    <?php
                                    } else {
                                    ?>
                                        <div role="img" alt="imagem padrão" aria-label="imagem padrão" class="image" style="background-image: url('img/index_3.jpg')"></div>
                                    <?php
                                    }
                                    ?>
                                    <div class="card-info">
                                        <h4 class="card-intro description_title"><i class="fas fa-suitcase"></i>
                                            Trabalhar</h4>
                                        <?php
                                        if (strlen($vacancie_name) > 48) {
                                        ?>
                                            <h2 class="card-title sub_title"><?= substr($vacancie_name, 0, 48) ?>...</h2>
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
                        /* close statement */
                        mysqli_stmt_close($stmt);
                    } else {
                        ?>
                        <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                            </svg>
                            Ainda não existem ligações com vagas.
                        </p>
                        <?php
                    }
                }
            } else {
                if ($type == 7) {
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $profile_img, $vacancie_name, $name_user);
                        mysqli_stmt_store_result($stmt); // Store the result into memory
                        if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                            while (mysqli_stmt_fetch($stmt)) {
                        ?>
                                <div class="col-lg-12">
                                    <div class="card w-100">
                                        <?php
                                        if (isset($profile_img)) {
                                        ?>
                                            <div role="img" alt="imagem do jovem <?=$name_user?>" aria-label="imagem do jovem <?=$name_user?>" class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                        <?php
                                        } else {
                                        ?>
                                            <div role="img" alt="imagem padrão" aria-label="imagem padrão" class="image" style="background-image: url('img/def_jovem.png')"></div>
                                        <?php
                                        }
                                        ?>
                                        <div class="card-info">
                                            <h4 class="card-intro description_title">
                                                <i class="fas fa-suitcase"></i> Trabalhar
                                            </h4>
                                            <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                            <?php
                                            if (strlen($vacancie_name) > 48) {
                                            ?>
                                                <p class="card-intro description_title2"><?= substr($vacancie_name, 0, 48) ?>...</p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="card-intro description_title2"><?= $vacancie_name ?></p>
                                            <?php
                                            }
                                            ?>
                                            <a href="profile.php?user=<?= $User_young ?>">
                                                <p class="btn_cards card-intro description_title2">Ver perfil</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            /* close statement */
                            mysqli_stmt_close($stmt);
                        } else {
                            ?>
                            <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                </svg>
                                Ainda não existem ligações com jovens. Crie novas vagas e comece a criar ligações!
                            </p>
            <?php
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
                        if ($type == 10) {
                        ?>
                            <h3 class="mb-1 main_title"> Estás quase lá, vê o que tens em falta!</h3>
                            <p style="opacity:0.8;"> Aqui econtras todas as ligações com vagas de empresas onde te falta cumprir apenas duas ou três capacidades. Podes abrir cada uma para descobrires o que tens em falta para preencheres. Lembra-te que tens de contactar a empresa caso estejas interessado na sua vaga.</p>
                        <?php
                        } else if ($type == 7) {
                        ?>
                            <h3 class="mb-1 main_title">Candidatos para percurso de aprendizagem</h3>
                            <p style="opacity:0.8;">Aqui encontra todas as ligações com candidatos a vagas onde apenas falta cumprir duas ou três capacidades.</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-slider mt-4">
            <?php
            if ($type == 10) {
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query3)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $name_user, $profile_img, $vacancie_name);
                    mysqli_stmt_store_result($stmt); // Store the result into memory
                    if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                        while (mysqli_stmt_fetch($stmt)) {
            ?>
                            <div class="col-lg-12">
                                <div class="card w-100">
                                    <?php
                                    if ($favorite == 0) {
                                        echo "";
                                    ?>
                                        <a href="scripts/update_fav.php?m=<?= $id_match_vac ?>&f=<?= $favorite ?>">
                                            <button class="btn rounded-circle btn_fav">
                                                <i class="fa fa-heart-o" aria-hidden="true" style="color: #2F2F2F"></i><span class="sr-only">(Marcar como favorito)</span>
                                            </button>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="scripts/update_fav.php?m=<?= $id_match_vac ?>&f=<?= $favorite ?>">
                                            <button class="btn rounded-circle btn_fav">
                                                <i class="fa fa-heart" aria-hidden="true" style="color: #A31621"></i><span class="sr-only">(Remover favorito)</span>
                                            </button>
                                        </a>
                                    <?php
                                    }
                                    if (isset($profile_img)) {
                                    ?>
                                        <div role="img" alt="imagem da empresa <?=$name_user?>" aria-label="imagem da empresa <?=$name_user?>" class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                    <?php
                                    } else {
                                    ?>
                                        <div role="img" alt="imagem padrão" aria-label="imagem padrão" class="image" style="background-image: url('img/index_3.jpg')"></div>
                                    <?php
                                    }
                                    ?>
                                    <div class="card-info">
                                        <h4 class="card-intro description_title">
                                            <i class="fas fa-suitcase"></i>Trabalhar</h4>
                                        <?php
                                        if (strlen($vacancie_name) > 48) {
                                        ?>
                                            <h2 class="card-title sub_title"><?= substr($vacancie_name, 0, 48) ?>...</h2>
                                        <?php
                                        } else {
                                        ?>
                                            <h2 class="card-title sub_title"><?= $vacancie_name ?></h2>
                                        <?php
                                        }
                                        ?>
                                        <p class="card-intro description_title2"><?= $name_user ?></p>
                                        <a href="vacancie_learn.php?vac=<?= $Vacancies_idVacancies ?>">
                                            <p class="btn_cards card-intro description_title2">Ver o que me falta</p>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        /* close statement */
                        mysqli_stmt_close($stmt);
                    } else {
                        ?>
                        <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                            </svg>
                            Ainda não foi criado nenhum percurso de aprendizagem.
                        </p>
                        <?php
                    }
                }
            } else if ($type == 7) {
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query4)) {
                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $profile_img, $vacancie_name, $name_user);
                    mysqli_stmt_store_result($stmt); // Store the result into memory
                    if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                        while (mysqli_stmt_fetch($stmt)) {
                        ?>
                            <div class="col-lg-12">
                                <div class="card w-100">
                                    <a href="vacancie_learn.php">
                                        <?php
                                        if (isset($profile_img)) {
                                        ?>
                                            <div role="img" alt="imagem do jovem <?=$name_user?>" aria-label="imagem do jovem <?=$name_user?>" class="image" style="background-image: url('../admin/uploads/img_perfil/<?= $profile_img ?>')"></div>
                                        <?php
                                        } else {
                                        ?>
                                            <div role="img" alt="imagem padrão" aria-label="imagem padrão" class="image" style="background-image: url('img/def_jovem.png')"></div>
                                        <?php
                                        }
                                        ?>
                                        <div class="card-info">
                                            <h4 class="card-intro description_title">
                                                <i class="fas fa-suitcase"></i> Trabalhar
                                            </h4>
                                            <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                            <?php
                                            if (strlen($vacancie_name) > 48) {
                                            ?>
                                                <p class="card-intro description_title2"><?= substr($vacancie_name, 0, 48) ?>...</p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="card-intro description_title2"><?= $vacancie_name ?></p>
                                            <?php
                                            }
                                            ?>
                                            <a href="profile.php?user=<?= $User_young ?>">
                                                <p class="btn_cards card-intro description_title2">Ver perfil</p>
                                            </a>
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
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                            </svg>
                            Ainda não existe nenhum percurso de aprendizagem.
                        </p>
            <?php
                    }
                }
            }

            ?>
        </div>
    </div>


<?php
} else {
    include("404.php");
}
/* close connection */
mysqli_close($link);
