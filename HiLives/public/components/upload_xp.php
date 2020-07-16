<?php
 require_once("connections/connection.php");
 $link = new_db_connection();
 $stmt = mysqli_stmt_init($link);
if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
?>
    <div class="events w-75 mx-auto">
        <?php
        if (isset($_SESSION["xp_jovem"])) {
            $msg_show = true;
            switch ($_SESSION["xp_jovem"]) {
                case 1:
                    $message = "O ficheiro que tentaste carregar não é um vídeo.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 2:
                    $message = "O vídeo que tentaste carregar já existe nas tuas experiências.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 3:
                    $message = "É necessário preencher todos os campos obrigatórios.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 4:
                    $message = "O ficheiro que tentaste carregar tem um tamanho superior ao suportado.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 5:
                    $message = "O ficheiro que tentaste carregar tem um formato que não é suportado pela nossa aplicação.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 6:
                    $message = "Ocorreu um erro ao carregar o teu ficheiro, por favor volta a tentar.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 7:
                    $message = "Ocorreu um erro ao carregar a tua experiência, por favor volta a tentar.";
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
        
        <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

            <div class="row no-gutters">
                <h3 class="mx-auto letter">
                    Carregar vídeo de experiência</h3>
            </div>
                    <form class="md-form inserir_dados" class="mb-3" action="scripts/upload_xp.php?xp=<?= $id_navegar ?>" enctype="multipart/form-data" method="post">
                       
                        <div class="alert alert-warning mb-3" role="alert">
                            Insere um vídeo até 50MB.
                        </div>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input file-upload" id="fileToUpload" name="fileToUpload" accept=".avi, .wmv, .mp4" aria-required="true" required="required">
                            <label class="custom-file-label" for="fileToUpload">Escolher ficheiro</label>
                        </div>
                       
                        <div class="form-group text-left">
                            <label class="label-margin" for="nomeVideo">Título da experiência<span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                            <input type="text" id="nomeVideo" name="nomeVideo" class="form-control" placeholder="Escreve aqui o título da tua experiência" aria-required="true" required="required">
                        </div>
                        
                        <div class="form-group text-left mt-4">
                            <label class="label-margin" for="descricao">Descrição</label>
                            <textarea type="text" id="descricao" name="descricao" rows="7" class="form-control" placeholder="Descreve aqui o vídeo da tua experiência"></textarea>
                        </div>
                       
                        <div>
                            <button type="submit" name="but_upload" class="btn btn-success publicar_btn">Publicar</button>
                        </div>

                    </form>
        </div>
    </div>
<?php
} else {
    include("404.php");
}
?>