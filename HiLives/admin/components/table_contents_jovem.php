<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  // Create a new DB connection
  $link = new_db_connection();
  /* create a prepared statement */
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idContent, content_type, date_content, name_user, description, title_exp  FROM content 
  INNER JOIN experiences ON content.idContent = experiences.Content_idContent
  Inner JOIN users ON experiences.User_idUser = users.idUser
  ORDER BY date_content DESC";

  $array_val = mysqli_query($link, $query);

?>

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Vídeos publicados pelos jovens (experiências)</h1>
  <p class="mb-4">Aqui é possível visualizar e gerir todos os vídeos publicados pelos jovens na aplicação até ao momento.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Título da experiência</th>
              <th>Publicado por</th>
              <th>Data</th>
              <th>Tipo de conteúdo</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Título da experiência</th>
              <th>Publicado por</th>
              <th>Data</th>
              <th>Tipo de conteúdo</th>
              <th>Ação</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idContent, $content_type, $date_content, $name_user, $description, $title_exp);
              while ($row_vid = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_vid['title_exp']; ?></td>
                  <td><?= $row_vid['name_user']; ?></td>
                  <td><?=substr($row_vid['date_content'],0,10); ?></td>
                  <td><?= $row_vid['content_type']; ?></td>
                  <td>
                    <a href="info_vid_jovem.php?info=<?= $row_vid['idContent'] ?>">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#deletexp<?= $row_vid['idContent'] ?>">
                    <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
            <?php
            //Modal de eliminar a XP
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