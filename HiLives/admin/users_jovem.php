<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "helpers/meta.php"; ?>
    <title>Jovens inscritos</title>
    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "helpers/css.php"; ?>
    <!-- Custom styles for this page -->
    <?php include "helpers/datatable.php"; ?>
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
        <!-- /.container-fluid -->
        <?php include "components/table_user_jovem.php"; ?>
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
  <?php include "helpers/js_tables.php"; ?>

</body>

</html>