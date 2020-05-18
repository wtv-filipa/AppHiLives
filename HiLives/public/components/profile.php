<?php

if (isset($_GET["user"]) && $_SESSION["idUser"]) {

    $idUser = $_GET["user"];
    $id_navegar = $_SESSION["idUser"];


    if ($idUser == $id_navegar) {

        // We need the function!
        require_once("connections/connection.php");
        // Create a new DB connection
        $link = new_db_connection();
        /* create a prepared statement */
        $stmt = mysqli_stmt_init($link);
        $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, profile_img, website_ue, facebook_ue, instagram_ue, description_ue, type_user FROM users INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type WHERE idUser LIKE ?";

        $query2 = "SELECT User_idUser, Areas_idAreas, name_interested_area
    FROM user_has_areas INNER JOIN areas ON user_has_areas.Areas_idAreas= areas.idAreas
    WHERE User_idUser LIKE ?";

        $query3 = "SELECT idDone_CU, Cu_name, University_name, date_CU
    FROM done_cu WHERE User_idUser LIKE ? LIMIT 3";

        $query4 = "SELECT idVacancies, vacancie_name, Areas_idAreas, name_interested_area
                    FROM vacancies
                    INNER JOIN areas ON vacancies.Areas_idAreas = areas.idAreas
                    WHERE User_publicou LIKE ? LIMIT 3";
        ?>

        <div class="w-75 mx-auto largura">
            <div class="row mt-5 perfil_info">
                <div class="col-xs-3 col-lg-3 ">
                    <?php
                    if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $profile_img, $website_ue, $facebook_ue, $instagram_ue, $description_ue, $type_user);
                    while (mysqli_stmt_fetch($stmt)) {
                    $dob = $birth_date;
                    $age = (date('Y') - date('Y', strtotime($dob)));
                    if (isset($profile_img)) {
                        ?>
                        <img class="image_profile" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" />
                        <?php
                    } else {
                        ?>
                        <img class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil"/>


                        <?php
                    }
                    ?>
                </div>

                <?php
                if ($type_user == "Jovem") {

                    ?>
                    <div class="col-xs-3 col-lg-9 ">
                        <h3 class="mt-2 nome_user"><?= $name_user ?></h3>
                        <h6 class="mt-3 subtitulo"> <?= $age ?> anos | Personalidade</h6>
                        <div class="p-0 mt-3">
                            <a href="edit_profile.php?edit=<?= $idUser ?>">
                                <button class="btn edit_btn">
                                    <i class="teste fas fa-edit"></i>
                                    Editar as minhas informações
                                </button>
                            </a>
                        </div>
                    </div>
                    <?php

                    //UNIVERSIDADES E EMPRESAS

                } else {

                    ?>
                    <div class="col-xs-3 col-lg-9">
                        <h3 class="mt-2 nome_user"><?= $name_user ?></h3>
                        <div class="p-0 mt-3">
                            <a href="edit_profile.php?edit=<?= $idUser ?>">
                                <button class="btn edit_btn"> <i class="fas fa-edit text-dark"></i>Editar as minhas informações</button>
                            </a>
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <p class="mt-5 subtitulo"><?= $description_ue ?> </p>
                    </div>

                    <?php
                }


                }

                }
                ?>
            </div>

            <hr class="mt-4">

            <!-----CARDS DE INFORMAÇÃO------->
            <div class="row mt-5">

                <?php
                if ($type_user == "Jovem") {
                    ?>
                    <!--PRIMEIRO CARD-INFORMAÇÃO DAS DISCIPLINAS FEITAS-->
                    <div class="col-md-6">
                        <div class="card tamanho_card_tablet">
                            <div class="card-header estudo">
                                <h5>Últimas disciplinas que fiz</h5>
                            </div>
                            <div class="card-body altura">
                                <blockquote class="blockquote mb-0">
                                     <?php
                                    if (mysqli_stmt_prepare($stmt, $query3)) {

                                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $idDone_CU,$Cu_name, $University_name, $date_CU);
                                        while (mysqli_stmt_fetch($stmt)) {
                                            ?>
                                            <ul id="notebook_ul">
                                                <li class="lista">
                                                    <?= $Cu_name?>
                                                    <p class="instituicao"><?=$University_name?></p>
                                                   <a href="edit_done_uc.php?uc=<?=$idDone_CU?>"> <p class="instituicao" style="color:#00A5CF!important; text-align: right"><i class="fas fa-edit mr-1 " style="color:#00A5CF!important"></i>Editar</p></a>

                                                </li>

                                            </ul>
                                            <?php
                                        }
                                    }
                                     ?>

                                    <div class="text-center">
                                        <a href="done_uc.php">
                                            <button class="btn add_btn">Adicionar novas disciplinas</button>
                                        </a>
                                    </div>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <!------------------------------------------>

                    <?php
                } else if ($type_user == "Universidade") {
                    ?>
                    <!--PRIMEIRO CARD-INFORMAÇÃO DAS ÁREAS DISPONÍVEIS-->
                    <div class="col-md-6">
                        <div class="card tamanho_card_tablet">
                            <div class="card-header estudo">
                                <h5>Áreas disponíveis</h5>
                            </div>
                            <div class="card-body altura">
                                <blockquote class="blockquote mb-0">
                                    <ul id="notebook_ul">
                                        <li class="lista">
                                            Cibercultura
                                            <p class="instituicao"> Universidade de Aveiro</p>
                                        </li>
                                        <li class="lista">
                                            Interação e Interfaces
                                            <p class="instituicao"> Universidade de Aveiro</p>
                                        </li>
                                        <li class="lista">
                                            Laboratório Multimédia
                                            <p class="instituicao"> Universidade de Aveiro</p>
                                        </li>
                                        <li class="lista">
                                            Gestão de Empresas
                                            <p class="instituicao"> Universidade de Aveiro</p>
                                        </li>
                                        <li class="lista">
                                            Sociologia
                                            <p class="instituicao"> Universidade de Aveiro</p>
                                        </li>

                                    </ul>
                                    <div class="text-center">
                                        <a href="done_uc.php">
                                            <button class="btn add_btn">Adicionar novas disciplinas</button>
                                        </a>
                                    </div>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <?php
                } else if ($type_user == "Empresa") {
                    ?>

                    <!--PRIMEIRO CARD-INFORMAÇÃO DAS VAGAS-->
                    <div class="col-md-6">
                        <div class="card tamanho_card_tablet">
                            <div class="card-header estudo">
                                <h5>Vagas</h5>
                            </div>
                            <div class="card-body altura">
                                <blockquote class="blockquote mb-0">
                                    <?php
                                    if (mysqli_stmt_prepare($stmt, $query4)) {

                                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $idVacancie, $vacancie_name, $Areas_idAreas, $name_interested_area);
                                        while (mysqli_stmt_fetch($stmt)) {
                                            ?>
                                            <ul id="notebook_ul">
                                                <li class="lista">
                                                    <?= $vacancie_name?>
                                                    <p class="instituicao"><?=$name_interested_area?></p>
                                                    <a href="edit_vac.php?idvac=<?=$idVacancie?>"> <p class="instituicao" style="color:#00A5CF!important; text-align: right"><i class="fas fa-edit mr-1 " style="color:#00A5CF!important"></i>Editar</p></a>

                                                </li>

                                            </ul>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="text-center">
                                        <a href="upload_vac.php">
                                            <button class="btn add_btn">Adicionar nova vaga</button>
                                        </a>
                                    </div>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <!--SEGUNDO CARD- INFORMAÇÃO DAS ÁREAS DE PREFERÊNCIA (JOVENS) E CONTACTOS (UNIVERSIDADES E EMPRESAS)-->

                <?php
                if ($type_user == "Jovem") {

                    ?>
                    <div class="col-md-6">
                        <div class="card tamanho_card_tablet">
                            <div class="card-header estudo">
                                <h5>As minhas áreas de interesse</h5>
                            </div>
                            <div class="card-body altura">
                                <blockquote class="blockquote mb-0">
                                    <?php
                                    if (mysqli_stmt_prepare($stmt, $query2)) {

                                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $User_idUser, $Areas_idAreas, $name_interested_area);
                                        while (mysqli_stmt_fetch($stmt)) {
                                            ?>
                                            <ul id="notebook_ul">
                                                <li class="lista">
                                                    <?= $name_interested_area ?>
                                                </li>
                                            </ul>
                                            <?php
                                        }
                                    }
                                    ?>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <?php
                } else {
                    ?>
                    <div class="col-md-6 mb-5">
                        <div class="card tamanho_card_tablet">
                            <div class="card-header estudo">
                                <h5>Contactos</h5>
                            </div>
                            <div class="card-body altura" style="padding-top: 20px !important;>
                                <blockquote class="blockquote mb-0 mt-4">
                                    <ul id="notebook_ul">
                                        <li class="lista">
                                            <i class="fas fa-at mr-2"></i><b class="mr-2">Email:</b><?= $email_user ?>
                                        </li>
                                        <li class="lista">
                                            <i class="fas fa-phone-alt mr-2"></i><b class="mr-2">Telefone:</b><?= $contact_user ?>
                                        </li>

                                        <?php
                                        if (isset($website_ue)) {
                                            ?>

                                            <li class="lista">
                                                <i class="fas fa-globe mr-2"></i><b class="mr-2">Website:</b><?= $website_ue ?>
                                            </li>
                                            <?php
                                        }
                                            if (isset($facebook_ue)) {
                                                ?>
                                            <li class="lista">
                                                <i class="fab fa-facebook mr-2"></i><b class="mr-2">Facebook:</b><?= $facebook_ue ?>
                                            </li>
                                                <?php
                                            }
                                        if (isset($instagram_ue)) {
                                            ?>
                                            <li class="lista">
                                                <i class="fab fa-instagram mr-2"></i><b class="mr-2">Instagram:</b> <?= $instagram_ue ?>
                                            </li>

                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!--fim da div row-->
            </div>

        <?php
        if ($type_user == "Jovem") {

            ?>
            <!--div que contém os videos-->
            <div class="mt-5 mb-5">
                <h3 class="mb-4 titulo_videos">As minhas experiências</h3>
                <div class="card mt-4">
                    <div class="row m-3">
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 ">
                            <a href="upload_xp.php">
                                <button type="" class="btn bt_add" style="background-color: #D2D2D2;">Adicionar uma nova
                                    experiência
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal dos vídeos-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

                    <!--Conteudo-->
                    <div class="modal-content">

                        <!--Corpo-->
                        <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 m-0">
                                <video class="embed-responsive-item" src="" controls="controls"></video>
                            </div>
                        </div>

                        <!--Footer-->
                        <div class="ml-3 mr-3">
                            <h3 class="mt-4">Título do vídeo</h3>

                            <img class="avatar" src="img/jovem.png" alt="Fotografia de perfil">
                            <p class="username_modal">Joana Martins</p>

                            <hr>

                            <h5 class="mt-3">Descrição</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                sunt in
                                culpa qui officia deserunt mollit anim id est laborum.</p>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md mb-4"
                                    data-dismiss="modal">
                                Fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <?php
        }else if($type_user == "Empresa"){

            ?>
            <div class="mt-5 mb-5 centrar_cont">
                <h3 class="mb-4 titulo_videos">As minhas experiências</h3>
                <div class="card mt-4">
                    <div class="row m-3 centrar_cont">
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 div_videos">
                            <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video" data-toggle="modal"
                                   data-target="#modal1" style="background-color: #D2D2D2;">
                        </div>
                        <div class="col-md-3 mt-3 ">
                            <a href="upload_xp.php">
                                <button type="" class="btn bt_add" style="background-color: #D2D2D2;">Adicionar uma nova
                                    experiência
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal dos vídeos-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

                    <!--Conteudo-->
                    <div class="modal-content">

                        <!--Corpo-->
                        <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 m-0">
                                <video class="embed-responsive-item" src="" controls="controls"></video>
                            </div>
                        </div>

                        <!--Footer-->
                        <div class="ml-3 mr-3">
                            <h3 class="mt-4">Título do vídeo</h3>

                            <img class="avatar" src="img/jovem.png" alt="Fotografia de perfil">
                            <p class="username_modal">Joana Martins</p>

                            <hr>

                            <h5 class="mt-3">Descrição</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                sunt in
                                culpa qui officia deserunt mollit anim id est laborum.</p>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md mb-4"
                                    data-dismiss="modal">
                                Fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
            ?>
        <!--fim da div w-75-->
        <?php
    }
} else {
    include("404.php");
} //fim do else se não existir o GET
?>