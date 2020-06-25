<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>
        <title>Editar Experiência</title>
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
            <?php include "components/edit_xp.php"; ?>
        </main>
        <!--javascript-->
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/js_upload.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
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