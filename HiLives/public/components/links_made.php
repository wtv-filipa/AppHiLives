<?php
include "navbar_2.php";
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];

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
                <span title=\"Fechar\" aria-hidden=\"true\">&times;</span>
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
                                        mysqli_stmt_store_result($stmt); // Store the result into memory
                                        if (mysqli_stmt_num_rows($stmt) > 0) { // Check the number of rows returned
                                            while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                                <li class="lista">
                                                    <span class="font-weight-bold"><?= $Cu_name ?></span>
                                                    <p class="instituicao"><?= $University_name ?></p>
                                                    <p class="instituicao"><?= $date_CU ?></p>
                                                    <div class="text-right">
                                                        <a href="edit_done_uc.php?uc=<?= $idDone_CU ?>">
                                                            <i class="fas fa-edit mr-1" title="Editar Unidade Curricular" style="color:#00A5CF!important"></i>
                                                        </a>

                                                        <a href="#" data-toggle="modal" data-target="#deleteuc<?= $idDone_CU ?>">
                                                            <i class="fas fa-trash mr-1" title="Eliminar Unidade Curricular" style="color:#2F2F2F!important"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                            <?php
                                                include('components/delete_modal.php');
                                            }
                                            /* close statement */
                                            mysqli_stmt_close($stmt);
                                        } else {
                                            ?>
                                            <p class="mx-auto mt-5 mb-5" style="font-size: 1rem;">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                                                </svg>
                                                Ainda não adicionaste nenhuma Unidade Curricular. Carrega no botão em baixo e começa a personalizar o teu perfil!
                                            </p>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <div class="text-center">
                                    <a href="done_uc.php">
                                        <button class="btn add_btn">Adicionar novas unidades curriculares
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
/* close connection */
mysqli_close($link);
    ?>