<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>
    <title>Carregar Experiência</title>
    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "helpers/css_upload.php"; ?>

</head>

<body>
    <header class="sticky-top">
        <!--navbar-->
        <?php include "components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto">
        <!--componente da home sem login-->
        <?php include "components/upload_xp.php"; ?>
    </main>
    <?php include "helpers/js_upload.php";?>
    <?php include "helpers/fontawesome.php"; ?>
    <?php include "helpers/js.php"; ?>
</body>

</html>