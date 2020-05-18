<?php
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$idUser = $_SESSION["idUser"];

?>
<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Criar nova vaga</h3>
        </div>
        <!----------->
        <form class="md-form inserir_dados" class="mb-3" action="scripts/upload_vac.php?vac=<?= $idUser ?>"
              enctype="multipart/form-data" method="post">
            <!--primeiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="nomevaga">Cargo na empresa:</label>
                <input type="text" id="nomevaga" name="nomevaga" class="form-control">
            </div>
            <!-------------------------------------------->
            <!--segundo campo-->
            <div class="form-group text-left mt-4">
                <label class="label-margin" for="descricao">Descrição da vaga:</label>
                <textarea type="text" id="descricao" name="descricao" class="form-control"></textarea>
            </div>
            <!-------------------------------------------->
            <!--terceiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="numvagas">Número de vagas disponíveis:</label>
                <input type="text" id="numvagas" name="numvagas" class="form-control">
            </div>
            <!-------------------------------------------->
            <!--quarto campo-->
            <div class="form-group text-left mt-4">
                <label class="label-margin" for="requisitos">Requisitos:</label>
                <textarea type="text" id="requisitos" name="requisitos" class="form-control"></textarea>
            </div>
            <!-------------------------------------------->
            <!--quinto campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="area">Áreas:</label>
                <select class="form-control" id="area" name="area">
                    <option selected disabled>Selecionar uma opção</option>
                    <?php
                    $query = "SELECT idAreas, name_interested_area FROM areas";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        if (mysqli_stmt_execute($stmt)) {
                            /* bind result variables */
                            mysqli_stmt_bind_result($stmt, $idAreas, $name_interested_area);

                            /* fetch values */
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "\n\t\t<option value=\"$idAreas\">$name_interested_area</option>";
                            }
                        }
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
                    $query2 = "SELECT idWorkday, Workday_name FROM workday";

                    if (mysqli_stmt_prepare($stmt, $query2)) {

                        if (mysqli_stmt_execute($stmt)) {
                            /* bind result variables */
                            mysqli_stmt_bind_result($stmt, $id_Workday,$name_workday);

                            /* fetch values */
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "\n\t\t<option value=\"$id_Workday\">$name_workday</option>";
                            }
                        }
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
                    $query = "SELECT idPersonality, name_perso FROM personality";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        /* execute the prepared statement */
                        if (mysqli_stmt_execute($stmt)) {
                            /* bind result variables */
                            mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);

                            /* fetch values */
                            while (mysqli_stmt_fetch($stmt)) {

                                echo "\n\t\t";
                                echo "<label class='form-check-label col-xs-12 col-md-6 label_margin'>";
                                echo "<input type='checkbox' class='form-check-input' name='personalidade[]' value='$idPersonality'>$name_perso<br>";
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
                    $query2 = "SELECT idEduc_lvl, name_education FROM educ_lvl";

                    if (mysqli_stmt_prepare($stmt, $query2)) {

                        if (mysqli_stmt_execute($stmt)) {
                            /* bind result variables */
                            mysqli_stmt_bind_result($stmt,  $idEduc_lvl, $name_education);

                            /* fetch values */
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "\n\t\t<option value=\"$idEduc_lvl\">$name_education</option>";
                            }
                        }
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
                        $query2 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Portugal'";

                        if (mysqli_stmt_prepare($stmt, $query2)) {

                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {

                                    echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
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
                        $query2 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Espanha'";

                        if (mysqli_stmt_prepare($stmt, $query2)) {

                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {

                                    echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
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
                        $query2 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Bélgica'";

                        if (mysqli_stmt_prepare($stmt, $query2)) {

                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {

                                    echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
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
                        $query2 = "SELECT idRegion, name_region FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    WHERE name_country = 'Islândia'";

                        if (mysqli_stmt_prepare($stmt, $query2)) {

                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {

                                    echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
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
                <input type="file" class="custom-file-input file-upload" id="customFile" name="fileToUpload">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

            <!-------------------------------------------->

            <div>
                <button type="submit" class="btn btn-success publicar_btn">Publicar</button>
            </div>

        </form>
    </div>
</div>