<?php
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_GET["edit_xp"]) && isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
    $id_xp = $_GET["edit_xp"];
?>
    <div class="events w-75 mx-auto">
        <?php
        if (isset($_SESSION["xp_jovem"])) {
            $msg_show = true;
            switch ($_SESSION["xp_jovem"]) {
                case 1:
                    $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 2:
                    $message = "É necessário preencher todos os campos obrigatórios.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["xp_jovem"] = 0;
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
        <!--Card-->
        <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">
            <?php

            $query = "SELECT idExperiences, title_exp, description FROM experiences WHERE idExperiences=?";
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'i', $id_xp);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idExperiences, $title_exp, $description);
                while (mysqli_stmt_fetch($stmt)) {
            ?>
                    <!--título-->
                    <div class="no-gutters">
                        <h3 class="mx-auto letter">Editar experiência</h3>
                        <h3 class="mx-auto letter2"><?= $title_exp ?></h3>
                    </div>
                    <!----------->

                    <form class="md-form inserir_dados" class="mb-3" action="scripts/update_xp.php?update_xp=<?= $id_xp ?>" method="post">
                        <!--primeiro campo-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="nomeVideo">Nome da experiência: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                            <input type="text" id="nomeVideo" name="nomeVideo" class="form-control" value="<?= $title_exp ?>" placeholder="Escreve aqui o título que melhor descreve o vídeo da tua experiência" aria-required="true" required="required">
                        </div>
                        <!-------------------------------------------->
                        <!--segundo campo-->
                        <div class="form-group text-left mt-4">
                            <label class="label-margin" for="descricao">Descrição do vídeo:</label>
                            <textarea type="text" id="descricao" name="descricao" rows="7" class="form-control" placeholder="Escreve aqui a descrição que melhor descreve o vídeo da tua experiência"> <?= $description ?></textarea>
                        </div>
                        <!-------------------------------------------->
                        <div>
                            <button type="submit" class="btn btn-success publicar_btn">Guardar</button>
                        </div>

                    </form>
            <?php
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }
            /* close connection */
            mysqli_close($link);
            ?>
        </div>
    </div>
<?php
} else {
    include("404.php");
}
?>