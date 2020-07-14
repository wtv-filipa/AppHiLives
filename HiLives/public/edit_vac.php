<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>
        <title>Editar Vaga</title>
        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>
        <!-- Custom styles for this template-->
        <?php include "helpers/css_upload.php"; ?>

    </head>

    <body class="fundo_login">
        <header class="sticky-top">
            <!--navbar-->
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <!--componente da home sem login-->
            <?php include "components/edit_vac.php"; ?>
        </main>
        <!--javascript-->
        <script>
            (function() {
                const form = document.querySelector('#sectionForm');
                const checkboxes = form.querySelectorAll('input[type=checkbox]');
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
                    const checkedCheckboxes = form.querySelectorAll('input[type="checkbox"]:checked');

                    return checkedCheckboxes.length == 5;
                }

                function checkValidity() {
                    const errorMessage = !isChecked() ? 'Deve selecionar cinco capacidades.' : '';
                    firstCheckbox.setCustomValidity(errorMessage);
                }

                init();
            })();
        </script>
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/js_upload.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script type="text/javascript" src="js/notifications.js"></script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: home_uni.php");
} else {
    header("Location: ../public/login.php");
}
?>