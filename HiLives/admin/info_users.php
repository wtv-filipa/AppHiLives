<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php include "helpers/meta.php"; ?>
    <title>Informação do utilizador</title>
    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>
    <!-- Custom styles for this template-->
    <?php include "helpers/css.php"; ?>
    <?php include "helpers/css_info_users.php"; ?>
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
          <div class="container">
            <!-- /.container-fluid -->
            <?php include "components/info_users.php"; ?>
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
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
  header("Location: ../public/home_companies.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
  header("Location: ../public/home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
  header("Location: ../public/home_uni.php");
} else {
  header("Location: ../public/login.php");
}
?>