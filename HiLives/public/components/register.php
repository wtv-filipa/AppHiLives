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
                            <h1 class="h4 text-gray-900 mb-4">Junta-te a nós!</h1>
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

                        <form method="post" role="form" id="register-form" action="scripts/registo.php">
                            <div class="form-group muda">
                                <label class="text-gray-800" for="username">Nome</label>
                                <div class=" p-0 m-0">
                                    <input type="text" class="form-control" id="input2UserForm" name="nome"
                                           placeholder="nome"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="email">Email</label>
                                <div class="p-0 m-0">
                                    <input type="email" class="form-control" id="input2EmailForm" name="email"
                                           placeholder="email"
                                           required="required" onchange="email_validate(this.value);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="data_nasc">Data de nascimento</label>
                                <div class="p-0 m-0">
                                    <input type="date" class="form-control" id="data_nasc" name="data_nasc"
                                           placeholder="data de nascimento">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="pass">Password</label>
                                <div class="p-0 m-0">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="password" required="required"
                                           onkeyup="checkPass(); return false;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="vpass">Verificar password</label>
                                <div class="p-0 m-0">
                                    <input type="password" class="form-control" id="password_confirm"
                                           placeholder="verificar password" required="required"
                                           onkeyup="checkPass(); return false;">
                                    <span id="confirmMessage" class="confirmMessage"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="pb-3 pt-2">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Registar
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.php">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
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