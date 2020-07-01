<div class="container">
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <a href="../index.php">
                                        <img class="pb-4 img-fluid re_size" src="img/logo.svg" alt="Logótipo do HiLives">
                                    </a>
                                    <h4 class="h4 negrito mb-4">Junte-se a nós!</h4>
                                </div>
                                <?php
                                if (isset($_SESSION["register"])) {
                                    $msg_show = true;
                                    switch ($_SESSION["register"]) {
                                        case 1:
                                            $message = "Ocorreu um erro no registo, por favor tente novamente.";
                                            $class = "alert-warning";
                                            $_SESSION["register"] = 0;
                                            break;
                                        case 2:
                                            $message = "É necessário preencher todos os campos obrigatórios.";
                                            $class = "alert-warning";
                                            $_SESSION["register"] = 0;
                                            break;
                                        case 0:
                                            $msg_show = false;
                                            break;
                                        default:
                                            $msg_show = false;
                                            $_SESSION["register"] = 0;
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


                                <form method="post" role="form" id="register-form" action="scripts/register_uni.php">
                                    <?php
                                    require_once("connections/connection.php");
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);

                                    ?>
                                    <!------------****------------>
                                    <p style="font-size: 12px; color: #00A5CF !important;">* Preenchimento
                                        obrigatório</p>
                                    <!------------NOME------------>
                                    <div class="form-group">
                                        <label class="negrito" for="username">Nome <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class=" p-0 m-0">
                                            <input type="text" class="form-control cinza" id="username" name="nome" placeholder="Escreva aqui o nome da universidade" required="required">
                                        </div>
                                    </div>
                                    <!------------EMAIL------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="email">Email <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control cinza" id="email" name="email" placeholder="Escreva aqui o email da universidade" required="required" onchange="email_validate(this.value);">
                                        </div>
                                    </div>
                                    <!------------DATA DE FUNDAÇÃO------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="data_fund">Data de fundação <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="date" class="form-control cinza" id="data_fund" name="data_fund" placeholder="Data de fundação da universidade" required="required">
                                        </div>
                                    </div>
                                    <!------------TELEFONE------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="phone">Contacto telefónico <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="tel" class="form-control cinza" id="phone" name="phone" placeholder="Escreva aqui o contacto telefónico da universidade" required="required">
                                        </div>
                                    </div>
                                    <!------------PAÍS------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="pais">Seleciona o país da universidade:
                                            <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
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
                                            <label class="negrito mt-3" for="regiao_pt">Região da Universidade
                                                <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span>
                                            </label>
                                            <select class="form-control" id="regiao_pt" name="regiao" required>
                                                <option value="" selected disabled>Seleciona uma opção</option>
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
                                            <label class="negrito mt-3" for="regiao_es">Região da Universidade
                                                <span class="asterisco">*</span>
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
                                            <label class="negrito mt-3" for="regiao_be">Região da Universidade
                                                <span class="asterisco">*</span>
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
                                            <label class="negrito mt-3" for="regiao_ic">Região da Universidade
                                                <span class="asterisco">*</span>
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

                                    <!------------ÁREAS------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="area">Áreas disponíveis para receber jovens com DID <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
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
                                                        echo "<label class='form-check-label col-xs-12 col-md-6 label_margin'>";
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

                                    <!------------WEBSITE------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="site">Website <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control cinza" id="site" name="site" placeholder="Insira aqui o website da universidade" required="required">
                                        </div>
                                    </div>
                                    <!------------FACEBOOK------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="face">Facebook</label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control cinza" id="face" name="face" placeholder="Insira aqui o facebook da universidade">
                                        </div>
                                    </div>
                                    <!------------INSTAGRAM------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="insta">Instagram</label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control cinza" id="insta" name="insta" placeholder="Insira aqui o instagram da universidade">
                                        </div>
                                    </div>

                                    <!------------DESCRIÇÃO------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="desc">Descrição <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <textarea class="form-control " id="exp_t" rows="5" name="desc" placeholder="Escreva aqui uma descrição" required="required"></textarea>
                                    </div>
                                    <!------------HISTÓRIA------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="hist">História <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <textarea class="form-control " id="exp_t" rows="7" name="hist" placeholder="Escreva aqui a história da universidade" required="required"></textarea>
                                    </div>


                                    <!------------PASSWORD------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="pass">Palavra-passe <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Crie a palavra-passe para o HiLives" required="required" onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="negrito mt-3" for="vpass">Verificar palavra-passe <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control" id="password_confirm" placeholder="Repita a palavra-passe" required="required" onkeyup="checkPass(); return false;">
                                            <span id="confirmMessage" class="confirmMessage"></span>
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <div class="pb-3 pt-2">
                                            <button type="submit" class="btn publicar_btn">Registar</button>
                                        </div>
                                    </div>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="forgot-password.php">Esqueceste-te da tua palavra-passe?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.php">Já estás inscrito? Inicia sessão!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkPass() {
        //Store the password field objects into variables ...
        var pass1 = $("#register-form #password");
        var pass2 = $("#register-form #password_confirm");

        console.log(pass1.value, pass2);
        //Store the Confimation Message Object ...
        var message = $('#confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        var opacidade = "0.7";
        //Compare the values in the password field
        //and the confirmation field
        if (pass1.val() == pass2.val()) {
            //The passwords match.
            //Set the color to the good color and inform
            //the user that they have entered the correct password
            pass2.css("backgroundColor", goodColor);
            message.css("color", goodColor);
            message.html("As palavras-passe estão iguais!");
        } else {
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            pass2.css("backgroundColor", badColor);
            pass2.css("opacity", opacidade);
            message.css("color", badColor);
            message.html("As palavras-passe são diferentes!");
        }
    }
</script>