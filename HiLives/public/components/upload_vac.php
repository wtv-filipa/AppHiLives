<?php
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$idUser = $_SESSION["idUser"];

?>
<div class="events w-75 mx-auto">
    <?php
    if (isset($_SESSION["vac"])) {
        $msg_show = true;
        switch ($_SESSION["vac"]) {
            case 1:
                $message = "É necessário preencher todos os campos obrigatórios.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 2:
                $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 3:
                $message = "O ficheiro que tentou carregar não é um vídeo.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 4:
                $message = "O vídeo que tentou carregar já existe nos seus ficheiros.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 5:
                $message = "O ficheiro que tentou carregar tem um tamanho superior ao suportado.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 6:
                $message = "O ficheiro que tentou carregar tem um formato que não é suportado pela aplicação.";
                $class = "alert-warning";
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
    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Criar nova vaga</h3>
        </div>
        <!----------->
        <form id="sectionForm" class="md-form inserir_dados" class="mb-3" action="scripts/upload_vac.php?vac=<?=$idUser?>" enctype="multipart/form-data" method="post">
            <!--primeiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="nomevaga">Cargo na empresa: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <input type="text" id="nomevaga" name="nomevaga" class="form-control" placeholder="Insira o nome do cargo disponível." required="required">
            </div>
            <!-------------------------------------------->
            <!--segundo campo-->
            <div class="form-group text-left mt-4">
                <label class="label-margin" for="descricao">Descrição da vaga: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <textarea type="text" id="descricao" rows="10" name="descricao" class="form-control" placeholder="Insira um texto que descreva a vaga que está a anunciar." required="required"></textarea>
            </div>
            <!-------------------------------------------->
            <!--terceiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="numvagas">Número de vagas disponíveis: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <input type="text" id="numvagas" name="numvagas" class="form-control" placeholder="Insira o número de vagas disponíveis para o cargo." required="required">
            </div>
            <!-------------------------------------------->
            <!--quarto campo-->
            <div class="form-group text-left mt-4">
                <label class="label-margin" for="requisitos">Requisitos: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <textarea type="text" id="requisitos" rows="7" name="requisitos" class="form-control" placeholder="Insira todos os requisitos que o jovem deve cumprir para que se possa candidatar à vaga." required="required"></textarea>
            </div>
            <!-------------------------------------------->
            <!--quinto campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="area">Área: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <select class="form-control" id="area" name="area" required="required">
                    <option value="" selected disabled>Selecionar uma opção</option>
                    <?php
                    $query = "SELECT idAreas, name_interested_area FROM areas";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $idAreas, $name_interested_area);
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "\n\t\t<option value=\"$idAreas\">$name_interested_area</option>";
                            }
                            /* close statement */
                            mysqli_stmt_close($stmt);
                        }
                    }
                    ?>
                </select>
            </div>
            <!-------------------------------------------->
            <!--sexto campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="jornada">Jornada de trabalho: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <select class="form-control" id="jornada" name="jornada" required="required">
                    <option value="" selected disabled>Selecionar uma opção</option>
                    <?php
                    $query2 = "SELECT idWorkday, Workday_name FROM workday";
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $id_Workday, $name_workday);
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "\n\t\t<option value=\"$id_Workday\">$name_workday</option>";
                            }
                            /* close statement */
                            mysqli_stmt_close($stmt);
                        }
                    }
                    ?>
                </select>
            </div>
            <!-------------------------------------------->
            <!--sétimo campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="personality">Selecione cinco (5) capacidades necessárias: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <div class="form-check">
                    <?php
                    $query = "SELECT idcapacities, capacity_comp FROM capacities";
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $idcapacities, $capacity_comp);
                            while (mysqli_stmt_fetch($stmt)) {
                                if (isset($capacity_comp)) {
                                    echo "\n\t\t";
                                    echo "<label class='form-check-label col-xs-12 col-md-12 p-1 label_margin'>";
                                    echo "<input type='checkbox' class='form-check-input' name='capacity[]' value='$idcapacities'>$capacity_comp<br>";
                                    echo "</label>";
                                }
                            }
                            /* close statement */
                            mysqli_stmt_close($stmt);
                        }
                    }
                    ?>
                </div>
            </div>
            <!-------------------------------------------->
            <!--oitavo campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="educ">Nível de educação: <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                <select class="form-control" id="educ" name="educ" required="required">
                    <option value="" selected disabled>Selecionar uma opção</option>
                    <?php
                    $query2 = "SELECT idEduc_lvl, name_education FROM educ_lvl";
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt,  $idEduc_lvl, $name_education);
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "\n\t\t<option value=\"$idEduc_lvl\">$name_education</option>";
                            }
                            /* close statement */
                            mysqli_stmt_close($stmt);
                        }
                    }
                    ?>
                </select>
            </div>
            <!-------------------------------------------->


            <!--nono campo-->
            <!------------REGIÃO DA VAGA------------>
            <div class="form-group formulario" id="pt">
                <div class="form-group text-left">
                    <label class="negrito mt-3" for="regiao_pt">Região da Vaga
                        <span style="color:  #00A5CF!important; font-weight: bold; font-size: 20px">*</span>
                    </label>
                    <select class="form-control" id="regiao_pt" name="regiao" required="required">
                        <option value="" selected disabled>Seleciona uma opção</option>
                        <?php
                        $query2 = "SELECT Region_idRegion, idRegion, name_region FROM user_has_region
                                    INNER JOIN region ON user_has_region.Region_idRegion = region.idRegion
                                   WHERE User_idUser_region = ?";
                        $stmt = mysqli_stmt_init($link);
                        if (mysqli_stmt_prepare($stmt, $query2)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $Region_idRegion, $idRegion, $name_region);
                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($Region_idRegion == $idRegion) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "\n\t\t<option value=\"$Region_idRegion\" $selected>$name_region</option>";
                                }
                                /* close statement */
                                mysqli_stmt_close($stmt);
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-------------------------------------------->
            <!--input de upload-->
            <div class="alert alert-warning mt-4" role="alert">
                Insira um vídeo da experiência na empresa até 50MB. (opcional)
            </div>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input file-upload" id="customFile" name="fileToUpload">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

            <!-------------------------------------------->

            <div>
                <button type="submit" name="but_upload" class="btn btn-success publicar_btn">Publicar</button>
            </div>

        </form>
    </div>
</div>