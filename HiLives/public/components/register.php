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


                                <form method="post" role="form" id="register-form" action="scripts/register.php">
                                    <?php
                                    require_once("connections/connection.php");
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);

                                    ?>
                                    <!------------****------------>
                                    <p style="font-size: 12px; color: #79C4D9 !important;">* Preenchimento
                                        obrigatório</p>
                                    <!------------NOME------------>
                                    <div class="form-group">
                                        <label class="negrito" for="username">Nome <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class=" p-0 m-0">
                                            <input type="text" class="form-control cinza" id="username" name="nome"
                                                   placeholder="Escreve aqui o teu nome" required="required">
                                        </div>
                                    </div>
                                    <!------------EMAIL------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="email">Email <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control cinza" id="email" name="email"
                                                   placeholder="Escreve aqui o teu email" required="required"
                                                   onchange="email_validate(this.value);">
                                        </div>
                                    </div>
                                    <!------------DATA DE NASCIMENTO------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="data_nasc">Data de nascimento <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="date" class="form-control cinza" id="data_nasc"
                                                   name="data_nasc" placeholder="data de nascimento">
                                        </div>
                                    </div>
                                    <!------------TELEFONE------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="phone">Telemóvel</label>
                                        <div class="p-0 m-0">
                                            <input type="tel" class="form-control cinza" id="phone" name="phone"
                                                   placeholder="Escreve aqui o teu telemóvel">
                                        </div>
                                    </div>
                                    <!------------DEFICIÊNCIA------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="def">Detalhes sobre a minha DID <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                        <textarea class="form-control cinza" id="def" rows="2" name="def"
                                                  placeholder="Descreve aqui a tua DID"></textarea>
                                    </div>
                                    <!------------ESCOLARIDADE------------>
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
                                    <!------------ESTUDO------------>
                                    <div class="form-group">
                                        <div class="form-group text-left">
                                            <label class="label-margin negrito mt-3" for="study_work">O que procuras?
                                                <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
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

                                                            echo "\n\t\t<option value=\"$idStudy_work\">$name_type</option>";
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
                                        <label class="negrito mt-3" for="area">Áreas de interesse <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
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
                                                        echo "<label class='form-check-label col-6'>";
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
                                        <label class="negrito mt-3" for="pais">Seleciona o país onde queres estudar:
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
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou
                                            trabalhar <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
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
                                                        echo "<label class='form-check-label col-6'>";
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
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou
                                            trabalhar <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
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
                                                        echo "<label class='form-check-label col-6'>";
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
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou
                                            trabalhar <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
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
                                                        echo "<label class='form-check-label col-6'>";
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
                                        <label class="negrito mt-3" for="regiao">Região que procuras estudar ou
                                            trabalhar <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
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
                                                        echo "<label class='form-check-label col-6'>";
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
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="exp_t">Experiência de trabalho</label>
                                        <textarea class="form-control " id="exp_t" rows="2" name="work"
                                                  placeholder="Escreve aqui a tua experiência de trabalho"></textarea>
                                    </div>

                                    <!------------PASSWORD------------>
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="pass">Palavra-passe <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="Cria a tua palavra-passe para o HiLives"
                                                   required="required" onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label class="negrito mt-3" for="vpass">Verificar palavra-passe <span
                                                    style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control" id="password_confirm"
                                                   placeholder="Repete a tua palavra-passe" required="required"
                                                   onkeyup="checkPass(); return false;">
                                            <span id="confirmMessage" class="confirmMessage"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <!------------PERSONALIDADE------------>
                                    <h5 class="titulo_cinza">Sobre ti</h5>

                                    <div class="form-group">
                                        <div class="form-group text-left">
                                            <label class="label-margin negrito mt-3" for="primeiro">Sou uma pessoa
                                                que:</label>
                                            <select class="form-control" id="primeiro">
                                                <option selected disabled>Seleciona uma opção</option>
                                                <option name="c">Tenho muitos amigos</option>
                                                <option name="o">Gosto de organizar tarefas</option>
                                                <option name="pr">Convivo melhor com a rotina</option>
                                                <option name="d">Procuro sempre coisas claras e objetivas</option>
                                            </select>
                                        </div>

                                        <div class="form-group text-left">
                                            <label class="label-margin negrito mt-3" for="segundo">No convívio com
                                                outras
                                                pessoas, eu:</label>
                                            <select class="form-control" id="segundo">
                                                <option selected disabled>Seleciona uma opção</option>
                                                <option name="c">Estou sempre a motivar as pessoas</option>
                                                <option name="d">Prefiro fazer as minhas coisas sozinho ou sozinha
                                                </option>
                                                <option name="pr">Sou muito paciente com as outras pessoas</option>
                                                <option name="o">Gosto de pessoas sérias</option>
                                            </select>
                                        </div>

                                        <div class="form-group text-left">
                                            <label class="label-margin negrito mt-3" for="terceiro">Com qual destas
                                                frases mais me identifico?</label>
                                            <select class="form-control" id="terceiro">
                                                <option selected disabled>Seleciona uma opção</option>
                                                <option name="o">“Tu tornas-te naquilo que desejas”</option>
                                                <option name="pr">“Prevenir é melhor que remediar”</option>
                                                <option name="d">“Quando falta sorte deve sobrar atitude”</option>
                                                <option name="c">“Quem tem boca vai a Roma”</option>
                                            </select>
                                        </div>

                                        <div class="form-group text-left mb-5">
                                            <label class="label-margin negrito mt-3" for="quarto">Em situações de
                                                stress,
                                                eu:</label>
                                            <select class="form-control" id="quarto">
                                                <option selected disabled>Seleciona uma opção</option>
                                                <option name="d">Mantenho a atenção naquilo que tenho que fazer</option>
                                                <option name="pr">Avalio as possibilidades e previno-me para não me
                                                    stressar
                                                    novamente
                                                </option>
                                                <option name="o">Mantenho a calma</option>
                                                <option name="c">Falo com outras pessoas que me possam ajudar a
                                                    melhorar
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group mt-4 text-center">
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
            message.html("Passwords Match");
        } else {
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            pass2.css("backgroundColor", badColor);
            pass2.css("opacity", opacidade);
            message.css("color", badColor);
            message.html("Passwords Do Not Match!");
        }
    }
</script>