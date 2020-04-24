<?php
if (isset($_GET["edit"])) {
    $idUser = $_GET["edit"];
    // We need the function!
    require_once("connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    //create a prepared statement
    $stmt = mysqli_stmt_init($link);
    //ir buscar os dados
    $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, disability_name, work_xp, profile_img, Educ_lvl_idEduc_lvl, Study_work_idStudy_work
     FROM users
     WHERE idUser LIKE ?";
?>
    <div class="card text-center">
        <h3>Editar Perfil</h3>
        <hr>
        <!-- edit form column -->
        <?php
        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $idUser);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $disability_name, $work_xp, $profile_img, $Educ_lvl_idEduc_lvl, $Study_work_idStudy_work);
            while (mysqli_stmt_fetch($stmt)) {
        ?>
                <form class="form-horizontal row" role="form" method="post" action="upload_profile.php?id=<?= $idUser ?>">

                    <!-- left column -->
                    <div class="col-md-4">
                        <div class="text-center">
                            <?php
                            if (isset($profile_img)) {
                            ?>
                                <img class="image_profile" src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="<?= $profile_img ?>" />
                            <?php
                            } else {
                            ?>
                                <img class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" />
                            <?php
                            }
                            ?>
                            <h6 class="mt-3">Seleciona uma nova foto</h6>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input file-upload" id="customFile" name="fileToUpload">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!--primeiro input-NOME-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="Escreve aqui o teu nome" class="form-control" value="<?= $name_user ?>">
                        </div>
                        <!----------------------->
                        <!--segundo input-EMAIL-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="Escreve aqui o teu email" class="form-control" value="<?= $email_user ?>">
                        </div>
                        <!----------------------->
                        <!--terceiro input-DATA DE NASCIMENTO-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="born">Data de nascimento</label>
                            <input type="date" id="born" name="data_nasc" placeholder="data de nascimento" class="form-control" value="<?= $birth_date ?>">
                        </div>
                        <!----------------------->
                        <!--quarto input- TELEMÓVEL-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="tlm">Telemóvel</label>
                            <input type="text" id="tlm" name="phone" placeholder="Escreve aqui o teu telemóvel" class="form-control" value="<?= $contact_user ?>">
                        </div>
                        <!----------------------->

                        <!--quinto input-DID-->
                        <div class="form-group text-left">
                            <label class="label-margin" for="def">Detalhes sobre a minha DID</label>
                            <input type="text" id="def" name="def" class="form-control" placeholder="Descreve aqui a tua DID" value="<?= $disability_name ?>">
                        </div>
                        <!----------------------->
                        <!--sexto input- ESCOLARIDADE-->
                        <div class="form-group text-left">
                            <label class="label-margin negrito mt-3" for="esc">Escolaridade</label>
                            <select class="form-control" id="esc" name="esc">
                                <option selected disabled>Seleciona uma opção</option>
                                <?php
                                $query = "SELECT idEduc_lvl, name_education FROM educ_lvl";

                                if (mysqli_stmt_prepare($stmt, $query)) {

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
                        <!----------------------->
                        <!--sétimo input-ESTUDO OU TRABALHO-->
                        <div class="form-group">
                            <div class="form-group text-left">
                                <label class="label-margin negrito mt-3" for="study_work">O que procuras? <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                <select class="form-control" id="study_work" name="study_work">
                                    <option selected disabled>Seleciona uma opção</option>
                                    <?php
                                    $query2 = "SELECT idStudy_work, name_type FROM study_work";

                                    if (mysqli_stmt_prepare($stmt, $query2)) {

                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $idStudy_work, $name_type);

                                            /* fetch values */
                                            while (mysqli_stmt_fetch($stmt)) {
                                                if ($Study_work_idStudy_work == $idStudy_work) {
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                echo "\n\t\t<option value=\"$idStudy_work\" $selected>$name_type</option>";
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
                        <!----------------------->
                        <!--oitavo input-AREAS-->
                        <div class="form-group text-left">
                            <label class="negrito mt-3 label-margin" for="area">Áreas de interesse <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                            <div class="form-check">
                                <?php
                                $query = "SELECT idAreas, name_interested_area FROM areas";

                                if (mysqli_stmt_prepare($stmt, $query)) {

                                    /* execute the prepared statement */
                                    if (mysqli_stmt_execute($stmt)) {
                                        /* bind result variables */
                                        mysqli_stmt_bind_result($stmt, $idAreas, $name_interested_area);

                                        /* fetch values */
                                        while (mysqli_stmt_fetch($stmt)) {

                                            echo "\n\t\t";
                                            echo "<label class='form-check-label label-margin col-6'>";
                                            echo "<input type='checkbox' class='form-check-input' name='area[]' value='$idAreas'>$name_interested_area<br>";
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
                        <!----------------------->
                        <!--nono input-PAÍS-->
                        <div class="form-group text-left">
                            <label class="negrito mt-3 label-margin" for="pais">Seleciona o país onde queres estudar: <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                            <select class="form-control" id="pais">
                                <option value="pt">Portugal</option>
                                <option value="es">Espanha</option>
                                <option value="be">Bélgica</option>
                                <option value="ic">Islândia</option>
                            </select>
                        </div>
                        <!----------------------->
                        <!--nono input-REGIÃO-->
                        <div class="form-group formulario text-left" id="pt">
                            <label class="negrito mt-3 label-margin" for="regiao">Região que procuras estudar ou trabalhar <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                            <div class="form-check">
                                <?php
                                $query = "SELECT idRegion, name_region FROM region";

                                if (mysqli_stmt_prepare($stmt, $query)) {

                                    /* execute the prepared statement */
                                    if (mysqli_stmt_execute($stmt)) {
                                        /* bind result variables */
                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                        /* fetch values */
                                        while (mysqli_stmt_fetch($stmt)) {

                                            echo "\n\t\t";
                                            echo "<label class='form-check-label label-margin col-6'>";
                                            echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion'>$name_region<br>";
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
                        <!--teste-->
                        <div id="be" class="formulario" style="display:none;">Mostra formulário empresa</div>
                        <div id="es" class="formulario" style="display:none;">Mostra formulário casamento</div>
                        <!----------------------->
                        <!------------EXPERIÊNCIA DE TRABALHO------------>
                        <div class="form-group text-left">
                            <label class="negrito mt-3 label-margin" for="exp_t">Experiência de trabalho</label>
                            <textarea class="form-control " id="exp_t" rows="2" name="work" placeholder="Escreve aqui a tua experiência de trabalho"></textarea>
                        </div>
                        <!----------------------->
                        <div class="form-group">
                            <label class="col-md-3 control-label label-margin"></label>
                            <div class="col-md-8">
                                <input type="button" type="submit" class="btn guardar_btn" value="Guardar">
                                <span></span>
                                <input type="reset" class="btn cancel_btn" value="Cancelar">
                            </div>
                        </div>
                    </div>
                </form>
        <?php
            }
        }
        ?>
    </div>
<?php
} else {
    include("404.php");
} //fim do else se não existir o GET
?>