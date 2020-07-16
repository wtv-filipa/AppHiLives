<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "helpers/meta.php"; ?>
    <title>Página em construção</title>
    <?php include "helpers/fonts.php"; ?>
    <?php include "helpers/css_construction.php"; ?>

</head>

<body id="fundo">
    <header class="sticky-top">
        <?php include "components/navbar.php"; ?>
    </header>
    <main class="container">
        <?php include "components/construction.php"; ?>
    </main>
    <?php include "components/footer.php"; ?>
    
    <?php include "helpers/js.php"; ?>
    <?php include "helpers/fontawesome.php"; ?>
    <script type="text/javascript" src="js/notifications.js"></script>
</body>

</html>