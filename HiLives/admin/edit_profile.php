<?php
session_start();
if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php include "helpers/meta.php"; ?>
    <title>Editar perfil</title>
    <?php include "helpers/fonts.php"; ?>
    <?php include "helpers/css.php"; ?>
    <?php include "helpers/css_edit_profile.php"; ?>
    <?php include "helpers/datatable.php"; ?>

  </head>

  <body id="page-top">
    <div id="wrapper">
      <?php include "components/side_nav.php"; ?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <?php include "components/nav_top.php"; ?>

          <div class="container">
            <?php include "components/edit_profile.php"; ?>
          </div>
          <?php include "components/footer.php"; ?>

        </div>
      </div>
      <?php include "components/scroll_button.php"; ?>
      <?php include "components/logout_modal.php"; ?>
      <?php include "helpers/js.php"; ?>
      <?php include "helpers/fontawesome.php"; ?>
      <?php include "helpers/js_crop.php"; ?>
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