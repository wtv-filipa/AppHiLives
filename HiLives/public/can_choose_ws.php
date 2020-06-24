<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>
        <title>As minhas ligações</title>
        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>
        <!-- Custom styles for this template-->
        <?php include "helpers/css_can_choose_ws.php"; ?>

    </head>

    <body id="fundo">
        <header class="sticky-top">
            <!--navbar-->
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <!--componente da home sem login-->
            <?php include "components/can_choose_ws.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>
        <!--javascript-->
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