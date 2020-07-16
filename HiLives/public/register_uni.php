<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "helpers/meta.php"; ?>
        <title>Registo Universidade</title>
        <?php include "helpers/fonts.php"; ?>
        <?php include "helpers/css_register_login.php"; ?>
    </head>

    <body id="page-top" class="fundo_login_reg">
        <?php include "components/loading_screen.php"; ?>
        <div id="wrapper">
            <div class="container-fluid">
                <?php include "components/register_uni.php"; ?>
            </div>
        </div>

        <script>
             (function() {
                function addValidation(checkboxes) {
                    const firstCheckbox = getFirstCheckbox(checkboxes);

                    if (firstCheckbox) {
                        for (let i = 0; i < checkboxes.length; i++) {
                            checkboxes[i].addEventListener('change', function() {
                                checkValidity(checkboxes, firstCheckbox);
                            });
                        }

                        checkValidity(checkboxes, firstCheckbox);
                    }
                }

                function getFirstCheckbox(checkboxes) {
                    return checkboxes.length > 0 ? checkboxes[0] : null;
                }

                function isChecked(checkboxes) {
                    for (let i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) return true;
                    }

                    return false;
                }

                function checkValidity(checkboxes, firstCheckbox) {
                    const errorMessage = !isChecked(checkboxes) ? 'É necessário ter pelo menos uma opção selecionada.' : '';
                    firstCheckbox.setCustomValidity(errorMessage);
                }

                const form = document.querySelector('#register-form');

                // Let's add a validation for the first group of checkboxes
                const checkboxes = form.querySelectorAll('input[name="area[]"]');
                addValidation(checkboxes);
            })();
            /*************************/
            var select = document.getElementById("pais");
            var formularios = document.querySelectorAll('.formulario');

            select.onchange = function() {
                for (var i = 0; i < formularios.length; i++) formularios[i].style.display = 'none';
                var divID = select.options[select.selectedIndex].value;
                var div = document.getElementById(divID);
                div.style.display = 'block';
            };
        </script>

        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script>
            $(window).on("load", function() {
                $(".loader-wrapper").fadeOut("slow");
            });
        </script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: home_companies.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: home_uni.php");
}
?>