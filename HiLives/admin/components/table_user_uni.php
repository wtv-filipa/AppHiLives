<?php
require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  // Create a new DB connection
  $link = new_db_connection();
  /* create a prepared statement */
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, profile_img, website_ue, facebook_ue, instagram_ue, description_ue, history_ue, active
  FROM users INNER JOIN user_type on users.User_type_idUser_type= user_type.idUser_type
            WHERE type_user='Universidade'
            ORDER BY idUser DESC";
  $array_val = mysqli_query($link, $query);
?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Universidades</h1>
  <p class="mb-4">Aqui é possível visualizar e gerir todas as Universidades inscritas na aplicação até ao momento.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Contacto telefónico</th>
              <th>Data de fundação</th>
              <th>Website</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Contacto telefónico</th>
              <th>Data de fundação</th>
              <th>Website</th>
              <th>Ações</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt,  $id_user_lista, $name_user, $email_user, $contact_user, $birth_date, $profile_img, $website_ue, $facebook_ue, $instagram_ue, $description_ue, $history_ue, $active);
              while ($row_users = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_users['name_user']; ?></td>
                  <td><?= $row_users['email_user']; ?></td>
                  <td><?= $row_users['contact_user']; ?></td>
                  <td><?= $row_users['birth_date']; ?></td>
                  <td><?= $row_users['website_ue']; ?></td>
                  <td>
                    <a href="info_users.php?info=<?= $row_users['idUser'] ?>"><i class="fas fa-info-circle"></i></a>
                    <?php
                    if ($row_users['active'] == 1) {
                    ?>
                      <a href="#" data-toggle="modal" data-target="#activeModal<?= $row_users['idUser'] ?>"><i class="fas fa-ban"></i></a>
                    <?php
                    } else {
                    ?>
                      <a href="#" data-toggle="modal" data-target="#inactiveModal<?= $row_users['idUser'] ?>"><i class="fas fa-ban" style="color: #8DDCFA"></i></a>
                    <?php
                    }
                    ?>
                    <a href="#" data-toggle="modal" data-target="#deleteModal<?= $row_users['idUser'] ?>"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
            <?php
            //Modal de ativar e desativar
            include('components/active_modal.php');
            //Modal de ativar e desativar
            include('components/delete_modal.php');
              }
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  </div>
<?php
} else {
  include("components/404.php");
}
?>