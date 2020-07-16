<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <?php include "helpers/meta.php"; ?>
        <title>As minhas ligações- Estudar e trabalhar</title>

        <?php include "helpers/fonts.php"; ?>

        <?php include "helpers/css_can_choose_ws.php"; ?>

    </head>

    <body id="fundo">
        <header class="sticky-top">

            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">

            <?php include "components/can_choose_ws.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>

        <?php include "helpers/fontawesome.php"; ?>
        <?php include "helpers/js.php"; ?>
        <script src="js/fav.js"></script>
        <script type="text/javascript" src="js/notifications.js"></script>
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