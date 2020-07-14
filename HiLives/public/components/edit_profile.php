<?php

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_GET["edit"])) {
    $idUser = $_GET["edit"];

    //ir buscar os dados
    $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, info_young, work_xp, profile_img, website_ue, facebook_ue, instagram_ue, description_ue, history_ue, Educ_lvl_idEduc_lvl, type_user
    FROM users
    INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
    WHERE idUser LIKE ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $info_young, $work_xp, $profile_img, $website_ue, $facebook_ue, $instagram_ue, $description_ue, $history_ue, $Educ_lvl_idEduc_lvl, $type_user);
?>
        <!--FORMULÁRIO DE EDITAR PARA OS JOVENS-->
        <div class="w-75 mx-auto">
            <div class="card text-center">
                <h4>Editar Perfil</h4>
                <hr>
                <?php
                while (mysqli_stmt_fetch($stmt)) {
                    if ($type_user == "Jovem") {
                ?>

                        <div class="row">
                            <!-- left column -->

                            <div class="col-xs-12 col-md-4">

                                <div class="text-center">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input style="display: none" type="file" id="fileToUpload" name="fileToUpload image" accept=".png, .jpg, .jpeg" />
                                            <label class="label" for="fileToUpload"><i class="fas fa-edit mx-auto my-auto  text-align-center"></i></label>
                                            <input id="userIDhidden" value="<?= $idUser ?>" style="display: none;"></input>
                                        </div>
                                        <?php
                                        //var_dump($img_perfil);
                                        if (isset($profile_img)) {
                                        ?>
                                            <img id="img_perf" class="image_profile" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="imagem de perfil" title="imagem de perfil"/>
                                        <?php
                                        } else {
                                        ?>
                                            <img id="img_perf" class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" title="sem imagem de perfil"/>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <span>Carrega no botão que está em cima da imagem para alterar a tua imagem.</span>
                                    </div>
                                    <!----------------------MODAL DE CROP--------------->
                                    <div id="uploadimageModal" class="modal" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Importar e cortar a imagem de perfil</h4>
                                                    <button type="button" class="close" aria-label="Fechar" aria-hidden=true data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mx-auto">
                                                        <div class="col-12 text-center">
                                                            <div id="image_demo" style="display:block; margin:auto;"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <button class="buttonCustomise btn btn-primary crop_image" value="Upload Image" name="Submit"> Guardar </button>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!------------------->
                                </div>
                            </div>


                            <!-- edit form column-->
                            <div class="col-xs-12 col-md-8">
                                <form id="sectionForm" class="form-horizontal" role="form" method="post" action="scripts/update_profile.php?id=<?= $idUser ?>">
                                    <!------------****------------>
                                    <?php
                                    if (isset($_SESSION["edit_jovem"])) {
                                        $msg_show = true;
                                        switch ($_SESSION["edit_jovem"]) {
                                            case 1:
                                                $message = "Utilizador editado com sucesso.";
                                                $class = "alert-success";
                                                $_SESSION["edit_jovem"] = 0;
                                                break;
                                            case 2:
                                                $message = "É necessário preencher todos os campos obrigatórios.";
                                                $class = "alert-warning";
                                                $_SESSION["edit_jovem"] = 0;
                                                break;
                                            case 3:
                                                $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                                                $class = "alert-warning";
                                                $_SESSION["edit_jovem"] = 0;
                                                break;
                                            case 0:
                                                $msg_show = false;
                                                break;
                                            default:
                                                $msg_show = false;
                                                $_SESSION["edit_jovem"] = 0;
                                        }

                                        if ($msg_show == true) {
                                            echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\">
                                <span aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                                            echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                        }
                                    }
                                    ?>
                                    <p style="font-size: 12px; color: #00A5CF !important;">* Campos de preenchimento obrigatório.</p>
                                    <!--primeiro input-NOME-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="nome">Nome <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="text" id="nome" name="nome" placeholder="Escreve aqui o teu nome" aria-required="true" required="required" class="form-control" value="<?= $name_user ?>"><span class="sr-only">(Escreve aqui o teu nome)</span>
                                    </div>
                                    <!----------------------->
                                    <!--segundo input-EMAIL-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="email">Email <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="text" id="email" name="email" placeholder="Escrevie aqui o teu email" aria-required="true" required="required" class="form-control" value="<?= $email_user ?>"><span class="sr-only">(Escreve aqui o teu e-mail)</span>
                                    </div>
                                    <!----------------------->
                                    <!--terceiro input-DATA DE NASCIMENTO-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="born">Data de nascimento <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="date" id="born" name="data_nasc" placeholder="data de nascimento" aria-required="true" required="required" class="form-control" value="<?= $birth_date ?>"><span class="sr-only">(Escreve aqui a tua data de nascimento)</span>
                                    </div>
                                    <!----------------------->
                                    <!--quarto input- TELEMÓVEL-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="tlm">Telemóvel</label>
                                        <input type="text" id="tlm" name="phone" placeholder="Escreve aqui o teu telemóvel" class="form-control" value="<?= $contact_user ?>"><span class="sr-only">(Escreve aqui o teu numero de telemóvel)</span>
                                    </div>
                                    <!----------------------->
                                    <!--sexto input- ESCOLARIDADE-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="esc">Escolaridade</label>
                                        <select class="form-control" id="esc" name="esc">
                                            <option selected disabled aria-disabled>Seleciona uma opção</option><span class="sr-only">(Seleciona uma opção)</span>
                                            <?php
                                            $query3 = "SELECT idEduc_lvl, name_education 
                                                    FROM educ_lvl";

                                            if (mysqli_stmt_prepare($stmt2, $query3)) {

                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idEduc_lvl, $name_education);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        if ($Educ_lvl_idEduc_lvl == $idEduc_lvl) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        echo "\n\t\t<option value=\"$idEduc_lvl\" $selected>$name_education</option>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!----------------------->
                                    <!--oitavo input-AREAS-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="area">As minhas áreas de interesse (para estudar ou trabalhar) <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class="sr-only">(As minhas áreas de interesse (para estudar ou trabalhar))</span>
                                        <div class="form-check">
                                            <?php
                                            $query2 = "SELECT idAreas, name_interested_area, Areas_idAreas
                                                    FROM areas
                                                    LEFT JOIN user_has_areas
                                                    ON  areas.idAreas= user_has_areas.Areas_idAreas AND user_has_areas.User_idUser= ?";
                                            $stmt2 = mysqli_stmt_init($link2);
                                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idAreas, $name_interested_area, $Areas_idAreas);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        $checked = "";
                                                        if ($Areas_idAreas != null) {
                                                            $checked = "checked";
                                                        }

                                                        echo "\n\t\t";
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                        echo "<input type='checkbox' class='form-check-input' name='area[]' value='$idAreas' $checked>$name_interested_area<br>";
                                                        echo "</label>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!----------------------->
                                    <!--nono input-PAÍS-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="pais">Seleciona o país onde queres estudar: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class="sr-only">(Seleciona o país onde queres estudar)</span>
                                        <select class="form-control" id="pais">
                                            <option value="pt">Portugal</option>
                                            <option value="es">Espanha</option>
                                            <option value="be">Bélgica</option>
                                            <option value="ic">Islândia</option>
                                        </select>
                                    </div>
                                    <!----------------------->
                                    <!--nono input-REGIÃO PT-->
                                    <div class="form-group formulario text-left" id="pt">
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou trabalhar <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class="sr-only">(Região que procuras estudar ou trabalhar)</span>
                                        <div class="form-check">
                                            <?php
                                            $query3 = "SELECT idRegion, name_region, Region_idRegion
                                                    FROM region
                                                    LEFT JOIN user_has_region
                                                    ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                    WHERE name_country = 'Portugal'";
                                            $stmt2 = mysqli_stmt_init($link2);
                                            if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        $checked = "";
                                                        if ($Region_idRegion != null) {
                                                            $checked = "checked";
                                                        }
                                                        echo "\n\t\t";
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                        echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion' $checked>$name_region<br>";
                                                        echo "</label>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--nono input-REGIÃO ES-->
                                    <div class="form-group formulario text-left" style="display:none;" id="es">
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou trabalhar <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class="sr-only">(Região que procuras estudar ou trabalhar)</span>
                                        <div class="form-check">
                                            <?php
                                            $query3 = "SELECT idRegion, name_region, Region_idRegion
                                                    FROM region
                                                    LEFT JOIN user_has_region
                                                    ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                    WHERE name_country = 'Espanha'";
                                            $stmt2 = mysqli_stmt_init($link2);
                                            if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        $checked = "";
                                                        if ($Region_idRegion != null) {
                                                            $checked = "checked";
                                                        }
                                                        echo "\n\t\t";
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                        echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion' $checked>$name_region<br>";
                                                        echo "</label>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--nono input-REGIÃO BE-->
                                    <div class="form-group formulario text-left" style="display:none;" id="be">
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou trabalhar <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class="sr-only">(Região que procuras estudar ou trabalhar)</span>
                                        <div class="form-check">
                                            <?php

                                            $query3 = "SELECT idRegion, name_region, Region_idRegion
                                                    FROM region
                                                    LEFT JOIN user_has_region
                                                    ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                    WHERE name_country = 'Bélgica'";
                                            $stmt2 = mysqli_stmt_init($link2);
                                            if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        $checked = "";
                                                        if ($Region_idRegion != null) {
                                                            $checked = "checked";
                                                        }
                                                        echo "\n\t\t";
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                        echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion' $checked>$name_region<br>";
                                                        echo "</label>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--nono input-REGIÃO IC-->
                                    <div class="form-group formulario text-left" style="display:none;" id="ic">
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou trabalhar <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class="sr-only">(Região que procuras estudar ou trabalhar)</span>
                                        <div class="form-check">
                                            <?php

                                            $query3 = "SELECT idRegion, name_region, Region_idRegion
                                                    FROM region
                                                    LEFT JOIN user_has_region
                                                    ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                    WHERE name_country = 'Islândia'";
                                            $stmt2 = mysqli_stmt_init($link2);
                                            if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        $checked = "";
                                                        if ($Region_idRegion != null) {
                                                            $checked = "checked";
                                                        }
                                                        echo "\n\t\t";
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                        echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion' $checked>$name_region<br>";
                                                        echo "</label>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!------------EXPERIÊNCIA DE TRABALHO------------>
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="exp_t">Experiência de trabalho</label><span class="sr-only">(Descreve a tua experiência de trabalho)</span>
                                        <textarea class="form-control " id="exp_t" rows="5" name="work" placeholder="Escreve aqui a tua experiência de trabalho"><?= $work_xp ?></textarea>
                                    </div>
                                    <!----------------------->

                                    <!--EDITEI A PARTIR DAQUI-->

                                    <hr>
                                    <h5 class="text-left titulo_cinza" role="heading">Sobre mim</h5>
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" role="heading" for="capacity">As frases que melhor me descrevem (selecionar cinco ou mais frases) <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class="sr-only">(Seleciona as cino ou mais frases que melhor te descrevem)</span>
                                        <!------------COMPETÊNCIAS------------>

                                        <div class="form-check">
                                            <?php
                                            $query4 = "SELECT idCapacities, capacity, capacities
                                                    FROM capacities
                                                    LEFT JOIN capacities_has_users
                                                    ON  capacities.idCapacities = capacities_has_users.capacities AND capacities_has_users.users_idUser = ?";
                                            $stmt2 = mysqli_stmt_init($link2);
                                            if (mysqli_stmt_prepare($stmt2, $query4)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idCapacities, $capacity, $capacities);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        $checked = "";
                                                        if ($capacities != null) {
                                                            $checked = "checked";
                                                        }

                                                        echo "\n\t\t";
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                        echo "<input type='checkbox' class='form-check-input' name='capacity[]' value='$idCapacities' $checked>$capacity<br>";
                                                        echo "</label>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--LOCAL ONDE GOSTARIA DE TRABALHAR-->
                                    <div class="form-group text-left">
                                        <h6 class="negrito mt-4" for="environment" role="heading">Os meus ambientes de trabalho favoritos <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></h6>
                                        <div class="form-check">
                                            <?php
                                            $query5 = "SELECT idwork_environment, name_environment, favorite_environment 
                                                       FROM work_environment
                                                       LEFT JOIN work_environment_has_users
                                                       ON work_environment.idwork_environment = work_environment_has_users.favorite_environment AND  work_environment_has_users.users_idUser = ?";
                                            $stmt2 = mysqli_stmt_init($link2);
                                            if (mysqli_stmt_prepare($stmt2, $query5)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt2)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt2, $idwork_environment, $name_environment, $favorite_environment);

                                                    /* fetch values */
                                                    while (mysqli_stmt_fetch($stmt2)) {
                                                        $checked = "";
                                                        if ($favorite_environment != null) {
                                                            $checked = "checked";
                                                        }

                                                        echo "\n\t\t";
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                        echo "<input type='checkbox' class='form-check-input' name='spot[]' value='$idwork_environment' $checked>$name_environment<br>";
                                                        echo "</label>";
                                                    }
                                                    /* close statement */
                                                    mysqli_stmt_close($stmt2);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!--ACABEI DE EDITAR AQUI-->

                                    <!--quinto input-DID-->
                                    <div class="form-group text-left">
                                        <label for="def" class="negrito">O que mais posso dizer sobre mim <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <textarea class="form-control cinza" id="def" rows="7" name="def" placeholder="Por exemplo: Se tiveres alguma necessidade indica aqui (como necessidade de elevador e/ou rampas de acesso)." required="required"><?= $info_young ?></textarea>
                                    </div>
                                    <!----------------------->
                                    <!---div com o valor de edit para poder voltar para aqui-->
                                    <input type="hidden" name="edit" value="<?= $idUser ?>">
                                    <!----------------------->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label label-margin"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn guardar_btn" value="Guardar">
                                            <span></span>
                                            <a href="profile.php?user=<?= $idUser ?>">
                                                <input type="text" class="btn cancel_btn" value="Cancelar">
                                            </a>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>
                        <!--fim da div row-->
                    <?php
                    } //este fecha o if se é um jovem
                    else { //se é uma empresa
                    ?>
                        <!--FORMULÁRIO DE EDITAR PARA EMPRESAS E UNIVERSIDADES-->
                        <div class="row">
                            <!-- left column -->

                            <div class="col-xs-12 col-md-4">

                                <div class="text-center">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input style="display: none" type="file" id="fileToUpload" name="fileToUpload image" accept=".png, .jpg, .jpeg" />
                                            <label class="label" for="fileToUpload"><i class="fas fa-edit mx-auto my-auto  text-align-center"></i></label>
                                            <input id="userIDhidden" value="<?= $idUser ?>" style="display: none;"></input>
                                        </div>
                                        <?php
                                        //var_dump($img_perfil);
                                        if (isset($profile_img)) {
                                        ?>
                                            <img id="img_perf" class="image_profile" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="imagem de perfil" title="imagem de perfil" />
                                        <?php
                                        } else {
                                        ?>
                                            <img id="img_perf" class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" title="sem imagem de perfil" />

                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <span>Carrega no botão que está em cima da imagem para alterar a tua imagem.</span>
                                    </div>
                                    <!----------------------MODAL DE CROP--------------->
                                    <div id="uploadimageModal" class="modal" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Importar e cortar a imagem de perfil</h4>
                                                    <button type="button" class="close" aria-label="Fechar" aria-hidden=true data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mx-auto">
                                                        <div class="col-12 text-center">
                                                            <div id="image_demo" style="display:block; margin:auto;"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <button class="buttonCustomise btn btn-primary crop_image" value="Upload Image" name="Submit"> Guardar</button>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!------------------->
                                </div>
                            </div>


                            <!-- edit form column -->
                            <div class="col-xs-12 col-md-8">
                                <form id="sectionForm" class="form-horizontal" role="form" method="post" action="scripts/update_profile.php?id_uni_emp=<?= $idUser ?>">
                                    <?php
                                    if (isset($_SESSION["edit"])) {
                                        $msg_show = true;
                                        switch ($_SESSION["edit"]) {
                                            case 1:
                                                $message = "Utilizador editado com sucesso.";
                                                $class = "alert-success";
                                                $_SESSION["edit"] = 0;
                                                break;
                                            case 2:
                                                $message = "É necessário preencher todos os campos obrigatórios.";
                                                $class = "alert-warning";
                                                $_SESSION["edit"] = 0;
                                                break;
                                            case 3:
                                                $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                                                $class = "alert-warning";
                                                $_SESSION["edit"] = 0;
                                                break;
                                            case 0:
                                                $msg_show = false;
                                                break;
                                            default:
                                                $msg_show = false;
                                                $_SESSION["edit"] = 0;
                                        }

                                        if ($msg_show == true) {
                                            echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Fechar\">
                                <span aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                                            echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                        }
                                    }
                                    ?>
                                    <p style="font-size: 12px; color: #00A5CF !important;">* Campos de preenchimento obrigatório.</p>
                                    <!--primeiro input-NOME-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="nome">Nome <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="text" id="nome" name="nome" placeholder="Escreva aqui o seu nome" class="form-control" aria-required="true" required="required" value="<?= $name_user ?>"><span class=sr-only>(Escreva aqui o seu nome)</span>
                                    </div>
                                    <!----------------------->
                                    <!--segundo input-EMAIL-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="email">Email <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="text" id="email" name="email" placeholder="Escreva aqui o seu e-mail" class="form-control" required="required" value="<?= $email_user ?>"><span class=sr-only>(Escreva aqui o seu e-mail)</span>
                                    </div>
                                    <!----------------------->
                                    <!--terceiro input-DATA DE NASCIMENTO-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="born">Data de fundação <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="date" id="born" name="data_fund" placeholder="data de nascimento" class="form-control" required="required" value="<?= $birth_date ?>"><span class=sr-only>(Escreva aqui a data de fundação)</span>
                                    </div>
                                    <!----------------------->
                                    <!--quarto input- TELEMÓVEL-->
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="tlm">Contacto <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="text" id="tlm" name="phone" placeholder="Escreva aqui o seu contacto" class="form-control" required="required" value="<?= $contact_user ?>"><span class=sr-only>(Escreva aqui o contacto)</span>
                                    </div>
                                    <!----------------------->
                                    <?php
                                    if ($type_user == "Universidade") {
                                    ?>
                                        <!--oitavo input-AREAS-->
                                        <div class="form-group text-left">
                                            <label class="negrito mt-3" for="area">Áreas de disponíveis <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class=sr-only>(Áreas disponíveis na universidade)</span>
                                            <div class="form-check">
                                                <?php
                                                $query2 = "SELECT idAreas, name_interested_area, Areas_idAreas
                                                        FROM areas
                                                        LEFT JOIN user_has_areas
                                                        ON  areas.idAreas= user_has_areas.Areas_idAreas AND user_has_areas.User_idUser= ?";
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                                    // Bind variables by type to each parameter
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt2, $idAreas, $name_interested_area, $Areas_idAreas);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            $checked = "";
                                                            if ($Areas_idAreas != null) {
                                                                $checked = "checked";
                                                            }

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6 label-margin'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='area[]' value='$idAreas' $checked>$name_interested_area<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <!----------------------->
                                    <?php
                                    }
                                    ?>
                                    <!------------PAÍS------------>
                                    <?php
                                    if ($type_user == "Empresa") {
                                    ?>
                                        <div class="form-group text-left">
                                            <label class="negrito mt-3" for="pais">Seleciona o país da empresa:
                                                <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label><span class=sr-only>(Selecione o país da empresa)</span>
                                            <select class="form-control" id="pais" required="required">
                                                <option value="pt">Portugal</option>
                                                <option value="es">Espanha</option>
                                                <option value="be">Bélgica</option>
                                                <option value="ic">Islândia</option>
                                            </select>
                                        </div>
                                        <!------------REGIÕES DE PORTUGAL------------>
                                        <div class="form-group formulario" id="pt">
                                            <div class="form-group text-left">
                                                <label class="negrito mt-3" for="regiao_pt">Região da Empresa
                                                    <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span>
                                                </label>
                                                <select class="form-control" id="regiao_pt" name="regiao" required="required">
                                                    <option value="" selected disabled>Seleciona uma opção</option>
                                                    <?php
                                                    $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                                    WHERE name_country = 'Portugal'";
                                                    $stmt2 = mysqli_stmt_init($link2);
                                                    if (mysqli_stmt_prepare($stmt2, $query2)) {
                                                        // Bind variables by type to each parameter
                                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                        /* execute the prepared statement */
                                                        if (mysqli_stmt_execute($stmt2)) {
                                                            /* bind result variables */
                                                            mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                            /* fetch values */
                                                            while (mysqli_stmt_fetch($stmt2)) {
                                                                if ($Region_idRegion == $idRegion) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                                echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                            }
                                                            /* close statement */
                                                            mysqli_stmt_close($stmt2);
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!------------REGIÕES DE ESPANHA------------>
                                        <div class="form-group formulario" style="display:none;" id="es">
                                            <div class="form-group text-left">
                                                <label class="negrito mt-3" for="regiao_es">Região da Empresa
                                                    <span class="asterisco">*</span>
                                                </label>
                                                <select class="form-control" id="regiao_es" name="regiao">
                                                    <option selected disabled>Seleciona uma opção</option>
                                                    <?php
                                                    $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                            INNER JOIN country ON region.country_idcountry = country.idcountry
                                                            LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                            WHERE name_country = 'Espanha'";
                                                    $stmt2 = mysqli_stmt_init($link2);
                                                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                                                        /* execute the prepared statement */
                                                        if (mysqli_stmt_execute($stmt2)) {
                                                            /* bind result variables */
                                                            mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                            /* fetch values */
                                                            while (mysqli_stmt_fetch($stmt2)) {
                                                                if ($Region_idRegion == $idRegion) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }

                                                                echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                            }
                                                            /* close statement */
                                                            mysqli_stmt_close($stmt2);
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!------------REGIÕES DE BÉLGICA------------>
                                        <div class="form-group formulario" style="display:none;" id="be">
                                            <div class="form-group text-left">
                                                <label class="negrito mt-3" for="regiao_be">Região da Empresa
                                                    <span class="asterisco">*</span>
                                                </label>
                                                <select class="form-control" id="regiao_be" name="regiao">
                                                    <option selected disabled>Seleciona uma opção</option>
                                                    <?php
                                                    $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                            INNER JOIN country ON region.country_idcountry = country.idcountry
                                                            LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                            WHERE name_country = 'Bélgica'";
                                                    $stmt2 = mysqli_stmt_init($link2);
                                                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                                                        /* execute the prepared statement */
                                                        if (mysqli_stmt_execute($stmt2)) {
                                                            /* bind result variables */
                                                            mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                            /* fetch values */
                                                            while (mysqli_stmt_fetch($stmt2)) {
                                                                if ($Region_idRegion == $idRegion) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                                echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                            }
                                                            /* close statement */
                                                            mysqli_stmt_close($stmt2);
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!------------REGIÕES DE ISLÂNDIA------------>
                                        <div class="form-group formulario" style="display:none;" id="ic">
                                            <div class="form-group text-left">
                                                <label class="negrito mt-3" for="regiao_ic">Região da Empresa
                                                    <span class="asterisco">*</span>
                                                </label>
                                                <select class="form-control" id="regiao_ic" name="regiao">
                                                    <option selected disabled>Seleciona uma opção</option>
                                                    <?php
                                                    $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                INNER JOIN country ON region.country_idcountry = country.idcountry
                                                LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                                    WHERE name_country = 'Islândia'";
                                                    $stmt2 = mysqli_stmt_init($link2);
                                                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                                                        /* execute the prepared statement */
                                                        if (mysqli_stmt_execute($stmt2)) {
                                                            /* bind result variables */
                                                            mysqli_stmt_bind_result($stmt2, $idRegion, $name_region, $Region_idRegion);

                                                            /* fetch values */
                                                            while (mysqli_stmt_fetch($stmt2)) {
                                                                if ($Region_idRegion == $idRegion) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                                echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                            }
                                                            /* close statement */
                                                            mysqli_stmt_close($stmt2);
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!------------WEBSITE------------>
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="site">Website <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <input type="text" class="form-control cinza" id="site" name="site" aria-required="true" placeholder="Insira aqui o website" required="required" value="<?= $website_ue ?>"><span class=sr-only>(Website)</span>
                                    </div>
                                    <!------------FACEBOOK------------>
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="face">Facebook</label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control cinza" id="face" name="face" placeholder="Insira aqui o facebook" value="<?= $facebook_ue ?>"><span class=sr-only>(Facebook)</span>
                                        </div>
                                    </div>
                                    <!------------INSTAGRAM------------>
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="insta">Instagram</label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control cinza" id="insta" name="insta" placeholder="Insira aqui o instagram" value="<?= $instagram_ue ?>"><span class=sr-only>(Instagram)</span>
                                        </div>
                                    </div>
                                    <!------------DESCRIÇÃO------------>
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="desc">Descrição <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                        <textarea class="form-control " id="desc" rows="7" name="desc" placeholder="Escreva aqui uma descrição" aria-required="true" required="required"> <?= $description_ue ?></textarea><span class=sr-only>(Descrição)</span>
                                    </div>
                                    <?php
                                    if ($type_user == "Universidade") {
                                    ?>
                                        <!------------HISTÓRIA------------>
                                        <div class="form-group text-left">
                                            <label class="negrito mt-3" for="hist">História <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                            <textarea class="form-control " id="hist" rows="9" name="hist" placeholder="Escreva aqui a história da Universidade" aria-required="true" required="required"> <?= $history_ue ?></textarea><span class=sr-only>(História da universidade)</span>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!---div com o valor de edit para poder voltar para aqui-->
                                    <input type="hidden" name="edit" value="<?= $idUser ?>">
                                    <!----------------------->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label label-margin"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn guardar_btn" value="Guardar">
                                            <span></span>
                                            <a href="profile.php?user=<?= $idUser ?>">
                                                <input type="text" class="btn cancel_btn" value="Cancelar">
                                            </a>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>
                        <!--fim da div row-->
            <?php
                    }
                }
                /* close statement */
                mysqli_stmt_close($stmt);
            }
            ?>
            </div>
        </div>

    <?php
    /* close connection */
    mysqli_close($link);
    mysqli_close($link2);
} else {
    include("404.php");
} //fim do else se não existir o GET
    ?>