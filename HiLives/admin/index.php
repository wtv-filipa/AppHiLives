<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "helpers/meta.php"; ?>

    <title>Página Inicial</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <?php include "helpers/css.php"; ?>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include "components/side_nav.php"; ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include "components/nav_top.php"; ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <?php include "components/heading.php"; ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php include "components/footer.php"; ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <?php include "components/scroll_button.php"; ?>
    <!-- Logout Modal-->
    <?php include "components/logout_modal.php"; ?>
    <!-- Bootstrap core JavaScript-->
    <?php include "helpers/js.php"; ?>

</body>

</html>