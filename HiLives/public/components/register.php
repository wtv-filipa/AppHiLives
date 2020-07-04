<div class="container">


    <div class="row justify-content-center " id="inicio2">

        <div class="col-xl-6 col-lg-6 col-md-6" id="inicio">

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
                                    <h4 class="negrito mb-4" role="heading">Junta-te a nós!</h4>
                                    <p class="mb-4 descricao">Plataforma de apoio à qualificação e emprego de jovens com dificuldades intelectuais e desenvolvimentais.</p>
                                </div>
                                <?php
                                if (isset($_SESSION["register"])) {
                                    $msg_show = true;
                                    switch ($_SESSION["register"]) {
                                        case 1:
                                            $message = "Ocorreu um erro no registo, por favor tenta novamente.";
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


                                <form method="post" role="form" id="register-form" action="scripts/register.php">

                                    <?php
                                    require_once("connections/connection.php");
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);

                                    ?>

                                    <!------------****------------>
                                    <p style="font-size: 12px; color: #00A5CF !important;">* Preenchimento
                                        obrigatório</p>
                                    <!------------NOME------------>
                                    <div class="tab">
                                        <div class="form-group">
                                            <label class="negrito" for="username">Nome <span class="asterisco">*</span></label>
                                            <div class=" p-0 m-0">
                                                <input type="text" class="form-control cinza" id="username" name="nome" placeholder="Escreve aqui o teu nome" required="required">
                                            </div>
                                        </div>
                                        <!------------EMAIL------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="email">Email <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control cinza" id="email" name="email" placeholder="Escreve aqui o teu email" required="required" onchange="email_validate(this.value);">
                                            </div>
                                        </div>

                                        <!------------PASSWORD------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="password">Palavra-passe <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Cria a tua palavra-passe para o HiLives" required="required" onkeyup="checkPass(); return false;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="password_confirm">Verificar palavra-passe <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="password" class="form-control" id="password_confirm" placeholder="Repete a tua palavra-passe" required="required" onkeyup="checkPass(); return false;">
                                                <span id="confirmMessage" class="confirmMessage"></span>
                                            </div>
                                        </div>
                                        <!------------DATA DE NASCIMENTO------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="data_nasc">Data de nascimento <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="date" class="form-control cinza" id="data_nasc" name="data_nasc" placeholder="data de nascimento" required="required">
                                            </div>
                                        </div>
                                        <!------------TELEFONE------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="phone">Telemóvel <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="tel" class="form-control cinza" id="phone" name="phone" placeholder="Escreve aqui o teu telemóvel" required="required">
                                            </div>
                                        </div>
                                        <!------------ESCOLARIDADE------------>
                                        <div class="form-group text-left">
                                            <label class="label-margin negrito mt-3" for="esc">Escolaridade</label>
                                            <select class="form-control" id="esc" name="esc" required>
                                                <option value="" selected disabled>Selecionar uma opção</option>
                                                <?php
                                                $query = "SELECT idEduc_lvl, name_education FROM educ_lvl";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt, $idEduc_lvl, $name_education);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t<option value=\"$idEduc_lvl\">$name_education</option>";
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

                                        <!------------ÁREAS------------>
                                        <div class="form-group">
                                            <h6 class="negrito mt-4" for="area" role="heading">As minhas áreas de interesse (para estudar ou trabalhar) <span class="asterisco">*</span></h6>
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
                                                            echo "<label class='form-check-label col-xs-12 col-md-12  label_margin' role='checkbox'>";
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
                                        <!------------PAÍS------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="pais">País onde quero estudar <span style="color: #00A5CF !important; font-weight: bold; font-size: 20px">*</span></label>
                                            <select class="form-control" id="pais">
                                                <option value="pt">Portugal</option>
                                                <option value="es">Espanha</option>
                                                <option value="be">Bélgica</option>
                                                <option value="ic">Islândia</option>
                                            </select>
                                        </div>
                                        <!------------REGIÕES DE PORTUGAL------------>
                                        <div class="form-group formulario" id="pt">
                                            <h6 class="negrito mt-4" for="regiao" role="heading">Região onde quero estudar ou
                                                trabalhar <span class="asterisco">*</span></h6>
                                            <div class="form-check">
                                                <?php
                                                $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Portugal'";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6 label_margin'>";
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
                                        <!------------REGIÕES DE ESPANHA------------>
                                        <div class="form-group formulario" style="display:none;" id="es">
                                            <h6 class="negrito mt-4" for="regiao" role="heading">Região onde quero estudar ou
                                                trabalhar <span class="asterisco">*</span></h6>
                                            <div class="form-check">
                                                <?php
                                                $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Espanha'";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin'>";
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
                                        <!------------REGIÕES DA BÉLGICA------------>
                                        <div class="form-group formulario" style="display:none;" id="be">
                                            <h6 class="negrito mt-4" for="regiao" role="heading">Região onde quero estudar ou
                                                trabalhar <span class="asterisco">*</span></h6>
                                            <div class="form-check">
                                                <?php
                                                $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Bélgica'";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin'>";
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
                                        <!------------REGIÕES DA ISLÂNDIA------------>
                                        <div class="form-group formulario" style="display:none;" id="ic">
                                            <h6 class="negrito mt-4" for="regiao" role="heading">Região onde quero estudar ou
                                                trabalhar <span class="asterisco">*</span></h6>
                                            <div class="form-check">
                                                <?php
                                                $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Islândia'";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin'>";
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

                                        <!------------EXPERIÊNCIA DE TRABALHO------------>
                                        <div class="form-group mb-5">
                                            <label class="negrito mt-3" for="exp_t">A minha experiência de trabalho</label>
                                            <textarea class="form-control " id="exp_t" rows="5" name="work" placeholder="Escreve aqui a tua experiência de trabalho"></textarea>
                                        </div>

                                        <hr>

                                    </div>
                                    <div class="tab">
                                        <!------------SOBRE MIM------------>
                                        <h5 class="titulo_cinza" role="heading">Sobre mim</h5>
                                        <!------------COMPETÊNCIAS------------>
                                        <div class="form-group">
                                            <h6 class="negrito mt-4" for="capacity" role="heading">As minhas competências (assinalar apenas as que melhor se adequam)<span class="asterisco">*</span></h6>
                                            <div class="form-check">
                                                <?php
                                                $query = "SELECT idcapacities, capacity FROM capacities";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt, $idcapacities, $capacity);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-12 label_margin' role='checkbox'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='capacity[]' value='$idcapacities'>$capacity<br>";
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
                                        <!--LOCAL ONDE GOSTARIA DE TRABALHAR-->
                                        <div class="form-group">
                                            <h6 class="negrito mt-4" for="environment" role="heading">Quais são os meus ambientes de trabalho favoritos?<span class="asterisco">*</span></h6>
                                            <div class="form-check">
                                                <?php
                                                $query = "SELECT idwork_environment, name_environment FROM work_environment";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    /* execute the prepared statement */
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        /* bind result variables */
                                                        mysqli_stmt_bind_result($stmt, $idwork_environment, $name_environment);

                                                        /* fetch values */
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin' role='checkbox'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='environment[]' value='$idwork_environment'>$name_environment<br>";
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
                                        <!------------MAIS DETALHES SOBRE ELE------------>
                                        <div class="form-group mb-5">
                                            <label class="negrito mt-3" for="def">O que mais posso dizer sobre mim <span class="asterisco">*</span></label>
                                            <textarea class="form-control cinza" id="def" rows="7" name="def" placeholder="Por exemplo: Se tiveres alguma necessidade indica aqui (como necessidade de elevador e/ou rampas de acesso)."></textarea>
                                        </div>

                                    </div>



                                    <div style="overflow:auto;">
                                        <div style=" width: 100%; text-align: center">
                                            <a href="#inicio"><button class="publicar_btn_reg" type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior </button></a>
                                            <a href="#inicio2"><button class="publicar_btn_reg" type="button" id="nextBtn" onclick="nextPrev(1)">Próximo</button></a>
                                        </div>
                                    </div>

                                    <!-- Circles which indicates the steps of the form: -->
                                    <div style="text-align:center; margin-top:40px;">
                                        <span class="step"></span>
                                        <span class="step"></span>
                                    </div>

                                    <!--                                    <div class="form-group mt-4 text-center">-->
                                    <!--                                        <div class="pb-3 pt-2">-->
                                    <!--                                            <button type="submit" class="btn publicar_btn">Registar</button>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
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



    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Finalizar";
        } else {
            document.getElementById("nextBtn").innerHTML = "Próximo";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("register-form").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }
</script>