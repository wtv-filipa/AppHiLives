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

<body>
    <header class="sticky-top">
        <!--navbar-->
        <?php include "public/components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto">
        <!--componente da home sem login-->
        <?php include "public/components/index.php"; ?>
    </main>
    <!-- JavaScript-->
    <?php include "public/helpers/js.php"; ?>
    <?php include "public/helpers/fontawesome.php"; ?>
</body>

</html>