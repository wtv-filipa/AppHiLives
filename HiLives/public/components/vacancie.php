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
                        <h3 class="mb-4 main_title">Informações sobre a vaga <?= $vacancie_name ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-----CARDS DE INFORMAÇÃO------->
        <div class="row">
            <!--PRIMEIRO CARD-->
            <div class="col-12 col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="my-auto"> Descrição da vaga </h5>
                    </div>
                    <div class="card-body altura">
                        <blockquote class="blockquote mb-0">
                            <p><?= $description_vac ?></p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!------------------------------------------>
            <!--SEGUNDO CARD-->
            <div class="col-12 col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="my-auto"> Requisitos </h5>
                    </div>
                    <div class="card-body altura">
                        <blockquote class="blockquote mb-0">
                            <p><?= $requirements ?></p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!------------------------------------------>
        </div>

        <div id='wrapper_title'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title">Informações sobre o Empregador</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-----CARDS DE INFORMAÇÃO------->
        <div class="row">
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
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="my-auto">Contactos</h5>
                            </div>
                            <div class="card-body altura">
                                <blockquote class="blockquote mb-0 mt-4">
                                    <p>Telefone: <?= $contact_user ?></p>
                                    <p>Email: <?= $email_user ?></p>
                                    <p>Website: <?= $website_ue ?></p>
                                    <p>Facebook: <?= $facebook_ue ?></p>
                                    <p>Instagram: <?= $instagram_ue ?></p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------>
                    <!--QUARTO CARD-->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="my-auto"> Requisitos </h5>
                            </div>
                            <div class="card-body altura">
                                <blockquote class="blockquote mb-0">
                                    <p><?= $requirements ?></p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------>
                    <?php
                }
            }
        }
                    ?>
                    </div>
                    </div>

                    <!--------CARD DO VÍDEO---------------->
                    <div class="card mt-5">
                        <div class="card-header">
                            <h5 class="my-auto"> Experiências de trabalhadores </h5>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0 text-center">
                                <iframe class="video" src="https://www.youtube.com/embed/mw4sXFG2r9A" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </blockquote>
                        </div>
                    </div>
                    </div>
                    <?php
                }
            }
            ?>