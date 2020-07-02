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
                    WHERE User_publicou = ? ORDER BY idVacancies DESC";
?>


    <div class="mx-auto w-75 list_links">
        <?php
        if (isset($_SESSION["vac"])) {
            $msg_show = true;
            switch ($_SESSION["vac"]) {
                case 1:
                    $message = "Vaga carregada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["vac"] = 0;
                    break;
                case 2:
                    $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                    $class = "alert-warning";
                    $_SESSION["vac"] = 0;
                    break;
                case 3:
                    $message = "Vaga editada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["vac"] = 0;
                    break;
                case 4:
                    $message = "Vaga eliminada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["vac"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["vac"] = 0;
            }

            if ($msg_show == true) {
                echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
            }
        }
        ?>
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
                                <ul id="notebook_ul">
                                    <?php

                                    if (mysqli_stmt_prepare($stmt, $query1)) {

                                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $Areas_idAreas, $name_interested_area);
                                        while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                            <a href="vacancie.php?vac=<?= $idVacancies?>">
                                                <li class="lista">
                                                    <span class="font-weight-bold"><?= $vacancie_name ?></span>
                                                    <p class="instituicao"><?= $name_interested_area ?></p>

                                                    <div class="text-right">
                                                        <a href="edit_vac.php?idvac=<?= $idVacancies ?>">
                                                            <i class="fas fa-edit mr-1" style="color:#00A5CF!important"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#deletevac<?= $idVacancies ?>">
                                                            <i class="fas fa-trash mr-1" style="color:#2F2F2F!important"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                            </a>
                                    <?php
                                            include('components/delete_modal.php');
                                        }
                                    }
                                    ?>
                                </ul>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
} else{
    include("404.php");
}
    ?>