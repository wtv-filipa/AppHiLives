<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>
    <title>Posso escolher- Estudar</title>
     <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "helpers/css_can_choose_study.php"; ?>

</head>

<body>
    <header class="sticky-top">
        <!--navbar-->
        <?php include "components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto">
        <!--componente da home sem login-->
        <?php include "components/choose_study.php"; ?>
    </main>
    <?php include "helpers/fontawesome.php"; ?>
    <?php include "helpers/js.php"; ?>
</body>

</html>