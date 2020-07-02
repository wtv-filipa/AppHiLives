<?php
include "navbar_2.php";


$query = "SELECT id_match, User_university, Area, name_user, profile_img, favorite 
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser";

$query2 = "SELECT id_match_vac, User_young, Vacancies_idVacancies, match_perc, favorite, profile_img, vacancie_name, name_user
            FROM user_has_vacancies
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies 
            INNER JOIN users ON vacancies.User_publicou = users.idUser";


?>
<!--UNIVERSIDADES-->
<div class=" mx-auto div_geral2">
    <div id='wrapper_title' class="mb-4">
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div>
                    <h3 class="main_title">Todas as opções disponíveis | Estudar </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card-deck text-center row">
        <?php
        if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_match, $User_university, $Area, $name_user, $profile_img, $favorite);
        while (mysqli_stmt_fetch($stmt)) {
        ?>
        <div class="cards col-xs-12 col-sm-6 col-lg-4">
            <div class="card-item">
                <div class="card-image">
                    <?php
                    if (isset($profile_img)) {
                        ?>
                        <img class="imagem_db" src="../admin/uploads/img_perfil/<?= $profile_img ?>"
                             alt="<?= $profile_img ?>"/>
                        <?php
                    } else {
                        ?>
                        <img class="imagem" src="img/INDEX_2.jpg" alt="sem imagem de perfil"/>
                        <?php
                    }
                    ?>
                </div>
                <div class="card-info">
                    <h4 class="card-intro description_title">
                        <i class="fas fa-book" style="color: #2f2f2f;"></i> Estudar
                    </h4>
                    <h2 class="card-title sub_title"><?= $name_user ?></h2>
                    <a href="profile.php?user=<?= $User_university ?>" class="btn_cards">Ver áreas disponíveis</a>
                </div>
            </div>
        </div>
        <?php
        }
        }
        ?>
    </div>
</div>



<div class=" mx-auto div_geral2">
    <div id='wrapper_title' class="mb-4">
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div>
                    <h3 class="main_title">Todas as opções disponíveis | Trabalhar </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card-deck text-center row">
        <?php
        if (mysqli_stmt_prepare($stmt, $query2)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id_match_vac, $User_young, $Vacancies_idVacancies, $match_perc, $favorite, $profile_img, $vacancie_name, $name_user);
            while (mysqli_stmt_fetch($stmt)) {
                ?>
                <div class="cards col-xs-12 col-sm-6 col-lg-4">
                    <div class="card-item">
                        <div class="card-image">
                            <?php
                            if (isset($profile_img)) {
                                ?>
                                <img class="imagem_db" src="../admin/uploads/img_perfil/<?= $profile_img ?>"
                                     alt="<?= $profile_img ?>"/>
                                <?php
                            } else {
                                ?>
                                <img class="imagem" src="img/INDEX_2.jpg" alt="sem imagem de perfil"/>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="card-info">
                            <h4 class="card-intro description_title">
                                <i class="fas fa-book" style="color: #2f2f2f;"></i> Estudar
                            </h4>
                            <h2 class="card-title sub_title"><?= $vacancie_name ?></h2>
                            <a href="vacancie.php?vac=<?= $Vacancies_idVacancies ?>" class="btn_cards">Ver áreas disponíveis</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>