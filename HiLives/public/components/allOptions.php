<?php
include "navbar_2.php";

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT idUser, name_user, name_interested_area, profile_img
          FROM users
          INNER JOIN user_has_areas ON users.idUser = user_has_areas.User_idUser
          INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas
          INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
          WHERE type_user = 'Universidade'
          ORDER BY idUser DESC";

$query2 = "SELECT idVacancies, vacancie_name, name_user, profile_img
           FROM vacancies
           INNER JOIN users ON vacancies.User_publicou = users.idUser
           ORDER BY idVacancies DESC";


?>

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
            mysqli_stmt_bind_result($stmt, $User_university, $name_user, $name_interested_area, $profile_img);
            mysqli_stmt_store_result($stmt); 
            if (mysqli_stmt_num_rows($stmt) > 0) { 
                while (mysqli_stmt_fetch($stmt)) {
        ?>
                    <div class="cards col-xs-12 col-sm-6 col-lg-4">
                        <div class="card-item">
                            <div class="card-image">
                                <?php
                                if (isset($profile_img)) {
                                ?>
                                    <img class="imagem_db" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt=" imagem da universidade <?= $name_user ?>" title="<?= $name_user ?>"/>
                                <?php
                                } else {
                                ?>
                                    <img class="imagem" src="img/def_uni.jpg" alt="imagem padrão" title="imagem padrão"/>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-info">
                                <h4 class="card-intro description_title">
                                    <i class="fas fa-book" style="color: #2f2f2f;"></i> Estudar
                                </h4>
                                <h2 class="card-title sub_title"><?= $name_interested_area ?></h2>
                                <?php
                                if (strlen($name_user) > 45) {
                                ?>
                                     <p class="card-intro description_title2"><?= substr($name_user, 0, 45) ?>...</p>
                                <?php
                                } else {
                                ?>
                                    <p class="card-intro description_title2"><?= $name_user ?></p>
                                <?php
                                }
                                ?>
                                <a href="profile.php?user=<?= $User_university ?>" class="btn_cards">Ver perfil</a>
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
                    Ainda não existem áreas disponíveis nas universidades.
                </p>
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
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $query2)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $name_user, $profile_img);
            mysqli_stmt_store_result($stmt); 
            if (mysqli_stmt_num_rows($stmt) > 0) { 
                while (mysqli_stmt_fetch($stmt)) {
        ?>
                    <div class="cards col-xs-12 col-sm-6 col-lg-4">
                        <div class="card-item">
                            <div class="card-image">
                                <?php
                                if (isset($profile_img)) {
                                ?>
                                    <img class="imagem_db" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="imagem da empresa <?= $name_user ?>" title="<?= $name_user ?>"/>
                                <?php
                                } else {
                                ?>
                                    <img class="imagem" src="img/def_comp.jpg" alt="imagem padrão" title="imagem padrão"/>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-info">
                                <h4 class="card-intro description_title">
                                    <i class="fa fa-briefcase" style="color: #2f2f2f;"></i> Trabalhar
                                </h4>
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
                                <a href="vacancie.php?vac=<?= $idVacancies ?>" class="btn_cards">Ver informação</a>
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
                    Ainda não existem vagas disponíveis.
                </p>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php
mysqli_close($link);
