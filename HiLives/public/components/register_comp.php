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
                                    <img class="pb-5 img-fluid" src="img/logo.png">
                                    <h1 class="h4 negrito mb-4">Junta-te a nós!</h1>
                                </div>
                                <?php
                                if (isset($_GET["msg"])) {
                                    $msg_show = true;
                                    switch ($_GET["msg"]) {
                                        case 0:
                                            $message = "Ocorreu um erro no registo, por favor tenta novamente!";
                                            $class = "alert-warning";
                                            break;
                                        case 1:
                                            $message = "Registo efectuado com sucesso.";
                                            $class = "alert-success";
                                            break;
                                        case 2:
                                            $message = "Campos do formulário por preencher.";
                                            $class = "alert-warning";
                                            break;
                                        default:
                                            $msg_show = false;
                                    }

                                    echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
                                    if ($msg_show) {
                                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                    }
                                }
                                ?>


                                <form method="post" role="form" id="register-form" action="scripts/register_comp.php">
                                    <?php
                                    require_once("connections/connection.php");
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);
                                  ?>
                                            <!------------****------------>
                                            <p style="font-size: 12px; color: #00A5CF !important;">* Preenchimento obrigatório</p>
                                            <!------------NOME------------>
                                            <div class="form-group">
                                                <label class="negrito" for="username">Nome <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <div class=" p-0 m-0">
                                                    <input type="text" class="form-control cinza" id="username"
                                                           name="nome"
                                                           placeholder="Escreva aqui o nome da empresa"
                                                           required="required">
                                                </div>
                                            </div>
                                            <!------------EMAIL------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="email">Email <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <div class="p-0 m-0">
                                                    <input type="email" class="form-control cinza" id="email"
                                                           name="email"
                                                           placeholder="Escreva aqui o email da empresa"
                                                           required="required" onchange="email_validate(this.value);">
                                                </div>
                                            </div>
                                            <!------------DATA DE FUNDAÇÃO------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="data_fund">Data de fundação <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <div class="p-0 m-0">
                                                    <input type="date" class="form-control cinza" id="data_fund"
                                                           name="data_fund"
                                                           placeholder="Data de fundação da empresa"  required="required">
                                                </div>
                                            </div>
                                            <!------------TELEFONE------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="phone">Contacto telefónico <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <div class="p-0 m-0">
                                                    <input type="tel" class="form-control cinza" id="phone" name="phone"
                                                           placeholder="Escreva aqui o contacto telefónico da empresa" required="required">
                                                </div>
                                            </div>
                                            <!------------PAÍS------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="pais">Seleciona o país da empresa:
                                                    <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
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
                                                    <label class="negrito mt-3" for="regiao_pt">Região da Empresa
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
                                                    <label class="negrito mt-3" for="regiao_es">Região da Empresa
                                                        <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span>
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
                                                        <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span>
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
                                                        <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span>
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



                                            <!------------WEBSITE------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="site">Website <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <div class="p-0 m-0">
                                                    <input type="text" class="form-control cinza" id="site" name="site"
                                                           placeholder="Insira aqui o website da empresa" required="required">
                                                </div>
                                            </div>
                                            <!------------FACEBOOK------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="face">Facebook</label>
                                                <div class="p-0 m-0">
                                                    <input type="text" class="form-control cinza" id="face" name="face"
                                                           placeholder="Insira aqui o facebook da empresa">
                                                </div>
                                            </div>
                                            <!------------INSTAGRAM------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="insta">Instagram</label>
                                                <div class="p-0 m-0">
                                                    <input type="text" class="form-control cinza" id="insta" name="insta"
                                                           placeholder="Insira aqui o instagram da empresa">
                                                </div>
                                            </div>

                                            <!------------DESCRIÇÃO------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="desc">Descrição <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <textarea class="form-control " id="exp_t" rows="2" name="desc" placeholder="Escreva aqui uma descrição" required="required"></textarea>
                                            </div>


                                            <!------------PASSWORD------------>
                                            <div class="form-group">
                                                <label class="negrito mt-3" for="pass">Palavra-passe <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <div class="p-0 m-0">
                                                    <input type="password" class="form-control" id="password"
                                                           name="password"
                                                           placeholder="Crie a palavra-passe para o HiLives"
                                                           required="required" onkeyup="checkPass(); return false;">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="negrito mt-3" for="vpass">Verificar palavra-passe <span style="color: #00A5CF!important; font-weight: bold; font-size: 20px">*</span></label>
                                                <div class="p-0 m-0">
                                                    <input type="password" class="form-control" id="password_confirm"
                                                           placeholder="Repita a palavra-passe" required="required"
                                                           onkeyup="checkPass(); return false;">
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