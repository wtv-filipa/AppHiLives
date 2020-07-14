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
                                        <img class="pb-4 img-fluid re_size" src="img/logo.svg" alt="Logótipo do HiLives" title="Junta-te à HiLives!">
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
                                <span title=\"Fechar\" aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                    }
                                }
                                ?>

                                <!---->
                                <form id="register-form" method="post" role="form" action="scripts/register.php">

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
                                                <input type="text" class="form-control cinza" id="username" name="nome" placeholder="Escreve aqui o teu nome" aria-required="true" required="required">
                                            </div>
                                        </div>
                                        <!------------EMAIL------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="email">Email <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control cinza" id="email" name="email" placeholder="Escreve aqui o teu email" aria-required="true" required="required" onchange="email_validate(this.value);">
                                            </div>
                                        </div>

                                        <!------------PASSWORD------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="password">Palavra-passe <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Cria a tua palavra-passe para o HiLives" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="password_confirm">Verificar palavra-passe <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="password" class="form-control" id="password_confirm" placeholder="Repete a tua palavra-passe" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                                <span id="confirmMessage" class="confirmMessage"></span>
                                            </div>
                                        </div>
                                        <!------------DATA DE NASCIMENTO------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="data_nasc">Data de nascimento <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="date" class="form-control cinza" id="data_nasc" name="data_nasc" placeholder="data de nascimento" aria-required="true" required="required">
                                            </div>
                                        </div>
                                        <!------------TELEFONE------------>
                                        <div class="form-group">
                                            <label class="negrito mt-3" for="phone">Telemóvel <span class="asterisco">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="tel" class="form-control cinza" id="phone" name="phone" placeholder="Escreve aqui o teu telemóvel" aria-required="true" required="required">
                                            </div>
                                        </div>
                                        <!------------ESCOLARIDADE------------>
                                        <div class="form-group text-left">
                                            <label class="label-margin negrito mt-3" for="esc">Escolaridade <span class="asterisco">*</span></label>
                                            <select class="form-control" id="esc" name="esc" aria-required="true" required>
                                                <option value="" selected disabled>Selecionar uma opção</option>
                                                <?php
                                                $query = "SELECT idEduc_lvl, name_education FROM educ_lvl";

                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idEduc_lvl, $name_education);
                                                        while (mysqli_stmt_fetch($stmt)) {
                                                            echo "\n\t\t<option value=\"$idEduc_lvl\">$name_education</option>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
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
                                                $stmt = mysqli_stmt_init($link);
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idAreas, $name_interested_area);
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-12  label_margin' role='checkbox'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='area[]' value='$idAreas'>$name_interested_area<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
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
                                                $stmt = mysqli_stmt_init($link);
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6 label_margin'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion'>$name_region<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
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
                                                $stmt = mysqli_stmt_init($link);
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion'>$name_region<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
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
                                                $stmt = mysqli_stmt_init($link);
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion'>$name_region<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
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
                                                $stmt = mysqli_stmt_init($link);
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='regiao[]' value='$idRegion'>$name_region<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
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
                                            <h6 class="negrito mt-4" for="capacity" role="heading">As frases que melhor me descrevem (selecionar cinco ou mais frases)<span class="asterisco">*</span></h6>
                                            <div class="form-check">
                                                <?php
                                                $query = "SELECT idcapacities, capacity FROM capacities";
                                                $stmt = mysqli_stmt_init($link);
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idcapacities, $capacity);
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-12 label_margin' role='checkbox'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='capacity[]' value='$idcapacities'>$capacity<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
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
                                                $stmt = mysqli_stmt_init($link);
                                                if (mysqli_stmt_prepare($stmt, $query)) {
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_bind_result($stmt, $idwork_environment, $name_environment);
                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            echo "\n\t\t";
                                                            echo "<label class='form-check-label col-xs-12 col-md-6  label_margin' role='checkbox'>";
                                                            echo "<input type='checkbox' class='form-check-input' name='environment[]' value='$idwork_environment'>$name_environment<br>";
                                                            echo "</label>";
                                                        }
                                                        /* close statement */
                                                        mysqli_stmt_close($stmt);
                                                    }
                                                }
                                                /* close connection */
                                                mysqli_close($link);
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
