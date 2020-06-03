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
$query1 = "SELECT idVacancies, vacancie_name, Areas_idAreas, name_interested_area
                    FROM vacancies
                    INNER JOIN areas ON vacancies.Areas_idAreas = areas.idAreas
                    WHERE User_publicou LIKE ?";

?>
<div class="mx-auto w-75 list_links">


    <div id='wrapper_title'>

        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title adjustment_top">As minhas vagas</h3>
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
                            if (mysqli_stmt_prepare($stmt, $query1)) {

                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $idVacancie, $vacancie_name, $Areas_idAreas, $name_interested_area);
                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <ul id="notebook_ul">
                                        <li class="lista">
                                            <span class="font-weight-bold"><?= $vacancie_name ?></span>
                                            <p class="instituicao"><?= $name_interested_area ?></p>

                                            <div class="text-right">
                                                <a href="edit_vac.php?idvac=<?= $idVacancie ?>">
                                                    <i class="fas fa-edit mr-1" style="color:#00A5CF!important"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#deleteuc<?= $idVacancie ?>">
                                                    <i class="fas fa-trash mr-1" style="color:#2F2F2F!important"></i>
                                                </a>
                                            </div>
                                        </li>


                                    </ul>
                                    <?php
                                    include('components/delete_modal.php');
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
