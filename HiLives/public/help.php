<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Ajuda - HiLives</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <?php include "helpers/css_help.php"; ?>

</head>

<body>

<header class="sticky-top">
    <!--navbar-->
    <?php include "components/navbar.php"; ?>
</header>

<main class="container">
    <?php include "components/help.php"; ?>
</main>
<?php include "components/footer.php"; ?>

<!-- JavaScript-->
<?php include "helpers/js.php"; ?>
<?php include "helpers/fontawesome.php"; ?>
</body>

</html>