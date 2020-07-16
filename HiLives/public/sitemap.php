<?php
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "helpers/meta.php"; ?>
        <title>Mapa da Aplicação</title>
        <?php include "helpers/fonts.php"; ?>
        <?php include "helpers/css_sitemap.php"; ?>
    </head>

    <body id="fundo">
        <header class="sticky-top">
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container">
            <?php include "components/sitemap.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>

        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script type="text/javascript" src="js/notifications.js"></script>
    </body>

    </html>
