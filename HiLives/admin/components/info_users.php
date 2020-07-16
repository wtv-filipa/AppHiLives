<?php
if (isset($_GET["info"])) {
    $idUser = $_GET["info"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, info_young, work_xp, profile_img, website_ue, facebook_ue, instagram_ue, description_ue, history_ue, Educ_lvl_idEduc_lvl, active, type_user
    FROM users INNER JOIN user_type ON users.User_type_idUser_type= user_type.idUser_type
    WHERE idUser = ?";

    $query2 = "SELECT name_interested_area FROM areas INNER JOIN user_has_areas ON  areas.idAreas= user_has_areas.Areas_idAreas INNER JOIN users ON user_has_areas.User_idUser=users.idUser WHERE idUser=?";

    $query3 = "SELECT name_education FROM educ_lvl INNER JOIN users ON educ_lvl.idEduc_lvl=users.Educ_lvl_idEduc_lvl WHERE idUser=?";

    $query4 = "SELECT capacity FROM capacities INNER JOIN capacities_has_users ON capacities.idcapacities = capacities_has_users.capacities WHERE users_idUser = ?";

    $query5 = "SELECT name_region FROM region INNER JOIN user_has_region ON region.idRegion= user_has_region.Region_idRegion INNER JOIN users ON user_has_region.User_idUser_region=users.idUser WHERE idUser=?";

    $query6 = "SELECT name_environment FROM work_environment INNER JOIN work_environment_has_users ON work_environment.idwork_environment = work_environment_has_users.favorite_environment WHERE users_idUser = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $info_young, $work_xp, $profile_img, $website_ue, $facebook_ue, $instagram_ue, $description_ue, $history_ue, $Educ_lvl_idEduc_lvl, $active, $type_user);
        while (mysqli_stmt_fetch($stmt)) {
            $dob = $birth_date;
            $age = (date('Y') - date('Y', strtotime($dob)));
?>
            <h1 class="h3 mb-2">Informações do utilizador</h1>
            <p class="mb-4">Aqui é possível visualizar outras informações acerca do utilizador selecionado previamente.</p>
            <div class="card text-center">

                <form class="mt-3 form-horizontal row" role="form">

                    <div class="col-md-4">
                        <div class="text-center">
                            <?php
                            if (isset($profile_img)) {
                            ?>
                                <img class="image_profile" src="uploads/img_perfil/<?= $profile_img; ?>" alt="<?= $profile_img ?>" />
                            <?php
                            } else {
                            ?>
                                <img class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" />
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="col-md-8">

                        <div class="text-left">
                            <h5 for="nome">Nome: <span style="font-size: 16px;"><?= $name_user ?></span></h5>
                        </div>
                        <hr>

                        <div class="text-left">
                            <h5 for="nome">Email: <span style="font-size: 16px;"><?= $email_user ?></span></h5>
                        </div>
                        <hr>

                        <?php
                        if ($type_user == "Jovem") {
                        ?>
                            <div class="text-left">
                                <h5 for="nome">Idade: <span style="font-size: 16px;"><?= $age ?> anos</span></h5>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-left">
                                <h5 for="nome">Data de fundação: <span style="font-size: 16px;"><?= $birth_date ?></span></h5>
                            </div>
                        <?php
                        }
                        ?>
                        <hr>

                        <div class="text-left">
                            <h5 for="nome">Contacto telefónico: <span style="font-size: 16px;"><?= $contact_user ?></span></h5>
                        </div>
                        <hr>

                        <?php
                        if ($type_user == "Jovem") {
                        ?>

                            <div class="text-left">
                                <h5 for="nome">Detalhes sobre o jovem: <span style="font-size: 16px;"><?= $info_young ?></span></h5>
                            </div>
                            <hr>

                            <?php
                            if (mysqli_stmt_prepare($stmt, $query3)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                if (mysqli_stmt_execute($stmt)) {

                                    mysqli_stmt_bind_result($stmt, $name_education);

                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo " <div class='text-left'>
                                           <h5 for='nome'>Escolaridade: <span style='font-size: 16px;'>$name_education</span></h5>
                                       </div>
                                       <hr>";
                                    }
                                }
                            }
                            ?>

                            <div class='text-left'>
                                <h5 for='nome'>Áreas de interesse: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $query2)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $name_interested_area);

                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<ul>
                                            <li  style='font-size: 16px; font-family: Quicksand; list-style-type:circle;'>$name_interested_area</li>
                                            </ul>";
                                        }
                                    }
                                }
                                ?>

                            </div>
                            <hr>

                            <div class='text-left'>
                                <h5 for='nome'>Regiões de interesse: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $query5)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $name_region);

                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<ul>
                                            <li  style='font-size: 16px; font-family: Quicksand; list-style-type:circle;'>$name_region</li>
                                            </ul>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <hr>

                            <div class='text-left'>
                                <h5 for='nome'>Capacidades: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $query4)) {

                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $capacity);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "<ul>
                                            <li  style='font-size: 16px; font-family: Quicksand; list-style-type:circle;'>$capacity</li>
                                            </ul>";
                                    }
                                }
                                ?>
                            </div>
                            <hr>

                            <div class='text-left'>
                                <h5 for='nome'>Ambientes de trabalho preferidos: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $query6)) {

                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $name_environment);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "<ul>
                                            <li  style='font-size: 16px; font-family: Quicksand; list-style-type:circle;'>$name_environment</li>
                                            </ul>";
                                    }
                                }
                                ?>

                                <div class="text-left">
                                    <h5 for="nome">Experiência de trabalho: <span style="font-size: 16px;"><?= $work_xp ?></span></h5>
                                </div>
                                <hr>
                            <?php
                        } else if ($type_user == "Empresa") {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Website: <span style="font-size: 16px;"><?= $website_ue ?></span></h5>
                                </div>
                                <hr>

                                <div class="text-left">
                                    <h5 for="nome">Facebook: <span style="font-size: 16px;"><?= $facebook_ue ?></span></h5>
                                </div>
                                <hr>

                                <div class="text-left">
                                    <h5 for="nome">Instagram: <span style="font-size: 16px;"><?= $instagram_ue ?></span></h5>
                                </div>
                                <hr>

                                <div class='text-left'>
                                    <h5 for='nome'>Região da empresa:
                                        <?php

                                        if (mysqli_stmt_prepare($stmt, $query5)) {
                                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                            if (mysqli_stmt_execute($stmt)) {
                                                mysqli_stmt_bind_result($stmt, $name_region);

                                                while (mysqli_stmt_fetch($stmt)) {
                                                    echo "<span style='font-size: 16px;'> $name_region</span>";
                                                }
                                            }
                                        }
                                        ?>
                                    </h5>
                                    <hr>

                                    <div class="text-left">
                                        <h5 for="nome">Descrição: <span style="font-size: 16px;"><?= $description_ue ?></span></h5>
                                    </div>
                                    <hr>
                                <?php
                            } else if ($type_user == "Universidade") {
                                ?>
                                    <div class="text-left">
                                        <h5 for="nome">Website: <span style="font-size: 16px;"><?= $website_ue ?></span></h5>
                                    </div>
                                    <hr>

                                    <div class="text-left">
                                        <h5 for="nome">Facebook: <span style="font-size: 16px;"><?= $facebook_ue ?></span></h5>
                                    </div>
                                    <hr>

                                    <div class="text-left">
                                        <h5 for="nome">Instagram: <span style="font-size: 16px;"><?= $instagram_ue ?></span></h5>
                                    </div>
                                    <hr>

                                    <div class='text-left'>
                                        <h5 for='nome'>Áreas de oferta: </h5>
                                        <?php
                                        if (mysqli_stmt_prepare($stmt, $query2)) {
                                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                            if (mysqli_stmt_execute($stmt)) {
                                                mysqli_stmt_bind_result($stmt, $name_interested_area);

                                                while (mysqli_stmt_fetch($stmt)) {
                                                    echo "<ul>
                                            <li  style='font-size: 16px; font-family: Quicksand; list-style-type:circle;'>$name_interested_area</li>
                                            </ul>";
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                    <hr>

                                    <div class='text-left'>
                                        <h5 for='nome'>Região da Universidade:
                                            <?php
                                            if (mysqli_stmt_prepare($stmt, $query5)) {
                                                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $name_region);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        echo "<span style='font-size: 16px;'> $name_region</span>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </h5>
                                        <hr>

                                        <div class="text-left">
                                            <h5 for="nome">Descrição: <span style="font-size: 16px;"><?= $description_ue ?></span></h5>
                                        </div>
                                        <hr>

                                        <div class="text-left">
                                            <h5 for="nome">História: <span style="font-size: 16px;"><?= $history_ue ?></span></h5>
                                        </div>
                                        <hr>
                                    <?php
                                }
                                    ?>

                                    <div class="form-group mt-5">
                                        <div class="col-md-8">
                                            <a class="col-xs-12 col-md-6" href="#" data-toggle="modal" data-target="#deleteModal<?= $idUser ?>"> <button class="btn cancel_btn"><i class="fas fa-trash"></i> Apagar utilizador</button></a>
                                            <span></span>
                                            <?php
                                            if ($active == 1) {
                                            ?>
                                                <a class="col-xs-12 col-md-6" href="#" data-toggle="modal" data-target="#activeModal<?= $idUser ?>">
                                                    <button class="btn cancel_btn"><i class="fas fa-ban"></i> Bloquear utilizador</button>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a class="col-xs-12 col-md-6" href="#" data-toggle="modal" data-target="#inactiveModal<?= $idUser ?>">
                                                    <button class="btn cancel_btn"><i class="fas fa-ban"></i> Desbloquear utilizador</button>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    </div>
                </form>
            </div>

<?php
            
            include('components/active_modal.php');
            
            include('components/delete_modal.php');
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
} 
?>