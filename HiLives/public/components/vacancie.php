<?php
include "navbar_2.php";
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_GET["vac"])) {
    $idVac = $_GET["vac"];

    $query = "SELECT vacancie_name, description_vac, number_free_vanc, requirements, date_vacancies, Region_idRegion, User_publicou, Workday_idWorkday, vacancies.Educ_lvl_idEduc_lvl, Areas_idAreas, name_region, Workday_name, name_interested_area, name_education, name_user
            FROM vacancies
            INNER JOIN region ON vacancies.Region_idRegion = region.idRegion
            INNER JOIN workday ON vacancies.Workday_idWorkday = workday.idWorkday
            INNER JOIN areas ON vacancies.Areas_idAreas = areas.idAreas
            INNER JOIN educ_lvl ON vacancies.Educ_lvl_idEduc_lvl = educ_lvl.idEduc_lvl
            INNER JOIN users ON vacancies.User_publicou = users.idUser
            INNER JOIN vacancies_has_capacities ON vacancies.idVacancies = vacancies_has_capacities.vacancies_idVacancies
            INNER JOIN capacities ON vacancies_has_capacities.capacities_idcapacities = capacities.idcapacities
            WHERE idVacancies = ?";
    $query3 = "SELECT Content_idContent, content_name FROM vacancies INNER JOIN content ON vacancies.Content_idContent = content.idContent WHERE idVacancies = ?";
    $query4 = "SELECT capacity_comp
            FROM vacancies
            INNER JOIN vacancies_has_capacities ON vacancies.idVacancies = vacancies_has_capacities.vacancies_idVacancies
            INNER JOIN capacities ON vacancies_has_capacities.capacities_idcapacities = capacities.idcapacities
            WHERE idVacancies = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVac);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $vacancie_name, $description_vac, $number_free_vanc, $requirements, $date_vacancies, $Region_idRegion, $User_publicou, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $name_region, $Workday_name, $name_interested_area, $name_education, $name_user);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <div class="w-75 mx-auto">
                <div id='wrapper_title'>
                    <div class='tagpost-top section' id='tagpost-top'>
                        <div class='widget HTML' id='HTML5'>
                            <div data-aos="fade-up">
                                <h3 class="main_title">Informações sobre a vaga</h3>
                                <h3 class="mb-4 mt-1 main_title2"><?= $vacancie_name ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <input type="radio" id="tab1" name="tab-control" checked>
                    <input type="radio" id="tab2" name="tab-control">
                    <input type="radio" id="tab3" name="tab-control">
                    <input type="radio" id="tab4" name="tab-control">
                    <ul>
                        <li title="Informações"><label for="tab1" role="button">
                                <svg class="bi bi-info-circle-fill" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" />
                                </svg>
                                <br><span>Informações</span></label></li>
                        <li title="Requisitos"><label for="tab2" role="button">
                                <svg viewBox="0 0 24 24">
                                    <path d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z" />
                                </svg>
                                <br><span>Requisitos</span></label></li>
                        <li title="Contactos"><label for="tab3" role="button">
                                <svg viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 01-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0zm3 1a1 1 0 100-2 1 1 0 000 2z" />
                                </svg>
                                <br><span>Contactos</span></label></li>
                        <li title="Experiências"><label for="tab4" role="button">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-camera-video-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.667 3h6.666C10.253 3 11 3.746 11 4.667v6.666c0 .92-.746 1.667-1.667 1.667H2.667C1.747 13 1 12.254 1 11.333V4.667C1 3.747 1.746 3 2.667 3z" />
                                    <path d="M7.404 8.697l6.363 3.692c.54.313 1.233-.066 1.233-.697V4.308c0-.63-.693-1.01-1.233-.696L7.404 7.304a.802.802 0 0 0 0 1.393z" />
                                </svg>
                                <br><span>Experiências</span></label></li>
                    </ul>

                    <div class="slider">
                        <div class="indicator"></div>
                    </div>
                    <div class="content">
                        <section>
                            <h2>Informações</h2>
                            <span class="info_title">Descrição</span>
                            <p style="font-size: 14px"><?= $description_vac ?></p>

                            <span class="info_title">Empresa</span>
                            <p style="font-size: 14px"><?= $name_user ?></p>

                            <span class="info_title"> Região</span>
                            <p style="font-size: 14px"><?= $name_region ?></p>

                            <span class="info_title"> Área(s) </span>
                            <p style="font-size: 14px"><?= $name_interested_area ?></p>

                            <span class="info_title">Habilitações literárias </span>
                            <p style="font-size: 14px"><?= $name_education ?></p>

                            <span class="info_title"> Horário de trabalho</span>
                            <p style="font-size: 14px"><?= $Workday_name ?></p>

                            <span class="info_title"> Número de vagas disponíveis</span>
                            <p style="font-size: 14px"><?= $number_free_vanc ?></p>

                            <span class="info_title"> Data de publicação</span>
                            <p style="font-size: 14px"><?= substr($date_vacancies, 0, 10) ?></p>

                        </section>
                        <section>
                            <h2>Requisitos</h2>
                            <span class="info_title">Requisitos</span>
                            <p><?= $requirements ?></p>
                            <span class="info_title"">Capacidades necessárias</span>
                            <ul id="notebook_ul">
                                <?php
                                if (mysqli_stmt_prepare($stmt2, $query4)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idVac);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $capacity_comp);

                                    while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                        <li class="lista" style="margin-bottom: 2% !important;">
                                            <?= $capacity_comp ?>
                                        </li>
                                <?php
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </ul>
                        </section>
                        <section>
                            <h2>Contactos</h2>
                            <?php
                            $query2 = "SELECT name_user, email_user, contact_user, website_ue, facebook_ue, instagram_ue
                    FROM users
                    WHERE idUser LIKE ?";
                            $stmt2 = mysqli_stmt_init($link2);
                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                mysqli_stmt_bind_param($stmt2, 'i', $User_publicou);
                                if (mysqli_stmt_execute($stmt2)) {
                                    mysqli_stmt_bind_result($stmt2, $user_name, $email_user, $contact_user, $website_ue, $facebook_ue, $instagram_ue);
                                    while (mysqli_stmt_fetch($stmt2)) {
                            ?>
                                        
                                        <div class="card-body altura" style="padding-top: 0 !important;">
                                            <blockquote class="blockquote mb-0 mt-4 ">
                                                <ul id="notebook_ul">
                                                    <li class="lista">
                                                        <i class="fas fa-at mr-2"></i><b class="mr-2">Email:</b><a href="mailto:<?= $email_user ?>"><?= $email_user ?></a>
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
                                        </div>

                                      
                            <?php
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                            }
                            ?>

                        </section>
                        <section>
                            <h2>Experiências</h2>


                            <div class="card-body">
                                <blockquote class="blockquote mb-0 text-center">
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query3)) {
                                        mysqli_stmt_bind_param($stmt2, 'i', $idVac);
                                        mysqli_stmt_execute($stmt2);
                                        mysqli_stmt_bind_result($stmt2, $Content_idContent, $content_name);

                                        if (mysqli_stmt_fetch($stmt2)) {
                                    ?>
                                            <video width="640" height="480" controls>
                                                <source src="../admin/uploads   /vid_vac/<?= $content_name ?>" type="video/mp4">
                                                O teu browser não suporta a tag de video.
                                            </video>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 10%;">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                </svg>
                                                Esta vaga não tem nenhum vídeo adicionado, se quiseres perceber melhor a experiência dentro desta empresa contacta o empregador.
                                            </p>
                                    <?php
                                        }
                                        mysqli_stmt_close($stmt2);
                                    }
                                    ?>
                                </blockquote>
                            </div>
                        </section>
                    </div>
                </div>
    <?php
        }
        mysqli_stmt_close($stmt);
    }
} else {
    include("404.php");
}
mysqli_close($link);
mysqli_close($link2);
    ?>