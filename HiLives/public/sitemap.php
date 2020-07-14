<?php
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>

        <title>Mapa da Aplicação</title>

        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>

        <!-- Custom styles for this template-->
        <?php include "helpers/css_sitemap.php"; ?>

    </head>

    <body id="fundo">

        <header class="sticky-top">
            <!--navbar-->
            <?php include "components/navbar.php"; ?>
        </header>

        <main class="container">
            <?php include "components/sitemap.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>

        <!-- JavaScript-->
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script type="text/javascript" src="js/notifications.js"></script>
    </body>

    </html>
