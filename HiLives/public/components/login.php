<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <img class="pb-4 img-fluid re_size" src="img/logo.svg" alt="Logótipo do HiLives">
                                    <h4 class="text-gray-900 mb-4">Bem-vindo!</h4>
                                </div>
                                <?php
                                if (isset($_SESSION["login"])) {
                                    $msg_show = true;
                                    switch ($_SESSION["login"]) {
                                        case 1:
                                            $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                                            $class = "alert-warning";
                                            $_SESSION["login"] = 0;
                                            break;
                                        case 2:
                                            $message = "É necessário ter todos os campos preenchidos.";
                                            $class = "alert-warning";
                                            $_SESSION["login"] = 0;
                                            break;
                                        case 3:
                                            $message = "Dados inseridos incorretos, por favor tente novamente.";
                                            $class = "alert-warning";
                                            $_SESSION["login"] = 0;
                                            break;
                                        case 4:
                                            $message = "Registo efetuado com sucesso!";
                                            $class = "alert-success";
                                            $_SESSION["login"] = 0;
                                            break;
                                        case 0:
                                            $msg_show = false;
                                            break;
                                        default:
                                            $msg_show = false;
                                            $_SESSION["login"] = 0;
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
                                <form method="post" role="form" id="register-form" action="scripts/login.php">
                                    <!---EMAIL-->
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="input2UserForm">Email</label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control cinza" id="input2UserForm" name="email" placeholder="Escreve aqui o email da tua conta no HiLives" required="required">
                                        </div>
                                    </div>
                                    <!--PASSWORD-->
                                    <div class="form-group">
                                        <label class="negrito mt-3" for="password">Palavra-passe</label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Escreve aqui a tua palavra-passe do HiLives" required="required" onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>
                                    <!--BOTÃO DE SUBMIT-->
                                    <div class="form-group text-center mt-2">
                                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                                            <button type="submit" class="btn publicar_btn">Entrar</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot_password.php">Esqueceste-te da tua palavra-passe?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="../index.php">Ainda não estás inscrito? Faz o teu registo!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>