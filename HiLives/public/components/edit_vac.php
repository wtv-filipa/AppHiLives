<?php
require_once("connections/connection.php");

if (isset($_GET["idvac"])) {

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $idVacancies = $_GET["idvac"];

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

                    <!--Card-->
                    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

                        <!--título-->
                        <div class="row no-gutters">
                            <h3 class="mx-auto letter">Vaga <?= $vacancie_name ?></h3>
                        </div>
                        <!----------->
                        <form class="md-form inserir_dados" class="mb-3" action="scripts/update_vac.php?idvac=<?= $idVacancies ?>" enctype="multipart/form-data" method="post">
                            <!--primeiro campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="nomevaga">Cargo na empresa:</label>
                                <input type="text" id="nomevaga" name="nomevaga" class="form-control" value="<?= $vacancie_name ?>">
                            </div>
                            <!-------------------------------------------->
                            <!--segundo campo-->
                            <div class="form-group text-left mt-4">
                                <label class="label-margin" for="descricao">Descrição da vaga:</label>
                                <textarea type="text" id="descricao" rows="4" name="descricao" class="form-control"><?= $description_vac ?></textarea>
                            </div>
                            <!-------------------------------------------->
                            <!--terceiro campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="numvagas">Número de vagas disponíveis:</label>
                                <input type="text" id="numvagas" name="numvagas" class="form-control" value="<?= $number_free_vanc ?>">
                            </div>
                            <!-------------------------------------------->
                            <!--quarto campo-->
                            <div class="form-group text-left mt-4">
                                <label class="label-margin" for="requisitos">Requisitos:</label>
                                <textarea type="text" id="requisitos" rows="4" name="requisitos" class="form-control"><?= $requirements ?></textarea>
                            </div>
                            <!-------------------------------------------->
                            <!--quinto campo-->
                            <div class="form-group text-left">
                                <label class="label-margin" for="area">Áreas:</label>
                                <select class="form-control" id="area" name="area">
                                    <option selected disabled>Selecionar uma opção</option>
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
                                <label class="label-margin" for="jornada">Jornada de trabalho:</label>
                                <select class="form-control" id="jornada" name="jornada">
                                    <option selected disabled>Selecionar uma opção</option>
                                    <?php
                                    $query3 = "SELECT idWorkday, Workday_name FROM workday";

                                    if (mysqli_stmt_prepare($stmt, $query3)) {

                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $id_Workday,$name_workday);

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
                                <label class="label-margin" for="personality">Personalidade necessária: </label>
                                <div class="form-check">
                                    <?php
                                    $query4 = "SELECT idPersonality, name_perso, Vacancies_idVacancies FROM personality
                                                LEFT JOIN personality_has_vacancies
                                                ON  personality.idPersonality= personality_has_vacancies.Personality_idPersonality AND personality_has_vacancies.Vacancies_idVacancies= ?";

                                    if (mysqli_stmt_prepare($stmt, $query4)) {
                                        // Bind variables by type to each parameter
                                        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso, $Vacancies_idVacancies);

                                            /* fetch values */
                                            while (mysqli_stmt_fetch($stmt)) {
                                                $checked = "";
                                                if ($Vacancies_idVacancies != null) {
                                                    $checked = "checked";
                                                }

                                                echo "\n\t\t";
                                                echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                echo "<input type='checkbox' class='form-check-input' name='person[]' value='$idPersonality' $checked>$name_perso<br>";
                                                echo "</label>";
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
                                <label class="label-margin" for="educ">Nível de educação:</label>
                                <select class="form-control" id="educ" name="educ">
                                    <option selected disabled>Selecionar uma opção</option>
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


                            <!--nono campo-->
                            <!------------PAÍS------------>
                            <div class="form-group text-left">
                                <label class="negrito mt-3" for="pais">Seleciona o país da vaga:
                                    <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                <select class="form-control" id="pais">
                                    <option value="pt">Portugal</option>
                                    <option value="es">Espanha</option>
                                    <option value="be">Bélgica</option>
                                    <option value="ic">Islândia</option>
                                </select>
                            </div>
                            <!------------REGIÕES DE PORTUGAL------------>
                            <div class="form-group formulario" id="pt">
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="regiao_pt">Região da Vaga
                                        <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span>
                                    </label>
                                    <select class="form-control" id="regiao_pt" name="regiao">
                                        <option selected disabled>Seleciona uma opção</option>
                                        <?php
                                        $query6 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Portugal'";

                                        if (mysqli_stmt_prepare($stmt, $query6)) {

                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    if ($Region_idRegion == $idRegion) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
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
                            <!------------REGIÕES DE ESPANHA------------>
                            <div class="form-group formulario" style="display:none;" id="es">
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="regiao_es">Região da Empresa
                                        <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span>
                                    </label>
                                    <select class="form-control" id="regiao_es" name="regiao">
                                        <option selected disabled>Seleciona uma opção</option>
                                        <?php
                                        $query7 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Espanha'";

                                        if (mysqli_stmt_prepare($stmt, $query7)) {

                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    if ($Region_idRegion == $idRegion) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
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
                            <!------------REGIÕES DE BÉLGICA------------>
                            <div class="form-group formulario" style="display:none;" id="be">
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="regiao_be">Região da Empresa
                                        <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span>
                                    </label>
                                    <select class="form-control" id="regiao_be" name="regiao">
                                        <option selected disabled>Seleciona uma opção</option>
                                        <?php
                                        $query8 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Bélgica'";

                                        if (mysqli_stmt_prepare($stmt, $query8)) {

                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    if ($Region_idRegion == $idRegion) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
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
                            <!------------REGIÕES DE ISLÂNDIA------------>
                            <div class="form-group formulario" style="display:none;" id="ic">
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="regiao_ic">Região da Empresa
                                        <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span>
                                    </label>
                                    <select class="form-control" id="regiao_ic" name="regiao">
                                        <option selected disabled>Seleciona uma opção</option>
                                        <?php
                                        $query9 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Islândia'";

                                        if (mysqli_stmt_prepare($stmt, $query9)) {

                                            /* execute the prepared statement */
                                            if (mysqli_stmt_execute($stmt)) {
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                /* fetch values */
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    if ($Region_idRegion == $idRegion) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
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
                            <!--input de upload-->
                            <div class="alert alert-warning mt-4" role="alert">
                                Insira um vídeo da experiência na empresa até 50MB. (opcional)
                            </div>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input file-upload" id="customFile"
                                       name="fileToUpload">
                                <label class="custom-file-label" for="customFile">Choose file</label>
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
}
?>