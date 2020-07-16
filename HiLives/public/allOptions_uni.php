<?php
session_start();
if (isset($_SESSION["idUser"])) {
    if ($_SESSION["type"] == 10 || $_SESSION["type"] == 13) {
        $tipo = $_SESSION["type"];
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <?php include "helpers/meta.php"; ?>
            <?php
            if ($tipo == 10) {
            ?>
                <title>Todas as universidades</title>
            <?php
            } else {
            ?>
                <title>Todos os Jovens</title>
            <?php
            }
            ?>
            <?php include "helpers/fonts.php"; ?>
            <?php include "helpers/css_allOptions_uni.php"; ?>
        </head>

        <body id="fundo">
            <header class="sticky-top">
                <?php include "components/navbar.php"; ?>
            </header>
            <main class="container p-0 mb-5 mx-auto">
                <?php include "components/allOptions_uni.php"; ?>
            </main>
            <?php include "components/footer.php"; ?>
            
            <?php include "helpers/js.php"; ?>
            <?php include "helpers/fontawesome.php"; ?>
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