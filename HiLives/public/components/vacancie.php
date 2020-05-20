<?php
include "navbar_2.php";

require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT vacancie_name, description_vac, number_free_vanc, requirements, Region_idRegion, User_publicou,Content_idContent, Workday_idWorkday, Educ_lvl_idEduc_lvl, Areas_idAreas FROM vacancies";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $User_publicou, $Content_idContent, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas);

    if (mysqli_stmt_fetch($stmt)) {
        ?>
        <div class="w-75 mx-auto">
            <div id='wrapper_title'>
                <div class='tagpost-top section' id='tagpost-top'>
                    <div class='widget HTML' id='HTML5'>
                        <div data-aos="fade-up">
                            <h3 class="mb-4 main_title">Informações sobre a vaga <span style="color: #00A5CF"><?= $vacancie_name ?></span></h3>
                            <h3></h3>
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
                    <li title="Features"><label for="tab1" role="button"><svg viewBox="0 0 24 24">
                                <path d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z" />
                            </svg><br><span>Descrição</span></label></li>
                    <li title="Delivery Contents"><label for="tab2" role="button"><svg viewBox="0 0 24 24">
                                <path d="M2,10.96C1.5,10.68 1.35,10.07 1.63,9.59L3.13,7C3.24,6.8 3.41,6.66 3.6,6.58L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.66,6.72 20.82,6.88 20.91,7.08L22.36,9.6C22.64,10.08 22.47,10.69 22,10.96L21,11.54V16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V10.96C2.7,11.13 2.32,11.14 2,10.96M12,4.15V4.15L12,10.85V10.85L17.96,7.5L12,4.15M5,15.91L11,19.29V12.58L5,9.21V15.91M19,15.91V12.69L14,15.59C13.67,15.77 13.3,15.76 13,15.6V19.29L19,15.91M13.85,13.36L20.13,9.73L19.55,8.72L13.27,12.35L13.85,13.36Z" />
                            </svg><br><span>Requisitos</span></label></li>
                    <li title="Shipping"><label for="tab3" role="button"><svg viewBox="0 0 24 24">
                                <path d="M3,4A2,2 0 0,0 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8H17V4M10,6L14,10L10,14V11H4V9H10M17,9.5H19.5L21.47,12H17M6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5M18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5Z" />
                            </svg><br><span>Contactos</span></label></li>
                    <li title="Returns"><label for="tab4" role="button"><svg viewBox="0 0 24 24">
                                <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                            </svg><br><span>Experiências</span></label></li>
                </ul>

                <div class="slider">
                    <div class="indicator"></div>
                </div>
                <div class="content">
                    <section>
                        <h2>Features</h2>
                        <p><?= $description_vac ?></p>
                    </section>
                    <section>
                        <h2>Delivery Contents</h2>
                        <p><?= $requirements ?></p>
                    </section>
                    <section>
                        <h2>Shipping</h2>
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
                                                        if (isset($website_ue)) {
                                                            ?>

                                                            <li class="lista">
                                                                <i class="fas fa-globe mr-2"></i><b
                                                                        class="mr-2">Website:</b><?= $website_ue ?>
                                                            </li>
                                                            <?php
                                                        }
                                                        if (isset($facebook_ue)) {
                                                            ?>
                                                            <li class="lista">
                                                                <i class="fab fa-facebook mr-2"></i><b
                                                                        class="mr-2">Facebook:</b><?= $facebook_ue ?>
                                                            </li>
                                                            <?php
                                                        }
                                                        if (isset($instagram_ue)) {
                                                            ?>
                                                            <li class="lista">
                                                                <i class="fab fa-instagram mr-2"></i><b
                                                                        class="mr-2">Instagram:</b> <?= $instagram_ue ?>
                                                            </li>

                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </blockquote>
                                            </div>

                                    <!------------------------------------------>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </section>
                    <section>
                        <h2>Returns</h2>


                        <div class="card-body">
                            <blockquote class="blockquote mb-0 text-center">
                                <iframe class="video" src="https://www.youtube.com/embed/mw4sXFG2r9A" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </blockquote>
                        </div>
                    </section>
                </div>
            </div>
        <?php
    }
}
?>