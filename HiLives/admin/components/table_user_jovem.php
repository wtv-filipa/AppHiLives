<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  // Create a new DB connection
  $link = new_db_connection();
  /* create a prepared statement */
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, disability_name, work_xp, profile_img
          FROM users 
          INNER JOIN user_type on users.User_type_idUser_type= user_type.idUser_type
          WHERE type_user='Jovem'
          ORDER BY idUser DESC";

?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2">Jovens</h1>
  <p class="mb-4">Aqui é possível visualizar e gerir todos os jovens inscritos na aplicação até ao momento.</p>

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
              <th>Idade</th>
              <th>Detalhes da DID</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Contacto telefónico</th>
              <th>Idade</th>
              <th>Detalhes da DID</th>
              <th>Ações</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $id_user_lista, $name_user, $email_user, $contact_user, $birth_date, $disability_name, $work_xp, $profile_img);
              while (mysqli_stmt_fetch($stmt)) {
                $dob = $birth_date;
                $age = (date('Y') - date('Y', strtotime($dob)));
            ?>
                <tr>
                  <td><?= $name_user ?></td>
                  <td><?= $email_user ?></td>
                  <td><?= $contact_user ?></td>
                  <td><?= $age ?></td>
                  <td><?= $disability_name ?></td>
                  <td>
                    <a href="info_users.php?info=<?=$id_user_lista?>"><i class="fas fa-info-circle"></i></a>
                    <i class="fas fa-lock"></i>
                  </td>
                </tr>
            <?php
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