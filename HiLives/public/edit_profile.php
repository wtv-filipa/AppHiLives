<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>
    <title>Editar perfil</title>
    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "helpers/css_edit_profile.php"; ?>

</head>

<body>
    <header class="sticky-top">
        <!--navbar-->
        <?php include "components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto">
        <!--componente da home sem login-->
        <?php include "components/edit_profile.php"; ?>
    </main>

    <!-- JavaScript-->
    <script>
        var select = document.getElementById("pais");
        var formularios = document.querySelectorAll('.formulario');

        select.onchange = function () {
            for (var i = 0; i < formularios.length; i++) formularios[i].style.display = 'none';
            var divID = select.options[select.selectedIndex].value;
            var div = document.getElementById(divID);
            div.style.display = 'block';
        };
    </script>

    <?php include "helpers/js_upload.php";?>
    <?php include "helpers/fontawesome.php"; ?>
</body>

</html>