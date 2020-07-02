<?php
include "navbar_2.php";

if (isset($_SESSION["type"])) {

    $type = $_SESSION["type"];

    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

//query que vai mostrar todas as vagas
    $query = "SELECT idVacancies, vacancie_name, name_user, profile_img
                FROM vacancies
                INNER JOIN users ON vacancies.User_publicou = users.idUser";

    //query que vai mostrar todos os jovens da aplicação
    $query2 = "SELECT idUser, name_user, profile_img
                FROM users
                INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
                WHERE type_user = 'Jovem'";

    ?>
            <!--EMPRESAS-->
            <div class=" mx-auto div_geral2">
                <div id='wrapper_title' class="mb-4">
                    <div class='tagpost-top section' id='tagpost-top'>
                        <div class='widget HTML' id='HTML5'>
                            <div>
                                <?php
                                if ($type == 10) {
                                    echo "<h3 class=\"main_title\">Todas as ligações | Empresas</h3>";
                                } else
                                    if ($type == 13) {
                                        echo "<h3 class=\"main_title\">Todas as vagas de empresas</h3>";
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
                            mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $name_user, $profile_img);

                            while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                <div class="cards col-xs-12 col-sm-6 col-lg-4">
                                    <div class="card-item">
                                        <div class="card-image">
                                            <?php
                                            if (isset($profile_img)) {
                                                ?>
                                                <img class="imagem_db" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                <?php
                                            } else {
                                                ?>
                                                <img class="imagem" src="img/def_comp.png" alt="sem imagem de perfil">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="card-info">
                                            <h4 class="card-intro description_title">
                                                <i class="fa fa-briefcase mr-1" style="color: #2f2f2f;" aria-hidden="true"></i>Trabalhar</h4>
                                            <h2 class="card-title sub_title"><?= $vacancie_name ?></h2>
                                            <p class="card-intro description_title2"><?=  $name_user?></p>
                                            <a href="vacancie.php?vac=<?= $idVacancies ?>" class="btn_cards">Ver informação</a>
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
                            if (mysqli_stmt_prepare($stmt, $query)) {

                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $name_user, $profile_img);

                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <div class="cards col-xs-12 col-sm-6 col-lg-4">
                                        <div class="card-item">
                                            <div class="card-image">
                                                <?php
                                                if (isset($profile_img)) {
                                                    ?>
                                                    <img class="imagem_db" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="imagem" src="img/def_comp.png" alt="sem imagem de perfil">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="card-info">
                                                <h4 class="card-intro description_title">
                                                    <i class="fa fa-briefcase mr-1" style="color: #2f2f2f;" aria-hidden="true"></i>Trabalhar</h4>
                                                <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                                <p class="card-intro description_title2"><?= $vacancie_name ?></p>
                                                <a href="vacancie.php?vac=<?= $idVacancies ?>" class="btn_cards">Ver informação</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        if ($type == 7) {
                            ?>
                            <div class="card-deck text-center row">
                                <?php
                                if (mysqli_stmt_prepare($stmt, $query2)) {

                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $idUser, $name_user, $profile_img);

                                    while (mysqli_stmt_fetch($stmt)) {
                                        ?>
                                        <div class="cards col-xs-12 col-sm-6 col-lg-4">
                                            <div class="card-item">
                                                <div class="card-image">
                                                    <?php
                                                    if (isset($profile_img)) {
                                                        ?>
                                                        <img class="imagem_db" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img class="imagem" src="img/def_jovem_grande.jpg" alt="sem imagem de perfil">
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="card-info">
                                                    <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                                    <p class="card-intro description_title2"></p>
                                                    <a href="profile.php?user=<?= $idUser ?>" class="btn_cards">Ver perfil</a>
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
                    }
                ?>
                <!--fim do que engloba os cards-->
            </div> <!-- div da w-75-->
            <?php
} else{
    include("404.php");
}
