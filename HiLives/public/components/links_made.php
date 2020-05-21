<?php
include "navbar_2.php";

if ($_SESSION["idUser"]) {
    $id_navegar = $_SESSION["idUser"];

// We need the function!
    require_once("connections/connection.php");
// Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

//query que seleciona as vagas carregadas pela empresa
    $query = "SELECT idDone_CU, Cu_name, University_name, date_CU
    FROM done_cu WHERE User_idUser LIKE ?";

    ?>
    <div class="mx-auto w-75 list_links">


    <div id='wrapper_title'>

        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title adjustment_top">Todas as disciplinas que fiz</h3>
                </div>
            </div>
        </div>
    </div>

    <div id='wrapper'>
        <div id='recenttags'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div class='widget-content'>
                        <blockquote class="blockquote mb-0">
                            <?php
                            if (mysqli_stmt_prepare($stmt, $query)) {

                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $idDone_CU, $Cu_name, $University_name, $date_CU);
                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <ul id="notebook_ul">
                                        <li class="lista">
                                            <span class="font-weight-bold"><?= $Cu_name ?></span>
                                            <p class="instituicao"><?= $University_name ?></p>
                                            <a href="edit_done_uc.php?uc=<?= $idDone_CU ?>">
                                                <p class="instituicao"
                                                   style="color:#00A5CF!important; text-align: right"><i
                                                            class="fas fa-edit mr-1 "
                                                            style="color:#00A5CF!important"></i>Editar</p>
                                            </a>

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
        </div>
    </div>
    <?php

}
?>