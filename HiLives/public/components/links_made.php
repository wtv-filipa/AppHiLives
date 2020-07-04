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
    FROM done_cu WHERE User_idUser = ? ORDER BY date_CU DESC";

?>
    <div class="mx-auto w-75 list_links">
        <?php
        if (isset($_SESSION["doneCU"])) {
            $msg_show = true;
            switch ($_SESSION["doneCU"]) {
                case 1:
                    $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                    $class = "alert-warning";
                    $_SESSION["doneCU"] = 0;
                    break;
                case 2:
                    $message = "Unidade Curricular carregada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["doneCU"] = 0;
                    break;
                case 3:
                    $message = "Unidade Curricular editada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["doneCU"] = 0;
                    break;
                case 4:
                    $message = "Unidade Curricular eliminada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["doneCU"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["doneCU"] = 0;
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
                        <h3 class="mb-4 main_title adjustment_top">Todas as Unidades Curriculares que fiz</h3>
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
                                    if (mysqli_stmt_prepare($stmt, $query)) {

                                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $idDone_CU, $Cu_name, $University_name, $date_CU);
                                        while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                            <li class="lista">
                                                <span class="font-weight-bold"><?= $Cu_name ?></span>
                                                <p class="instituicao"><?= $University_name ?></p>
                                                <p class="instituicao"><?= $date_CU ?></p>
                                                <div class="text-right">
                                                    <a href="edit_done_uc.php?uc=<?= $idDone_CU ?>">
                                                        <i class="fas fa-edit mr-1" style="color:#00A5CF!important"></i>
                                                    </a>

                                                    <a href="#" data-toggle="modal" data-target="#deleteuc<?= $idDone_CU ?>">
                                                        <i class="fas fa-trash mr-1" style="color:#2F2F2F!important"></i>
                                                    </a>
                                                </div>
                                            </li>

                                    <?php
                                            include('components/delete_modal.php');
                                        }
                                    }
                                    ?>
                                </ul>
                                <div class="text-center">
                                    <a href="done_uc.php">
                                        <button class="btn add_btn"><i class="faw_hover fas fa-plus-circle mr-1">
                                            </i>Adicionar novas unidades curriculares
                                        </button>
                                    </a>
                                </div>
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
    ?>