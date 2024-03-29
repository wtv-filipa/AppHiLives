<?php

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);
if (isset($_GET["user"]) && $_SESSION["idUser"]) {
    $idUser = $_GET["user"];
    $id_navegar = $_SESSION["idUser"];

    $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, info_young, work_xp, profile_img, website_ue, facebook_ue, instagram_ue, description_ue, type_user
    FROM users 
    INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
    WHERE idUser = ?";
   
    $query2 = "SELECT User_idUser, Areas_idAreas, name_interested_area
    FROM user_has_areas INNER JOIN areas ON user_has_areas.Areas_idAreas= areas.idAreas
    WHERE User_idUser LIKE ?";
   
    $query3 = "SELECT idDone_CU, Cu_name, University_name, date_CU
    FROM done_cu WHERE User_idUser = ? ORDER BY date_CU DESC LIMIT 3";
    
    $query4 = "SELECT idVacancies, vacancie_name, Areas_idAreas, name_interested_area
    FROM vacancies
    INNER JOIN areas ON vacancies.Areas_idAreas = areas.idAreas
    WHERE User_publicou = ? ORDER BY idVacancies DESC LIMIT 3";
 
    $query5 = "SELECT name_region FROM region INNER JOIN user_has_region ON region.idRegion=user_has_region.Region_idRegion WHERE User_idUser_region = ?";

    $query6 = "SELECT capacities, users_idUser, capacity FROM capacities_has_users 
    INNER JOIN capacities ON capacities_has_users.capacities= capacities.idcapacities
    WHERE users_idUser = ?";
 
    $query7 = "SELECT idExperiences, title_exp, description, date, idContent, content_name FROM experiences INNER JOIN content ON experiences.Content_idContent=content.idContent WHERE User_idUser = ?";
  
    $query8 = "SELECT idVacancies, vacancie_name, Content_idContent, content_name FROM vacancies INNER JOIN content ON vacancies.Content_idContent=content.idContent WHERE User_publicou = ?";
   
    $query9 = "SELECT favorite_environment, users_idUser,name_environment FROM work_environment_has_users
    INNER JOIN work_environment ON work_environment_has_users.favorite_environment = work_environment.idwork_environment
    WHERE users_idUser = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $info_young, $work_xp, $profile_img, $website_ue, $facebook_ue, $instagram_ue, $description_ue, $type_user);
        while (mysqli_stmt_fetch($stmt)) {
            $dob = $birth_date;
            $age = (date('Y') - date('Y', strtotime($dob)));
?>
            <div class="div_geral mx-auto largura">
                <div class="row mt-5 perfil_info">
                    <div class="col-xs-3 col-lg-3 ">
                        <?php
                        if (isset($profile_img)) {
                        ?>
                            <img class="image_profile" title="<?= $name_user ?>" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" />
                        <?php
                        } else {
                        ?>
                            <img class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if ($type_user == "Jovem") {
                    ?>
                        <div class="col-xs-3 col-lg-9 ">
                            <h3 class="mt-2 nome_user"><?= $name_user ?> <span class="subtitulo" style="font-weight: lighter; font-size: 16px;"> | <?= $age ?> anos</span></h3>

                            <h6 class="mt-3 subtitulo"> E-mail:<a title="Clicar para enviar e-mail para <?= $email_user ?>" href="mailto:<?= $email_user ?>"> <?= $email_user ?> </a></h6>

                            <h6 class="mt-3 subtitulo"> Regiões de interesse:
                                <?php
                                $first = true;
                                if (mysqli_stmt_prepare($stmt2, $query5)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $name_region);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                        if (!$first) {
                                            echo ",";
                                        }
                                        $first = false;
                                        echo " $name_region";
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </h6>
                        
                            <?php
                            if ($idUser == $id_navegar) {
                            ?>
                                <div class="p-0 mt-3 edit_align">
                                    <a href="edit_profile.php?edit=<?= $idUser ?>">
                                        <button class="btn edit_btn">
                                            Editar as minhas informações
                                        </button>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-12">
                            <p class="mt-5 subtitulo"><?= $info_young ?> </p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-xs-3 col-lg-9">
                            <h3 class="mt-2 nome_user"><?= $name_user ?></h3>
                            <h6 class="mt-3 subtitulo"> Região:
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query5)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $name_region);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                        echo " $name_region";
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </h6>
                            <?php
                            if ($idUser == $id_navegar) {
                            ?>
                                <div class="p-0 mt-3">
                                    <a href="edit_profile.php?edit=<?= $idUser ?>">
                                        <button class="btn edit_btn">
                                            Editar as minhas informações
                                        </button>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="col-lg-12">
                            <p class="mt-5 subtitulo"><?= $description_ue ?> </p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
              
                <hr class="mt-4">
                
                <?php
                if ($type_user == "Jovem") {
                ?>
                    <div class="tabs">
                        <input type="radio" id="tab1" name="tab-control" checked>
                        <input type="radio" id="tab2" name="tab-control">
                        <input type="radio" id="tab3" name="tab-control">
                        <input type="radio" id="tab4" name="tab-control">
                        <ul>
                            
                            <li title="Unidades curriculares">
                                <label for="tab1" role="button">
                                    <svg class="bi bi-award-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0l1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z" />
                                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                                    </svg>
                                    <br><span>Unidades curriculares</span>
                                </label>
                            </li>
                            
                            <li title="Áreas de interesse">
                                <label for="tab2" role="button">
                                    <svg class="bi bi-file-ruled" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z" />
                                        <path fill-rule="evenodd" d="M13 6H3V5h10v1zm0 3H3V8h10v1zm0 3H3v-1h10v1z" />
                                        <path fill-rule="evenodd" d="M5 14V6h1v8H5z" />
                                    </svg>
                                    <br><span>Áreas</span>
                                </label>
                            </li>
                            
                            <li title="Competências">
                                <label for="tab3" role="button">
                                    <svg class="bi bi-person-check-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9.854-2.854a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                    <br><span>Competências</span>
                                </label>
                            </li>
                            
                            <li title="Ambientes de trabalho">
                                <label for="tab4" role="button">
                                    <svg class="bi bi-briefcase-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z" />
                                        <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v1.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 5.884V4.5zm5-2A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z" />
                                    </svg>
                                    <br><span>Ambientes</span>
                                </label>
                            </li>
                        </ul>

                        <div class="slider">
                            <div class="indicator"></div>
                        </div>
                        <div class="content">
                          
                            <section>
                                <h2>Últimas unidades curriculares que fiz</h2>
                                <h5 class="mb-3">Últimas unidades curriculares que fiz</h5>
                                <ul id="notebook_ul">
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query3)) {

                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        mysqli_stmt_execute($stmt2);
                                        mysqli_stmt_bind_result($stmt2, $idDone_CU, $Cu_name, $University_name, $date_CU);
                                        mysqli_stmt_store_result($stmt2); 
                                        if (mysqli_stmt_num_rows($stmt2) > 0) { 
                                            while (mysqli_stmt_fetch($stmt2)) {
                                    ?>

                                                <li class="lista">
                                                    <?= $Cu_name ?>
                                                    <p class="instituicao"><?= $University_name ?></p>
                                                    
                                                    <?php
                                                    if ($idUser == $id_navegar) {
                                                    ?>
                                                        <div class="text-right">
                                                            <a href="edit_done_uc.php?uc=<?= $idDone_CU ?>">
                                                                <i class="fas fa-edit mr-1" title="Editar Unidade Curricular" style="color:#00A5CF!important"></i>
                                                            </a>

                                                            <a href="#" data-toggle="modal" data-target="#deleteuc<?= $idDone_CU ?>">
                                                                <i class="fas fa-trash mr-1" title="Eliminar Unidade Curricular" style="color:#2F2F2F!important"></i>
                                                            </a>
                                                        </div>
                                                    <?php

                                                    }
                                                    ?>
                                                </li>


                                            <?php
                                              
                                                include('components/delete_modal.php');
                                            }
                                            
                                            mysqli_stmt_close($stmt2);
                                        } else {
                                            if ($idUser == $id_navegar) {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    Ainda não adicionaste nenhuma Unidade Curricular. Carrega no botão de adicionar e começa a personalizar o teu perfil!
                                                </p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    O utilizador ainda não adicionou nenhuma Unidade Curricular.
                                                </p>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                               
                                <?php
                                if ($idUser == $id_navegar) {
                                ?>
                                    <div class="text-center row">
                                        <a class="col-md-6 col-xs-12" href="links_made.php">
                                            <button class="btn add_btn"> Ver todas as que eu já fiz
                                            </button>
                                        </a>
                                        <a class="col-md-6 col-xs-12" href="done_uc.php">
                                            <button class="btn add_btn">
                                                Adicionar novas unidades curriculares
                                            </button>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>

                            </section>
                            
                            <section>
                                <h2>As minhas áreas de interesse</h2>
                                <h5 class="mb-3">As minhas áreas de interesse</h5>
                                <blockquote class="blockquote mb-0">
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        mysqli_stmt_execute($stmt2);
                                        mysqli_stmt_bind_result($stmt2, $User_idUser, $Areas_idAreas, $name_interested_area);
                                        mysqli_stmt_store_result($stmt2); 
                                        if (mysqli_stmt_num_rows($stmt2) > 0) { 
                                            while (mysqli_stmt_fetch($stmt2)) {
                                    ?>
                                                <ul id="notebook_ul">
                                                    <li class="lista">
                                                        <?= $name_interested_area ?>
                                                    </li>
                                                </ul>
                                            <?php
                                            }
                                            
                                            mysqli_stmt_close($stmt2);
                                        } else {
                                            if ($idUser == $id_navegar) {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    Parece que ainda não adicionaste nenhuma área de interesse, edita o teu perfil e começa a criar ligações!
                                                </p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    O utilizador ainda não adicionou nenhuma área de interesse.
                                                </p>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </blockquote>

                            </section>
                           
                            <section>
                                <h2>As minhas competências</h2>
                                <?php
                                if ($work_xp != NULL) {
                                ?>
                                    <h5 class="mb-3">A minha experiência de trabalho</h5>
                                    <p class="mb-4"><?= $work_xp ?></p>
                                <?php
                                }
                                ?>

                                <h5 class="mb-3">As minhas competências</h5>
                                <blockquote class="blockquote mb-0">
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query6)) {

                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        mysqli_stmt_execute($stmt2);
                                        mysqli_stmt_bind_result($stmt2, $capacities, $users_idUser, $capacity);
                                        mysqli_stmt_store_result($stmt2); 
                                        if (mysqli_stmt_num_rows($stmt2) > 0) { 
                                            while (mysqli_stmt_fetch($stmt2)) {
                                    ?>
                                                <ul id="notebook_ul">
                                                    <li class="lista">
                                                        <?= $capacity ?>
                                                    </li>
                                                </ul>
                                            <?php
                                            }
                                            
                                            mysqli_stmt_close($stmt2);
                                        } else {
                                            if ($idUser == $id_navegar) {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    Parece que ainda não adicionaste nenhuma competência, edita o teu perfil e começa a criar ligações!
                                                </p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    O utilizador ainda não adicionou nenhuma competência.
                                                </p>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </blockquote>

                            </section>
                           
                            <section>
                                <h5 class="mb-3">Os meus ambientes de trabalho favoritos</h5>
                                <h2>Os meus ambientes de trabalho favoritos</h2>
                                <blockquote class="blockquote mb-0">
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query9)) {

                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        mysqli_stmt_execute($stmt2);
                                        mysqli_stmt_bind_result($stmt2, $favorite_environment, $users_idUser, $name_environment);
                                        mysqli_stmt_store_result($stmt2); 
                                        if (mysqli_stmt_num_rows($stmt2) > 0) { 
                                            while (mysqli_stmt_fetch($stmt2)) {
                                    ?>
                                                <ul id="notebook_ul">
                                                    <li class="lista">
                                                        <?= $name_environment ?>
                                                    </li>
                                                </ul>
                                            <?php
                                            }
                                            /* close statement */
                                            mysqli_stmt_close($stmt2);
                                        } else {
                                            if ($idUser == $id_navegar) {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    Parece que ainda não adicionaste nenhum ambiente de trabalho favorito.
                                                </p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    O utilizador ainda não adicionou nenhum ambiente de trabalho favorito.
                                                </p>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </blockquote>
                            </section>
                        </div>
                    </div>
                <?php
                }
                
                if ($type_user == "Jovem") {

                ?>
                    <div id="xp_jovem" class="mt-5 mb-5">
                        <?php
                        if (isset($_SESSION["xp_jovem"])) {
                            $msg_show = true;
                            switch ($_SESSION["xp_jovem"]) {
                                case 1:
                                    $message = "Experiência carregada com sucesso.";
                                    $class = "alert-success";
                                    $_SESSION["xp_jovem"] = 0;
                                    break;
                                case 2:
                                    $message = "Experiência editada com sucesso.";
                                    $class = "alert-success";
                                    $_SESSION["xp_jovem"] = 0;
                                    break;
                                case 3:
                                    $message = "Experiência eliminada com sucesso.";
                                    $class = "alert-success";
                                    $_SESSION["xp_jovem"] = 0;
                                    break;
                                case 4:
                                    $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                                    $class = "alert-warning";
                                    $_SESSION["xp_jovem"] = 0;
                                    break;
                                case 0:
                                    $msg_show = false;
                                    break;
                                default:
                                    $msg_show = false;
                                    $_SESSION["xp_jovem"] = 0;
                            }

                            if ($msg_show == true) {
                                echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span title=\"Fechar\" aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                            }
                        }
                        ?>
                        <h3 class="mb-4 titulo_videos">As minhas experiências</h3>
                        <div class="card mt-4" style="border: none">
                            <div class="row m-3">
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query7)) {

                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $idExperiences, $title_exp, $description, $date, $idContent, $content_name);
                                    mysqli_stmt_store_result($stmt2);
                                    if (mysqli_stmt_num_rows($stmt2) > 0) {
                                        while (mysqli_stmt_fetch($stmt2)) {
                                ?>

                                            <div class="col-md-3 mt-3 div_videos">
                                                <a href="#" data-toggle="modal" data-target="#modalvideo<?= $idExperiences ?>">
                                                    <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="../admin/uploads/xp/<?= $content_name ?>" alt="video" data-toggle="modal" data-target="#modal1" style="background-color: #2f2f2f;">
                                                </a>
                                            </div>

                                        <?php
                                            include "modal_vid.php";
                                        }
                                        mysqli_stmt_close($stmt2);
                                    } else {
                                        if ($idUser == $id_navegar) {
                                        ?>
                                            <p class=" col-md-9 mt-3" style="font-size: 1rem;">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                </svg>
                                                Parece que ainda não adicionaste nenhuma experiência. Se tens alguma experiência numa universidade ou empresa, grava um vídeo e partilha-o com os outros utilizadores!
                                            </p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class=" col-md-12 mt-3" style="font-size: 1rem;">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                </svg>
                                                Parece que o utilizador ainda não adicionou nenhuma experiência.
                                            </p>
                                    <?php
                                        }
                                    }
                                }
                                if ($idUser == $id_navegar) {
                                    ?>
                                    <div class="col-md-3 mt-3 ">
                                        <a title="Clica para adicionares uma experiência" href="upload_xp.php">
                                            <button type="" class="btn bt_add" style="background-color: #D2D2D2;">
                                                Adicionar uma nova
                                                experiência
                                            </button>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                } else if ($type_user == "Empresa") {
                ?>

                    <div class="tabs tabs2">
                        <input type="radio" id="tab1" name="tab-control" checked>
                        <input type="radio" id="tab2" name="tab-control">
                        <ul>
                            <li title="Vagas">
                                <label for="tab1" role="button">
                                    <svg class="bi bi-file-ruled" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z" />
                                        <path fill-rule="evenodd" d="M13 6H3V5h10v1zm0 3H3V8h10v1zm0 3H3v-1h10v1z" />
                                        <path fill-rule="evenodd" d="M5 14V6h1v8H5z" />
                                    </svg>
                                    <br><span>Vagas</span>
                                </label>
                            </li>
                            
                            <li title="Contactos">
                                <label for="tab2" role="button">
                                    <svg viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 01-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0zm3 1a1 1 0 100-2 1 1 0 000 2z" />
                                    </svg>
                                    <br><span>Contactos</span>
                                </label>
                            </li>
                        </ul>
                        <div class="slider">
                            <div class="indicator"></div>
                        </div>
                        <div class="content">
                            <section>
                                <h2>Vagas disponíveis</h2>
                                <h5 class="mb-3">Vagas disponíveis</h5>
                                <ul id="notebook_ul">
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query4)) {

                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        mysqli_stmt_execute($stmt2);
                                        mysqli_stmt_bind_result($stmt2, $idVacancies, $vacancie_name, $Areas_idAreas, $name_interested_area);
                                        mysqli_stmt_store_result($stmt2); 
                                        if (mysqli_stmt_num_rows($stmt2) > 0) { 
                                            while (mysqli_stmt_fetch($stmt2)) {
                                    ?>

                                                <li class="lista">
                                                    <?= $vacancie_name ?>
                                                 
                                                    <?php
                                                    if ($idUser == $id_navegar) {
                                                    ?>
                                                        <div class="text-right">
                                                            <a href="edit_vac.php?idvac=<?= $idVacancies ?>">
                                                                <i class="fas fa-edit mr-1" style="color:#00A5CF!important"></i>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#deletevac<?= $idVacancies ?>">
                                                                <i class="fas fa-trash mr-1" style="color:#2F2F2F!important"></i>
                                                            </a>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </li>

                                            <?php
                                                
                                                include('components/delete_modal.php');
                                            }
                                            
                                            mysqli_stmt_close($stmt2);
                                        } else {
                                            if ($idUser == $id_navegar) {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    Parece que ainda não adicionou nenhuma vaga, carregue em adicionar e comece a criar ligações.
                                                </p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    A empresa ainda não criou nenhuma vaga.
                                                </p>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                                <?php
                                if ($idUser == $id_navegar) {
                                ?>
                                    <div class="text-center">
                                        <a href="upload_vac.php">
                                            <button class="btn add_btn"><i class="faw_hover fas fa-plus-circle mr-1">
                                                </i>Adicionar novas vagas
                                            </button>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </section>
                            
                            <section>
                                <h2>Contactos</h2>
                                <blockquote class="blockquote mb-0 mt-4 ">
                                    <ul id="notebook_ul">
                                        <li class="lista">
                                            <i class="fas fa-at mr-2"></i><b class="mr-2">E-mail:</b> <a title="Clicar para enviar e-mail para <?= $email_user ?>" href="mailto:<?= $email_user ?>"><?= $email_user ?></a>
                                        </li>
                                        <li class="lista">
                                            <i class="fas fa-phone-alt mr-2"></i><b class="mr-2">Telefone:</b><?= $contact_user ?>
                                        </li>

                                        <?php
                                        if ($website_ue != NULL) {
                                        ?>
                                            <a href="<?= $website_ue ?>" target="_blank">
                                                <li class="lista">
                                                    <i class="fas fa-globe mr-2"></i><b class="mr-2">Website:</b><?= $website_ue ?>
                                                </li>
                                            </a>
                                        <?php
                                        }
                                        if ($facebook_ue != NULL) {
                                        ?>
                                            <a href="<?= $facebook_ue ?>" target="_blank">
                                                <li class="lista">
                                                    <i class="fab fa-facebook mr-2"></i><b class="mr-2">Facebook:</b><?= $facebook_ue ?>
                                                </li>
                                            </a>

                                        <?php
                                        }
                                        if ($instagram_ue != NULL) {
                                        ?>
                                            <a href="<?= $instagram_ue ?>" target="_blank">
                                                <li class="lista">
                                                    <i class="fab fa-instagram mr-2"></i><b class="mr-2">Instagram:</b> <?= $instagram_ue ?>
                                                </li>
                                            </a>
                                        <?php
                                        }

                                        ?>
                                    </ul>
                                </blockquote>
                            </section>

                        </div>
                    </div>

                    <div id="xp_vac" class="mt-5 mb-5 centrar_cont">
                        <?php
                        if (isset($_SESSION["xp_vac"])) {
                            $msg_show = true;
                            switch ($_SESSION["xp_vac"]) {
                                case 1:
                                    $message = "Vídeo eliminado com sucesso.";
                                    $class = "alert-success";
                                    $_SESSION["xp_vac"] = 0;
                                    break;
                                case 2:
                                    $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                                    $class = "alert-warning";
                                    $_SESSION["xp_vac"] = 0;
                                    break;
                                case 0:
                                    $msg_show = false;
                                    break;
                                default:
                                    $msg_show = false;
                                    $_SESSION["xp_vac"] = 0;
                            }

                            if ($msg_show == true) {
                                echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span title=\"Fechar\" aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                            }
                        }
                        ?>
                        <h3 class="mb-4 titulo_videos">Vídeos</h3>
                        <div class="card mt-4">
                            <div class="row m-3 centrar_cont">
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query8)) {

                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $idVacancies, $vacancie_name, $Content_idContent, $content_name);
                                    mysqli_stmt_store_result($stmt2); 
                                    if (mysqli_stmt_num_rows($stmt2) > 0) { 
                                        while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                            <div class="col-md-3 mt-3 div_videos">
                                                <a href="#" data-toggle="modal" data-target="#modalvideo<?= $idVacancies ?>">
                                                    <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="../admin/uploads/vid_vac/<?= $content_name ?>" alt="video" data-toggle="modal" data-target="#modal1" style="background-color: #2f2f2f;">
                                                </a>
                                            </div>

                                        <?php
                                            include "modal_vid.php";
                                        }
                                        
                                        mysqli_stmt_close($stmt2);
                                    } else {
                                        if ($idUser == $id_navegar) {
                                        ?>
                                            <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                </svg>
                                                Parece que ainda não tem nenhum vídeo disponível.
                                            </p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                </svg>
                                                A empresa ainda não tem nenhum vídeo disponível.
                                            </p>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                   
                ?>
                    <div class="tabs tabs2 mb-5">
                        <input type="radio" id="tab1" name="tab-control" checked>
                        <input type="radio" id="tab2" name="tab-control">
                        <ul>
                            <li title="Áreas">
                                <label for="tab1" role="button">
                                    <svg class="bi bi-file-ruled" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z" />
                                        <path fill-rule="evenodd" d="M13 6H3V5h10v1zm0 3H3V8h10v1zm0 3H3v-1h10v1z" />
                                        <path fill-rule="evenodd" d="M5 14V6h1v8H5z" />
                                    </svg>
                                    <br><span>Áreas</span>
                                </label>
                            </li>
                            
                            <li title="Contactos">
                                <label for="tab2" role="button">
                                    <svg viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 01-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0zm3 1a1 1 0 100-2 1 1 0 000 2z" />
                                    </svg>
                                    <br><span>Contactos</span>
                                </label>
                            </li>
                        </ul>
                        <div class="slider">
                            <div class="indicator"></div>
                        </div>
                        <div class="content">
                            <section>
                                <h2>Áreas disponíveis</h2>
                                <h5 class="mb-3">Áreas disponíveis</h5>
                                <ul id="notebook_ul">
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        mysqli_stmt_execute($stmt2);
                                        mysqli_stmt_bind_result($stmt2, $User_idUser, $Areas_idAreas, $name_interested_area);
                                        mysqli_stmt_store_result($stmt2); 
                                        if (mysqli_stmt_num_rows($stmt2) > 0) { 
                                            while (mysqli_stmt_fetch($stmt2)) {
                                    ?>

                                                <li class="lista">
                                                    <?= $name_interested_area ?>
                                                </li>
                                            <?php
                                            }
                                            mysqli_stmt_close($stmt2);
                                        } else {
                                            if ($idUser == $id_navegar) {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    Parece que ainda não tem nenhuma área disponível, edite o seu perfil e comece a criar ligações!
                                                </p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                    </svg>
                                                    Ainda não existem áreas disponíveis na universidade.
                                                </p>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </section>
                            
                            <section>
                                <h2>Contactos</h2>
                                <blockquote class="blockquote mb-0 mt-4 ">
                                    <ul id="notebook_ul">
                                        <li class="lista">
                                            <i class="fas fa-at mr-2"></i><b class="mr-2">E-mail:</b><a title="Clicar para enviar e-mail para <?= $email_user ?>" href="mailto:<?= $email_user ?>"><?= $email_user ?></a>
                                        </li>
                                        <li class="lista">
                                            <i class="fas fa-phone-alt mr-2"></i><b class="mr-2">Telefone:</b><?= $contact_user ?>
                                        </li>

                                        <?php
                                        if ($website_ue != NULL) {
                                        ?>

                                            <a href="<?= $website_ue ?>" target="_blank">
                                                <li class="lista">
                                                    <i class="fas fa-globe mr-2"></i><b class="mr-2">Website:</b><?= $website_ue ?>
                                                </li>
                                            </a>
                                        <?php
                                        }
                                        if ($facebook_ue != NULL) {
                                        ?>
                                            <a href="<?= $facebook_ue ?>" target="_blank">
                                                <li class="lista">
                                                    <i class="fab fa-facebook mr-2"></i><b class="mr-2">Facebook:</b><?= $facebook_ue ?>
                                                </li>
                                            </a>

                                        <?php
                                        }
                                        if ($instagram_ue != NULL) {
                                        ?>
                                            <a href="<?= $instagram_ue ?>" target="_blank">
                                                <li class="lista">
                                                    <i class="fab fa-instagram mr-2"></i><b class="mr-2">Instagram:</b> <?= $instagram_ue ?>
                                                </li>
                                            </a>
                                        <?php
                                        }

                                        ?>
                                    </ul>
                                </blockquote>
                            </section>

                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
<?php
        } 
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
    mysqli_close($link2);
} else {
    include("404.php");
} 
