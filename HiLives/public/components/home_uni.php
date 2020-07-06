<?php
include "navbar_2.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT idUser, name_user, profile_img FROM users 
            WHERE User_type_idUser_type = 10 
            ORDER BY idUser DESC 
            LIMIT 6";

$query2 = "SELECT idUser, name_user, profile_img, history_ue FROM users 
            WHERE User_type_idUser_type = 13
            LIMIT 2";

$query3 = "SELECT idVacancies, vacancie_name, name_user, profile_img, name_interested_area FROM vacancies
            INNER JOIN users ON vacancies.User_publicou = users.idUser
            INNER JOIN areas ON vacancies.Areas_idAreas = areas.idAreas
            LIMIT 6";
?>
<div class="w-75 mx-auto list_links">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title adjustment_top">Últimas entradas de jovens</h3>
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
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $idUser, $name_user, $profile_img);
                                mysqli_stmt_store_result($stmt); // Store the result into memory
                                if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                                    while (mysqli_stmt_fetch($stmt)) {
                            ?>
                                        <li class='clearfix_uni'>
                                            <?php
                                            if (isset($profile_img)) {
                                            ?>
                                                <img alt="<?= $profile_img ?>" title="" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                            <?php
                                            } else {
                                            ?>
                                                <img alt="" title="" class="tagpost_thumb" src="img/def_jovem.png">
                                            <?php
                                            }
                                            ?>
                                            <p class="mb-0 link_title mt-4"><?= $name_user ?></p>
                                            <p class="mb-0 link_subtitle">
                                                <p class="mb-0 link_subtitle"><a href="profile.php?user=<?= $idUser ?>"> Ver perfil</a></p>
                                        </li>
                                    <?php
                                    }
                                    /* close statement */
                                    mysqli_stmt_close($stmt);
                                } else {
                                    ?>
                                    <p class="mx-auto mt-3 mb-5" style="font-size: 1rem;">
                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
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
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idUser, $name_user, $profile_img);
                mysqli_stmt_store_result($stmt); // Store the result into memory
                if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                    if (mysqli_stmt_fetch($stmt)) {
            ?>
                        <a href="allOptions_uni.php">
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


<!--CARDS-->
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
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $query2)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idUser, $name_user, $profile_img, $history_ue);
            mysqli_stmt_store_result($stmt); // Store the result into memory
            if (mysqli_stmt_num_rows($stmt) >= 2) { // Check the number of rows returned
                while (mysqli_stmt_fetch($stmt)) {
        ?>
                    <div class="cards col-xs-12 col-md-6">
                        <div class="card-item">

                            <div class="card-image">
                                <?php
                                if (isset($profile_img)) {
                                ?>
                                    <img alt="<?= $profile_img ?>" title="" class="imagem" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                <?php
                                } else {
                                ?>
                                    <img alt="" title="" class="imagem" src="img/destaque.jpg">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-info">
                                <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                <p class="card-intro description_title"><?= substr($history_ue, 0, 168) ?>...</p>
                                <a href="about_university.php?u=<?= $idUser ?>">
                                    <button class="btn_destaques">Ver mais</button>
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
                <p class="mx-auto mt-3 mb-5" style="font-size: 1rem;">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                    </svg>
                    Ainda não existe nenhum destaque para mostrar.
                </p>
        <?php
            }
        }
        ?>
    </div>
</div>


<div class="w-75 mx-auto list_links">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title adjustment_top">Últimas vagas publicadas por empresas</h3>
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
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $name_user, $profile_img, $name_interested_area);
                                mysqli_stmt_store_result($stmt); // Store the result into memory
                                if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                                    while (mysqli_stmt_fetch($stmt)) {
                            ?>
                                        <a href="vacancie.php?vac=<?= $idVacancies ?>">
                                            <li class='clearfix_companies'>
                                                <?php
                                                if (isset($profile_img)) {
                                                ?>
                                                    <img alt="<?= $profile_img ?>" title="" class="tagpost_thumb" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                <?php
                                                } else {
                                                ?>
                                                    <img alt="" title="" class="tagpost_thumb" src="img/index_3.jpg">
                                                <?php
                                                }
                                                ?>
                                                <p class="mb-0 link_info">
                                                    <i class="fa fa-briefcase mr-1" aria-hidden="true"></i><?= $name_user ?>
                                                </p>
                                                <p class="mb-0 link_title"><?= $vacancie_name ?></p>
                                                <p class="mb-0 link_subtitle"><?= $name_interested_area ?></p>
                                            </li>
                                        </a>
                                    <?php
                                    }
                                    /* close statement */
                                    mysqli_stmt_close($stmt);
                                } else {
                                    ?>
                                    <p class="mx-auto mt-3 mb-5" style="font-size: 1rem;">
                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                        </svg>
                                        Ainda não existe nenhuma vaga para mostrar.
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
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $name_user, $profile_img, $name_interested_area);
                mysqli_stmt_store_result($stmt); // Store the result into memory
                if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                    if (mysqli_stmt_fetch($stmt)) {
            ?>
                        <a href="">
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
<?php
/* close connection */
mysqli_close($link);
