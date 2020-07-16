<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "helpers/meta.php"; ?>
        <title>Contacto</title>
        <?php include "helpers/fonts.php"; ?>
        <?php include "helpers/css_question_form.php"; ?>
    </head>

    <body class="fundo_login">
        <header class="sticky-top">
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <?php include "components/question_form.php"; ?>
        </main>
        
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script type="text/javascript" src="js/notifications.js"></script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else {
    header("Location: ../public/login.php");
}
?>