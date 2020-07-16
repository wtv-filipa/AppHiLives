<?php
session_start();
if (isset($_SESSION["idUser"])) {
    if ($_SESSION["type"] == 10 || $_SESSION["type"] == 13) {
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <?php include "helpers/meta.php"; ?>
            <title>História da universidade</title>
            <?php include "helpers/fonts.php"; ?>
            <?php include "helpers/css_about_university.php"; ?>
        </head>

        <body id="fundo">
            <header class="sticky-top">
                <?php include "components/navbar.php"; ?>
            </header>
            <main class="container">
                <?php include "components/about_university.php"; ?>
            </main>
            <?php include "components/footer.php"; ?>
            
            <?php include "helpers/fontawesome.php"; ?>
            <?php include "helpers/js.php"; ?>
            <script type="text/javascript" src="js/notifications.js"></script>
        </body>

        </html>
<?php
    } else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
        header("Location: ../admin/index.php");
    } else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
        header("Location: home_companies.php");
    } else {
        header("Location: ../public/login.php");
    }
} else {
    header("Location: ../public/login.php");
}
?>