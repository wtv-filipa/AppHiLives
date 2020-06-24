<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>

        <title>Sobre universidade</title>

        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>

        <!-- Custom styles for this template-->
        <?php include "helpers/css_about_university.php"; ?>

    </head>

    <body>
        <header class="sticky-top">
            <!--navbar-->
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container">

            <?php include "components/about_university.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>
        <!-- JavaScript-->
        <?php include "helpers/fontawesome.php"; ?>
        <?php include "helpers/js.php"; ?>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else {
    header("Location: ../public/login.php");
}
?>