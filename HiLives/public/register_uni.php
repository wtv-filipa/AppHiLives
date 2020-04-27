<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>
    <title>Registo Universidade</title>
    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "helpers/css_register_login.php"; ?>
</head>

<body id="page-top" class="fundo_login">

<!-- Page Wrapper -->
<div id="wrapper">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!--cartões com earnings pequenos-->
                <?php include "components/register_uni.php"; ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

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

<?php include "helpers/js.php"; ?>
<?php include "helpers/fontawesome.php"; ?>
</body>

</html>
