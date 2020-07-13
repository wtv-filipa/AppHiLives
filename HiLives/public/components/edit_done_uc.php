<?php
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_GET["uc"])) {
    $idUser = $_SESSION["idUser"];
    $iduc = $_GET["uc"];

    //ir buscar os dados
    $query = "SELECT Cu_name, University_name, date_CU
    FROM done_cu 
    WHERE User_idUser LIKE ? AND idDone_CU LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $iduc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Cu_name, $University_name, $date_CU);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <div class="events w-75 mx-auto">
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
                            $message = "É necessário preencher todos os campos obrigatórios.";
                            $class = "alert-warning";
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

                <!--Card-->
                <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

                    <!--título-->
                    <div class=" no-gutters">
                        <h3 class="mx-auto letter">
                            Editar a unidade curricular </h3>
                        <h3 class="mx-auto letter2"><?= $Cu_name ?></h3>
                    </div>
                    <!----------->
                    <form class="md-form inserir_dados" class="mb-3" action="scripts/update_done_uc.php?uc=<?= $iduc ?>" enctype="multipart/form-data" method="post">
                        <!--primeiro campo-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="nomeuc">Nome da Unidade Curricular: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                            <input type="text" id="nomeuc" name="nomeuc" class="form-control" aria-required="true" required="required" value="<?= $Cu_name ?>"><span class="sr-only">(Insere o nome da unidade curricular que complestaste)</span>
                        </div>
                        <!-------------------------------------------->
                        <!--segundo campo-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="uniuc">Universidade onde foi feita: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                            <input type="text" id="uniuc" name="uniuc" class="form-control" aria-required="true" required="required" value="<?= $University_name ?>"><span class="sr-only">(Insere o nome da universidade onde complestaste a unidade curricular)</span>
                        </div>
                        <!-------------------------------------------->
                        <!--terceiro campo-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="data">Data de conclusão: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                            <input type="date" id="data" name="data" class="form-control" aria-required="true" required="required" value="<?= $date_CU ?>"><span class="sr-only">(Insere a data da conclusão da unidade curricular)</span>
                        </div>
                        <!-------------------------------------------->
                        <div>
                            <button type="submit" class="btn btn-success publicar_btn col-6">Guardar alterações</button>
                            <a href="profile.php?user=<?= $idUser ?>" class="btn btn-success cancel_btn col-6">Voltar</a>
                        </div>

                    </form>
                </div>
            </div>
<?php
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    }
    /* close connection */
    mysqli_close($link);
} else {
    include("404.php");
}

?>