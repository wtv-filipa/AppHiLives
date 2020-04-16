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
                                <!------------NOME------------>
                                <form method="post" role="form" id="register-form" action="scripts/register.php">
                                    <?php
                                    require_once("connections/connection.php");
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);

                                    $query = "SELECT Educ_lvl_idEduc_lvl FROM users ";
                                    if (mysqli_stmt_prepare($stmt, $query)) {


                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $Educ_lvl_idEduc_lvl);
                                    while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <div class="form-group">
                                        <label class="negrito" for="username">Nome</label>
                                        <div class=" p-0 m-0">
                                            <input type="text" class="form-control cinza" id="username" name="nome"
                                                   placeholder="Escreve aqui o teu nome"
                                                   required="required">
                                        </div>
                                    </div>
                                    <!------------EMAIL------------>
                                    <div class="form-group">
                                        <label class="negrito" for="email">Email</label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control cinza" id="email" name="email"
                                                   placeholder="Escreve aqui o teu email"
                                                   required="required" onchange="email_validate(this.value);">
                                        </div>
                                    </div>
                                    <!------------TELEFONE------------>
                                    <div class="form-group">
                                        <label class="negrito" for="phone">Telefone</label>
                                        <div class="p-0 m-0">
                                            <input type="tel" class="form-control cinza" id="phone" name="phone"
                                                   placeholder="Escreve aqui o teu telefone"
                                                   required="required" onchange="email_validate(this.value);">
                                        </div>
                                    </div>
                                    <!------------DATA DE NASCIMENTO------------>
                                    <div class="form-group">
                                        <label class="negrito" for="data_nasc">Data de nascimento</label>
                                        <div class="p-0 m-0">
                                            <input type="date" class="form-control cinza" id="data_nasc"
                                                   name="data_nasc"
                                                   placeholder="data de nascimento">
                                        </div>
                                    </div>
                                    <!------------REGIÃO------------>

                                    <div class="form-group">
                                        <label class="negrito" for="regiao">Região que procuras estudar ou
                                            trabalhar</label>
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
                                                        echo "\n\t\t
                                                      
                                                            <label class=\"form-check-label col-6\">
                                                                <input type=\"checkbox\" class=\"form-check-input\" value=\"\">$name_region
                                                            </label>
                                                        ";
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_stmt_error($stmt);
                                                }

                                                /* close statement */
                                                //mysqli_stmt_close($stmt);
                                            } else {
                                                echo "Error: " . mysqli_error($link);
                                            }

                                            /* close connection */
                                            //mysqli_close($link);

                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!------------DEFICIÊNCIA------------>
                                    <div class="form-group">
                                        <label class="negrito" for="def">Deficiência</label>
                                        <textarea class="form-control cinza" id="def" rows="2" name="def"
                                                  placeholder="Escreve aqui a tua DID"></textarea>
                                    </div>
                                    <!------------LAUDO------------>
                                    <div class="form-group">
                                        <label class="negrito" for="laudo">Emissão do laudo</label>
                                        <div class="p-0 m-0">
                                            <input type="date" class="form-control cinza" id="laudo" name="laudo"
                                                   placeholder="laudo">
                                        </div>
                                    </div>
                                    <!------------ESCOLARIDADE------------>
                                    <div class="form-group text-left">
                                        <label class="label-margin negrito" for="esc">Escolaridade</label>
                                        <select class="form-control" id="esc">
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

                                            /* close connection */
                                            //mysqli_close($link);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--                            <div class="form-group">-->
                                    <!--                                <label class="negrito" for="school">Escolaridade</label>-->
                                    <!--                                <div class="radio">-->
                                    <!--                                    <label><input type="radio" name="optradio">Option 1</label>-->
                                    <!--                                </div>-->
                                    <!--                                <div class="radio">-->
                                    <!--                                    <label><input type="radio" name="optradio">Option 2</label>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!------------EXPERIÊNCIA DE TRABALHO------------>
                                    <div class="form-group mb-5">
                                        <label class="negrito" for="exp_t">Experiência de trabalho</label>
                                        <textarea class="form-control " id="exp_t" rows="2" name="work"
                                                  placeholder="Escreve aqui a tua experiência de trabalho"></textarea>
                                    </div>
                                    <hr>
                                    <!------------PERSONALIDADE------------>
                                    <h5 class="titulo_cinza">Sobre ti</h5>

                                    <div class="form-group mt-4">
                                        <div class="form-group text-left">
                                            <label class="label-margin negrito" for="regiao">Sou uma pessoa que:</label>
                                            <select class="form-control" id="regiao">
                                                <option selected disabled>Seleciona uma opção</option>

                                                <option>Tenho muitos amigos</option>
                                                <option>Gosto de organizar tarefas</option>
                                                <option>Convivo melhor com a rotina</option>
                                                <option>Procuro sempre coisas claras e objetivas</option>
                                            </select>
                                        </div>

                                        <div class="form-group text-left">
                                            <label class="label-margin negrito" for="regiao">No convívio com outras
                                                pessoas, eu:</label>
                                            <select class="form-control" id="regiao">
                                                <option selected disabled>Seleciona uma opção</option>
                                                <option>Estou sempre a motivar as pessoas</option>
                                                <option>Prefiro fazer as minhas coisas sozinho ou sozinha</option>
                                                <option>Sou muito paciente com as outras pessoas</option>
                                                <option>Gosto de pessoas sérias</option>
                                            </select>
                                        </div>

                                        <div class="form-group text-left">
                                            <label class="label-margin negrito" for="regiao">Com qual destas frases mais
                                                te identificas?</label>
                                            <select class="form-control" id="regiao">
                                                <option selected disabled>Seleciona uma opção</option>
                                                <option>“Tu tornas-te naquilo que desejas”</option>
                                                <option>“Prevenir é melhor que remediar”</option>
                                                <option>“Quando falta sorte deve sobrar atitude”</option>
                                                <option>“Quem tem boca vai a Roma”</option>
                                            </select>
                                        </div>

                                        <div class="form-group text-left">
                                            <label class="label-margin negrito" for="regiao">Em situações de stress,
                                                eu:</label>
                                            <select class="form-control" id="regiao">
                                                <option selected disabled>Seleciona uma opção</option>
                                                <option>Mantenho a atenção naquilo que tenho que fazer</option>
                                                <option>Avalio as possibilidades e previno-me para não me stressar
                                                    novamente
                                                </option>
                                                <option>Mantenho a calma</option>
                                                <option>Falo com outras pessoas que me possam ajudar a melhorar</option>
                                            </select>
                                        </div>

                                        <!------------PASSWORD------------>
                                        <div class="form-group mt-4">
                                            <label class="negrito" for="pass">Palavra-passe</label>
                                            <div class="p-0 m-0">
                                                <input type="password" class="form-control" id="password"
                                                       name="password"
                                                       placeholder="Escreve aqui uma palavra-passe"  required="required"
                                                       onkeyup="checkPass(); return false;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="negrito" for="vpass">Verificar palavra-passe</label>
                                            <div class="p-0 m-0">
                                                <input type="password" class="form-control" id="password_confirm"
                                                       placeholder="Escreve aqui a palavra-passe novamente" required="required"
                                                       onkeyup="checkPass(); return false;">
                                                <span id="confirmMessage" class="confirmMessage"></span>
                                            </div>
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