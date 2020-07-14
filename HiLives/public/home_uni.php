<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Página inicial</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <?php include "helpers/css_home.php"; ?>

</head>

<body id="fundo">
<header class="sticky-top">
    <!--navbar-->
    <?php include "components/navbar.php"; ?>
</header>
<main class="container p-0 mb-5 mx-auto">
    <!--componente da homepage-->
    <?php include "components/home_uni.php"; ?>
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
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: home_companies.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
} else {
    header("Location: ../public/login.php");
}
?>