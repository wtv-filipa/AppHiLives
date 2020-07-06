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
                                        mysqli_stmt_store_result($stmt); // Store the result into memory
                                        if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                                            while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                                <a href="vacancie.php?vac=<?= $idVacancies ?>">
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
                                            /* close statement */
                                            mysqli_stmt_close($stmt);
                                        } else {
                                            ?>
                                            <p class="mx-auto mt-3 mb-5" style="font-size: 1rem;">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                </svg>
                                                Ainda não tem nenhuma vaga adicionada. Crie uma nova vaga e comece a criar ligações com os jovens!
                                            </p>
                                    <?php
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
} else {
    include("404.php");
}
/* close connection */
mysqli_close($link);

    ?>