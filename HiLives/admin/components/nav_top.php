<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  // Create a new DB connection
  $link = new_db_connection();
  /* create a prepared statement */
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT name_user, profile_img
          FROM users
          WHERE idUser LIKE ?";

?>
  <nav class="navbar navbar-expand navbar-light bg-white1 topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow text-right align-items-right">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $idUser);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $name_user, $img_perfil);
            while (mysqli_stmt_fetch($stmt)) {
          ?>
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$name_user;?></span>
              <?php
              if (isset($img_perfil)) {
              ?>
                <img class="img-profile rounded-circle" src="uploads/img_perfil/<?=$img_perfil;?>" alt="imagem de perfil">
              <?php
              } else {
              ?>
                <img class="img-profile rounded-circle" src="img/no_profile_img.png" alt="imagem de perfil default">
          <?php
              }
            }
          }
          ?>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="edit_profile.php?edit=<?=$idUser?>">
            <i class="fas fa-user-edit mr-2 text-gray-400"></i>
            Editar perfil
          </a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Sair
          </a>
        </div>
      </li>

    </ul>

  </nav>
<?php
}
?>