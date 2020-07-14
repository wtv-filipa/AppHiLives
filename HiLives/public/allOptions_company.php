<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] != 4) {
    $tipo = $_SESSION["type"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>
        <?php
        if ($tipo == 10 || $tipo == 13) {
        ?>
            <title>Todas as vagas</title>
        <?php
        } else {
        ?>
            <title>Todos os Jovens</title>
        <?php
        }
        ?>
        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>
        <!-- Custom styles for this template-->
        <?php include "helpers/css_allOptions_company.php"; ?>

    </head>

    <body id="fundo">
        <header class="sticky-top">
            <!--navbar-->
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container p-0 mb-5 mx-auto">
            <!--componente da home sem login-->
            <?php include "components/allOptions_company.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>
        <!-- JavaScript-->
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script type="text/javascript" src="js/notifications.js"></script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else {
    header("Location: ../public/login.php");
}
?>