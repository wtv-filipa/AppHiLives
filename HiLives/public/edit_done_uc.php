<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>
    <title>Editar UC feita</title>
     <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "helpers/css_upload.php"; ?>

</head>

<body class="fundo_login">
    <header class="sticky-top">
        <!--navbar-->
        <?php include "components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto">
        <!--componente da home sem login-->
        <?php include "components/edit_done_uc.php"; ?>
    </main>
    <!--javascript-->
    <?php include "helpers/fontawesome.php"; ?>
    <?php include "helpers/js.php"; ?>
</body>

</html>