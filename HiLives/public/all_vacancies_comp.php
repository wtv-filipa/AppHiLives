<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include "helpers/meta.php"; ?>
        <title>Todas as vagas</title>
        <?php include "helpers/fonts.php"; ?>
        <?php include "helpers/css_home.php"; ?>
    </head>

    <body id="fundo">
        <header class="sticky-top">
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <?php include "components/all_vacancies_comp.php"; ?>
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
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: home_uni.php");
} else {
    header("Location: ../public/login.php");
}
?>