<?php
if (isset($_GET["edit"])) {
    $idUser = $_GET["edit"];
    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    //ir buscar os dados
    $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, profile_img
    FROM users
    WHERE idUser LIKE ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $profile_img);
?>
        <!--FORMULÁRIO DE EDITAR PARA OS JOVENS-->
        <div class="w-75 mx-auto">
            <div class="card text-center">
                <h4>Editar Perfil</h4>
                <hr>
                <?php
                while (mysqli_stmt_fetch($stmt)) {
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
                                        <img id="img_perf" class="image_profile" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" />
                                    <?php
                                    } else {
                                    ?>
                                        <img id="img_perf" class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" />

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
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                                        <button class="buttonCustomise btn btn-primary crop_image" value="Upload Image" name="Submit"> Editar</button>
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
                            <form class="form-horizontal" role="form" method="post" action="scripts/update_profile.php?id=<?= $idUser ?>">
                                <?php
                                if (isset($_SESSION["erro"])) {
                                    $msg_show = true;
                                    switch ($_SESSION["erro"]) {
                                        case 1:
                                            $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                                            $class = "alert-warning";
                                            $_SESSION["erro"] = 0;
                                            break;
                                        case 2:
                                            $message = "É necessário ter todos os campos obrigatórios preenchidos.";
                                            $class = "alert-warning";
                                            $_SESSION["erro"] = 0;
                                            break;
                                        case 0:
                                            $msg_show = false;
                                            break;
                                        default:
                                            $msg_show = false;
                                            $_SESSION["erro"] = 0;
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
                                <!------------****------------>
                                <p style="font-size: 12px; color: #00A5CF !important;">* Campos de preenchimento obrigatório.</p>
                                <!--primeiro input-NOME-->
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="nome">Nome <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                    <input type="text" id="nome" name="nome" placeholder="Escreve aqui o teu nome" required="required" class="form-control" value="<?= $name_user ?>">
                                </div>
                                <!----------------------->
                                <!--segundo input-EMAIL-->
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="email">Email <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                    <input type="text" id="email" name="email" placeholder="Escreve aqui o teu email" required="required" class="form-control" value="<?= $email_user ?>">
                                </div>
                                <!----------------------->
                                <!--terceiro input-DATA DE NASCIMENTO-->
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="born">Data de nascimento <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                                    <input type="date" id="born" name="data_nasc" placeholder="data de nascimento" required="required" class="form-control" value="<?= $birth_date ?>">
                                </div>
                                <!----------------------->
                                <!--quarto input- TELEMÓVEL-->
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="tlm">Telemóvel</label>
                                    <input type="text" id="tlm" name="phone" placeholder="Escreve aqui o teu telemóvel" class="form-control" value="<?= $contact_user ?>">
                                </div>
                                <!----------------------->
                                <!--PAÍS-->
                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="pais">Selecione o seu país:
                                        <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
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
                                        <label class="negrito mt-3" for="regiao_pt">Região
                                            <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_pt" name="regiao" required="required">
                                            <option value="" selected disabled>Seleciona uma opção</option>
                                            <?php
                                            $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                                    INNER JOIN country ON region.country_idcountry = country.idcountry
                                                                    LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                                    WHERE name_country = 'Portugal'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                                // Bind variables by type to each parameter
                                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

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
                                        <label class="negrito mt-3" for="regiao_es">Região
                                            <span class="asterisco">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_es" name="regiao">
                                            <option selected disabled>Seleciona uma opção</option>
                                            <?php
                                            $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                INNER JOIN country ON region.country_idcountry = country.idcountry
                                                LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                                    WHERE name_country = 'Espanha'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {

                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

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
                                        <label class="negrito mt-3" for="regiao_be">Região
                                            <span class="asterisco">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_be" name="regiao">
                                            <option selected disabled>Seleciona uma opção</option>
                                            <?php
                                            $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                INNER JOIN country ON region.country_idcountry = country.idcountry
                                                LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                                    WHERE name_country = 'Bélgica'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {

                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

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
                                        <label class="negrito mt-3" for="regiao_ic">Região
                                            <span class="asterisco">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_ic" name="regiao">
                                            <option selected disabled>Seleciona uma opção</option>
                                            <?php
                                            $query2 = "SELECT idRegion, name_region, Region_idRegion FROM region 
                                                INNER JOIN country ON region.country_idcountry = country.idcountry
                                                LEFT JOIN user_has_region ON  region.idRegion= user_has_region.Region_idRegion AND user_has_region.User_idUser_region= ?
                                                                    WHERE name_country = 'Islândia'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {

                                                /* execute the prepared statement */
                                                if (mysqli_stmt_execute($stmt)) {
                                                    /* bind result variables */
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

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
                                <!----------------------->
                                <div class="form-group">
                                    <label class="col-md-3 control-label label-margin"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn guardar_btn" value="Guardar">
                                        <span></span>
                                        <input type="reset" class="btn cancel_btn" value="Cancelar">
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>
                    <!--fim da div row-->


            <?php

                }
            }
            ?>
            </div>
        </div>

    <?php

} else {
    include("404.php");
} //fim do else se não existir o GET
    ?>