<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "helpers/meta.php"; ?>
        <title>Iniciar sessão</title>
        <?php include "helpers/fonts.php"; ?>
        <?php include "helpers/css_register_login.php"; ?>
    </head>


    <body id="page-top" class="fundo_login">
        <?php include "components/loading_screen.php"; ?>
        <div id="wrapper">
            <div class="container-fluid">
                <?php include "components/login.php"; ?>
            </div>
        </div>

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
    header("Location: home_uni.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
}
?>