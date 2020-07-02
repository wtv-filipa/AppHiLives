<?php
include "navbar_2.php";


if ($_GET["vac"]) {
    $idVac = $_GET["vac"];


    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT vacancie_name, description_vac, number_free_vanc, requirements, date_vacancies, Region_idRegion, User_publicou,Content_idContent, Workday_idWorkday, vacancies.Educ_lvl_idEduc_lvl, Areas_idAreas, name_region, Workday_name, name_interested_area, name_education, name_user
            FROM vacancies
            INNER JOIN region ON vacancies.Region_idRegion = region.idRegion
            INNER JOIN workday ON vacancies.Workday_idWorkday = workday.idWorkday
            INNER JOIN areas ON vacancies.Areas_idAreas = areas.idAreas
            INNER JOIN educ_lvl ON vacancies.Educ_lvl_idEduc_lvl = educ_lvl.idEduc_lvl
            INNER JOIN users ON vacancies.User_publicou = users.idUser
            WHERE idVacancies = ?";


    $query2 = "SELECT capacity
            FROM learning_path_capacities
            INNER JOIN user_has_vacancies ON learning_path_capacities.fk_match_vac = user_has_vacancies.id_match_vac
            INNER JOIN vacancies ON user_has_vacancies.Vacancies_idVacancies = vacancies.idVacancies
            INNER JOIN capacities ON learning_path_capacities.missing_learn = capacities.idcapacities
            WHERE idVacancies = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVac);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $vacancie_name, $description_vac, $number_free_vanc, $requirements, $date_vacancies, $Region_idRegion, $User_publicou, $Content_idContent, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas, $name_region, $Workday_name, $name_interested_area, $name_education, $name_user);

        if (mysqli_stmt_fetch($stmt)) {

            ?>
            <div class="w-75 mx-auto">
            <div id='wrapper_title'>
                <div class='tagpost-top section' id='tagpost-top'>
                    <div class='widget HTML' id='HTML5'>
                        <div data-aos="fade-up">
                            <h3 class="mb-4 main_title">Percurso de aprendizagem recomendado para </h3>
                            <h3 class="mb-4 mt-1 main_title2"><?= $vacancie_name ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div id='wrapper' class="col-md-12 mb-3">
                <div class="row">
                    <!--first step-->
                    <div class="col-12 col-md-4">
                        <div class="imagem">
                            <img class="img_percurso rounded-circle img-fluid" src="img/img_vaga.png"/>
                        </div>
                        <div class="content">
                            <h5 class="centro">1º: Vaga para: <?= $vacancie_name ?></h5>
                            <p>Abaixo encontras todas as informações sobre a vaga.</p>
                        </div>
                    </div>
                    <!---------------------->
                    <!--Second step-->

                            <div class="col-12 col-md-4">
                                <div class="imagem">
                                    <img class="img_percurso rounded-circle img-fluid" src="img/img_estudo.png"/>
                                </div>
                                <div class="content">
                                    <h5 class="centro">2º: O que te falta</h5>
                                    <p>Para te candidatares a esta vaga precisas de cumprir também estas capacidades:</p>
                                    <ul style="list-style-type: circle;">
                                        <?php
                                        if (mysqli_stmt_prepare($stmt, $query2)) {
                                            mysqli_stmt_bind_param($stmt, 'i', $idVac);
                                            mysqli_stmt_execute($stmt);
                                            mysqli_stmt_bind_result($stmt, $capacity);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                ?>
                                                    <li><?= $capacity ?></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                    <!---------------------->
                    <!--Third step-->
                    <div class="col-12 col-md-4">
                        <div class="imagem">
                            <img class="img_percurso rounded-circle img-fluid" src="img/img_contacto.png"/>
                        </div>
                        <div class="content">
                            <h5 class="centro">3º: Contactar <?= $name_user ?></h5>
                            <p>Caso estejas interessado na vaga é necessário contactares a empresa para te poderes informar.</p>
                        </div>
                    </div>
                </div>
                <!---end of class row-->
            </div>
            <div id='wrapper_title'>
                <div class='tagpost-top section' id='tagpost-top'>
                    <div class='widget HTML' id='HTML5'>
                        <div data-aos="fade-up">
                            <h3 class="main_title mb-4">Todas as informações da vaga </h3>
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
                            <path fill-rule="evenodd"
                                  d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <br><span>Informações</span></label></li>
                <li title="Requisitos"><label for="tab2" role="button">
                        <svg viewBox="0 0 24 24">
                            <path d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z"/>
                        </svg>
                        <br><span>Requisitos</span></label></li>
                <li title="Contactos"><label for="tab3" role="button">
                        <svg viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 01-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0zm3 1a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <br><span>Contactos</span></label></li>
                <li title="Experiências"><label for="tab4" role="button">
                        <svg viewBox="0 2 18 18">
                            <path d="M2.667 3h6.666C10.253 3 11 3.746 11 4.667v6.666c0 .92-.746 1.667-1.667 1.667H2.667C1.747 13 1 12.254 1 11.333V4.667C1 3.747 1.746 3 2.667 3z"/>
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
                    <p><?= $requirements ?></p>
                </section>
                <section>
                    <h2>Contactos</h2>
                    <?php
                    $query2 = "SELECT name_user, email_user, contact_user, website_ue, facebook_ue, instagram_ue
                    FROM users
                    WHERE idUser LIKE ?";
                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_bind_param($stmt, 'i', $User_publicou);
                        /* execute the prepared statement */
                        if (mysqli_stmt_execute($stmt)) {
                            /* bind result variables */
                            mysqli_stmt_bind_result($stmt, $user_name, $email_user, $contact_user, $website_ue, $facebook_ue, $instagram_ue);
                            /* fetch values */
                            while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                <!--TERCEIRO CARD-->
                                <div class="card-body altura" style="padding-top: 0 !important;">
                                    <blockquote class="blockquote mb-0 mt-4 ">
                                        <ul id="notebook_ul">
                                            <li class="lista">
                                                <i class="fas fa-at mr-2"></i><b
                                                        class="mr-2">Email:</b><?= $email_user ?>
                                            </li>
                                            <li class="lista">
                                                <i class="fas fa-phone-alt mr-2"></i><b
                                                        class="mr-2">Telefone:</b><?= $contact_user ?>
                                            </li>
                                            <?php
                                            if ($website_ue != NULL) {
                                                ?>

                                                <a href="<?= $website_ue ?>" target="_blank">
                                                    <li class="lista">
                                                        <i class="fas fa-globe mr-2"></i><b
                                                                class="mr-2">Website:</b><?= $website_ue ?>
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
                                                    <i class="fab fa-instagram mr-2"></i><b
                                                            class="mr-2">Instagram:</b> <?= $instagram_ue ?>
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
                        }
                    }
                    ?>
                </section>
                <section>
                    <h2>Experiências</h2>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0 text-center">
                            <iframe class="video" src="https://www.youtube.com/embed/mw4sXFG2r9A" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </blockquote>
                    </div>
                </section>
            </div>
            <?php
        }
    }

}