<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "helpers/meta.php"; ?>
        <title>Página inicial</title>
        <?php include "helpers/fonts.php"; ?>
        <?php include "helpers/css_home.php"; ?>

    </head>

    <body id="fundo">
        <?php include "components/loading_screen.php"; ?>
        <header class="sticky-top">
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <?php include "components/home_uni.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>
        
        <?php include "helpers/fontawesome.php"; ?>
        <?php include "helpers/js.php"; ?>
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
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
} else {
    header("Location: ../public/login.php");
}
?>