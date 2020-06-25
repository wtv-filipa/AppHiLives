<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>
    <title>Carregar Vaga</title>
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
        <?php include "components/upload_vac.php"; ?>
    </main>
    <!--javascript-->
    <script>
        var select = document.getElementById("pais");
        var formularios = document.querySelectorAll('.formulario');

        select.onchange = function() {
            for (var i = 0; i < formularios.length; i++) formularios[i].style.display = 'none';
            var divID = select.options[select.selectedIndex].value;
            var div = document.getElementById(divID);
            div.style.display = 'block';
        };
    </script>
    <?php include "helpers/js.php"; ?>
    <?php include "helpers/js_upload.php"; ?>
    <?php include "helpers/fontawesome.php"; ?>

</body>

</html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: home_uni.php");
} else {
    header("Location: ../public/login.php");
}
?>