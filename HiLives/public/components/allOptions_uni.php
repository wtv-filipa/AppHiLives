<?php
include "navbar_2.php";

if (isset($_SESSION["type"])) {
    $type = $_SESSION["type"];

    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idUser, name_user, name_interested_area, profile_img
            FROM users
            INNER JOIN user_has_areas ON users.idUser = user_has_areas.User_idUser
            INNER JOIN areas ON user_has_areas.Areas_idAreas = areas.idAreas
            INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
            WHERE type_user = 'Universidade'";

    $query2 = "SELECT idUser, name_user, profile_img
            FROM users
            INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
            WHERE type_user = 'Jovem'";
    ?>

    <!--UNIVERSIDADES-->
    <div class=" mx-auto div_geral2">
        <div id='wrapper_title' class="mb-4">
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div>
                        <?php
                        if ($type == 10) {
                            echo "<h3 class=\"main_title\">Todas as ligações | Universidades</h3>";
                        } else
                            if ($type == 13) {
                                echo "<h3 class=\"main_title\">Todos os candidatos possíveis</h3>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($type == 10) {
            ?>
            <div class="card-deck text-center row">
                <?php
                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_uni, $name_user, $name_interested_area, $profile_img);

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
                                        <img class="imagem" src="img/def_uni.jpg" alt="sem imagem de perfil"/>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="card-info">
                                    <h4 class="card-intro description_title">
                                        <i class="fas fa-book" style="color: #2f2f2f;"></i> Estudar
                                    </h4>
                                    <h2 class="card-title sub_title"><?= $name_interested_area ?></h2>
                                    <p class="card-intro description_title2"><?= $name_user ?></p>
                                    <a href="profile.php?user=<?= $id_uni ?>" class="btn_cards">Ver áreas disponíveis</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        } else
            if ($type == 13) {
                ?>
                <div class="card-deck text-center row">
                    <?php
                    if (mysqli_stmt_prepare($stmt, $query2)) {

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_jovem, $name_user, $profile_img);

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
                                            <img class="imagem" src="img/def_jovem_grande.jpg" alt="sem imagem de perfil"/>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="card-info">
                                        <h4 class="card-intro description_title">
                                            <i class="fas fa-book" style="color: #2f2f2f;"></i> Estudar
                                        </h4>
                                        <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                        <a href="profile.php?user=<?= $id_jovem ?>" class="btn_cards">Ver áreas disponíveis</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
        ?>
    </div>
    <?php


} else{
    include("404.php");
}