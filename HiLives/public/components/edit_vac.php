<?php
require_once("connections/connection.php");

if (isset($_GET["idvac"]) and isset($_SESSION["idUser"])) {

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $idVacancies = $_GET["idvac"];
    $idUser = $_SESSION["idUser"];
    $query = "SELECT vacancie_name, description_vac, number_free_vanc, requirements, Region_idRegion, User_publicou, Workday_idWorkday, Educ_lvl_idEduc_lvl, Areas_idAreas FROM vacancies WHERE idVacancies LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);

        /* execute the prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $vacancie_name, $description_vac, $number_free_vanc, $requirements, $Region_idRegion, $User_publicou, $Workday_idWorkday, $Educ_lvl_idEduc_lvl, $Areas_idAreas);

            /* fetch values */
            if (mysqli_stmt_fetch($stmt)) {
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
                            case 0:
                                $msg_show = false;
                                break;
                            default:
                                $msg_show = false;
                                $_SESSION["vac"] = 0;
                        }

                        if ($msg_show == true) {
                            echo "<div class=\"alert $class alert-dismissible fade show mt-4\" role=\"alert\">" . $message . "
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
                        <div class="no-gutters">
                            <h3 class="mx-auto letter">Vaga</h3>
                            <h3 class="mx-auto letter2"><?= $vacancie_name ?></h3>
                        </div>
                        <!----------->
                        <form class="md-form inserir_dados" class="mb-3" action="scripts/update_vac.php?idvac=<?= $idVacancies ?>" method="post">
                            <!--primeiro campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="nomevaga">Cargo na empresa: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <input type="text" id="nomevaga" name="nomevaga" class="form-control" placeholder="Insira o nome do cargo disponível." required="required" value="<?= $vacancie_name ?>">
                            </div>
                            <!-------------------------------------------->
                            <!--segundo campo-->
                            <div class="form-group text-left mt-4">
                                <label class="label-margin" for="descricao">Descrição da vaga: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <textarea type="text" id="descricao" rows="10" name="descricao" class="form-control" placeholder="Insira um texto que descreva a vaga que está a anunciar." required="required"><?= $description_vac ?></textarea>
                            </div>
                            <!-------------------------------------------->
                            <!--terceiro campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="numvagas">Número de vagas disponíveis: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <input type="text" id="numvagas" name="numvagas" class="form-control" placeholder="Insira o número de vagas disponíveis para o cargo." required="required" value="<?= $number_free_vanc ?>">
                            </div>
                            <!-------------------------------------------->
                            <!--quarto campo-->
                            <div class="form-group text-left mt-4">
                                <label class="label-margin" for="requisitos">Requisitos: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <textarea type="text" id="requisitos" rows="7" name="requisitos" class="form-control" placeholder="Insira todos os requisitos que o jovem deve cumprir para que se possa candidatar à vaga." required="required"><?= $requirements ?></textarea>
                            </div>
                            <!-------------------------------------------->
                            <!--quinto campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="area">Áreas: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <select class="form-control" id="area" name="area" required="required">
                                    <option value="" selected disabled>Selecionar uma opção</option>
                                    <?php
                                    $query2 = "SELECT idAreas, name_interested_area 
                                FROM areas";

                                    if (mysqli_stmt_prepare($stmt, $query2)) {

                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $idAreas, $name_interested_area);

                                            /* fetch values */
                                            while (mysqli_stmt_fetch($stmt)) {
                                                if ($Areas_idAreas == $idAreas) {
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                echo "\n\t\t<option value=\"$idAreas\" $selected>$name_interested_area</option>";
                                            }
                                        } else {
                                            echo "Error: " . mysqli_stmt_error($stmt);
                                        }

                                        /* close statement */
                                        //mysqli_stmt_close($stmt);
                                    } else {
                                        echo "Error: " . mysqli_error($link);
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-------------------------------------------->
                            <!--sexto campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="jornada">Jornada de trabalho: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <select class="form-control" id="jornada" name="jornada" required="required">
                                    <option value="" selected disabled>Selecionar uma opção</option>
                                    <?php
                                    $query3 = "SELECT idWorkday, Workday_name FROM workday";

                                    if (mysqli_stmt_prepare($stmt, $query3)) {

                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $id_Workday, $name_workday);

                                            /* fetch values */
                                            while (mysqli_stmt_fetch($stmt)) {
                                                if ($Workday_idWorkday == $id_Workday) {
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                echo "\n\t\t<option value=\"$id_Workday\" $selected>$name_workday</option>";
                                            }
                                        } else {
                                            echo "Error: " . mysqli_stmt_error($stmt);
                                        }

                                        /* close statement */
                                        //mysqli_stmt_close($stmt);
                                    } else {
                                        echo "Error: " . mysqli_error($link);
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-------------------------------------------->
                            <!--sétimo campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="personality">Selecione cinco (5) capacidades necessárias: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <div class="form-check">
                                    <?php
                                    $query4 = "SELECT idcapacities, capacity_comp, vacancies_idVacancies FROM capacities
                                                LEFT JOIN vacancies_has_capacities
                                                ON  capacities.idcapacities= vacancies_has_capacities.capacities_idcapacities AND vacancies_has_capacities.vacancies_idVacancies= ?";

                                    if (mysqli_stmt_prepare($stmt, $query4)) {
                                        // Bind variables by type to each parameter
                                        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $idcapacities, $capacity_comp, $vacancies_idVacancies);

                                            /* fetch values */
                                            while (mysqli_stmt_fetch($stmt)) {
                                                $checked = "";
                                                if ($vacancies_idVacancies != null) {
                                                    $checked = "checked";
                                                }
                                                if (isset($capacity_comp)) {
                                                    echo "\n\t\t";
                                                    echo "<label class='form-check-label col-12 label-margin'>";
                                                    echo "<input type='checkbox' class='form-check-input' name='capacity[]' value='$idcapacities' $checked>$capacity_comp<br>";
                                                    echo "</label>";
                                                }
                                            }
                                        } else {
                                            echo "Error: " . mysqli_stmt_error($stmt);
                                        }
                                        /* close statement */
                                        //mysqli_stmt_close($stmt);
                                    } else {
                                        echo "Error: " . mysqli_error($link);
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-------------------------------------------->
                            <!--oitavo campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="educ">Nível de educação: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                <select class="form-control" id="educ" name="educ" required="required">
                                    <option value="" selected disabled>Selecionar uma opção</option>
                                    <?php
                                    $query5 = "SELECT idEduc_lvl, name_education 
                                FROM educ_lvl";

                                    if (mysqli_stmt_prepare($stmt, $query5)) {

                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $idEduc_lvl, $name_education);

                                            /* fetch values */
                                            while (mysqli_stmt_fetch($stmt)) {
                                                if ($Educ_lvl_idEduc_lvl == $idEduc_lvl) {
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                echo "\n\t\t<option value=\"$idEduc_lvl\" $selected>$name_education</option>";
                                            }
                                        } else {
                                            echo "Error: " . mysqli_stmt_error($stmt);
                                        }

                                        /* close statement */
                                        //mysqli_stmt_close($stmt);
                                    } else {
                                        echo "Error: " . mysqli_error($link);
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-------------------------------------------->
                            <!------------REGIÃo DA VAGA------------>
                            <div class="form-group formulario" id="pt">
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="regiao_pt">Região da Vaga
                                        <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span>
                                    </label>
                                    <select class="form-control" id="regiao_pt" name="regiao" required="required">
                                        <option value="" selected disabled>Seleciona uma opção</option>
                                        <?php
                                        $query6 = "SELECT Region_idRegion, idRegion, name_region FROM user_has_region
                                        INNER JOIN region ON user_has_region.Region_idRegion = region.idRegion
                                       WHERE User_idUser_region = ?";

                                        if (mysqli_stmt_prepare($stmt, $query6)) {
                                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $Region_idRegion, $idRegion, $name_region);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    if ($Region_idRegion == $idRegion) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "\n\t\t<option value=\"$Region_idRegion\" $selected>$name_region</option>";
                                                }
                                            } else {
                                                echo "Error: " . mysqli_stmt_error($stmt);
                                            }

                                            /* close statement */
                                            //mysqli_stmt_close($stmt);
                                        } else {
                                            echo "Error: " . mysqli_error($link);
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-------------------------------------------->

                            <div>
                                <button type="submit" class="btn btn-success publicar_btn">Publicar</button>
                            </div>

                        </form>
                    </div>
                </div>
<?php
            }
        }
    }
} else{
    include("404.php");
}
?>