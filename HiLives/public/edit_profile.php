<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>
        <title>Editar perfil</title>
        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>
        <!-- Custom styles for this template-->
        <?php include "helpers/css_edit_profile.php"; ?>

    </head>

    <body class="fundo_login">
        <header class="sticky-top">
            <!--navbar-->
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <!--componente da home sem login-->
            <?php include "components/edit_profile.php"; ?>
        </main>

        <!-- JavaScript-->
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <!--upload img-->
        <?php include "helpers/js_crop.php"; ?>
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

                const form = document.querySelector('#sectionForm');

                // Let's add a validation for the first group of checkboxes
                const checkboxes = form.querySelectorAll('input[name="area[]"]');
                addValidation(checkboxes);

                // another group of checkboxes
                const subCheckboxes = form.querySelectorAll('input[name="regiao[]"]');
                addValidation(subCheckboxes);

                // another group of checkboxes
                const subCheckboxes3 = form.querySelectorAll('input[name="spot[]"]');
                addValidation(subCheckboxes3);
            })();
            /***********************/
            (function() {
                const form = document.querySelector('#sectionForm');
                const checkboxes = form.querySelectorAll('input[name="capacity[]"]');
                const checkboxLength = checkboxes.length;
                const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

                function init() {
                    if (firstCheckbox) {
                        for (let i = 0; i < checkboxLength; i++) {
                            checkboxes[i].addEventListener('change', checkValidity);
                        }

                        checkValidity();
                    }
                }

                function isChecked() {
                    const checkedCheckboxes = form.querySelectorAll('input[name="capacity[]"]:checked');

                    return checkedCheckboxes.length >= 5;
                }

                function checkValidity() {
                    const errorMessage = !isChecked() ? 'É necessário selecionar pelo menos cinco frases.' : '';
                    firstCheckbox.setCustomValidity(errorMessage);
                }

                init();
            })();
            /***********************/
            var select = document.getElementById("pais");
            var formularios = document.querySelectorAll('.formulario');

            select.onchange = function() {
                for (var i = 0; i < formularios.length; i++) formularios[i].style.display = 'none';
                var divID = select.options[select.selectedIndex].value;
                var div = document.getElementById(divID);
                div.style.display = 'block';
            };
        </script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else {
    header("Location: ../public/login.php");
}
?>