<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>HiLives</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <?php include "helpers/css_home.php"; ?>

</head>

<body>
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