<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "public/helpers/meta.php"; ?>
    <title>Bem vindo(a)!</title>
     <!-- Custom fonts for this template-->
    <?php include "public/helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "public/helpers/css_index.php"; ?>

</head>

<body id="fundo">
    <header class="sticky-top">
        <!--navbar-->
        <?php include "public/components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto">
        <!--componente da home sem login-->
        <?php include "public/components/index.php"; ?>
    </main>
    <?php include "public/components/footer_index.php"; ?>
    <!-- JavaScript-->
    <?php include "public/helpers/js.php"; ?>
    <?php include "public/helpers/fontawesome.php"; ?>
</body>

</html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: public/home_companies.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: public/home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: public/home_uni.php");
}
?>