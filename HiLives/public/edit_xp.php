<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "helpers/meta.php"; ?>
        <title>Editar Experiência</title>
        <?php include "helpers/fonts.php"; ?>
        <?php include "helpers/css_upload.php"; ?>

    </head>

    <body class="fundo_login">

        <?php include "components/loading_screen.php"; ?>
        
        <header class="sticky-top">
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <?php include "components/edit_xp.php"; ?>
        </main>
        
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/js_upload.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script type="text/javascript" src="js/notifications.js"></script>
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
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: home_uni.php");
} else {
    header("Location: ../public/login.php");
}
?>