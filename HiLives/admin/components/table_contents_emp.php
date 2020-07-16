<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);

  $query = "SELECT idContent, content_type, date_content, name_user, vacancie_name FROM content 
  INNER JOIN vacancies ON content.idContent = vacancies.Content_idContent
  Inner JOIN users ON vacancies.User_publicou = users.idUser
  ORDER BY date_content DESC";

  $array_val = mysqli_query($link, $query);

?>

  <h1 class="h3 mb-2 text-gray-800">Vídeos publicados pelas empresas</h1>
  <p class="mb-4">Aqui é possível visualizar e gerir todos os vídeos publicados pelas empresas, juntamente com as suas vagas, até ao momento.</p>
  <?php
  if (isset($_SESSION["cont_emp"])) {
    $msg_show = true;
    switch ($_SESSION["cont_emp"]) {
      case 1:
        $message = "Vídeo eliminado com sucesso!";
        $class = "alert-success";
        $_SESSION["cont_emp"] = 0;
        break;
      case 2:
        $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
        $class = "alert-warning";
        $_SESSION["cont_emp"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["cont_emp"] = 0;
    }

    if ($msg_show == true) {
      echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
      echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
    }
  }
  ?>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Vaga associada</th>
              <th>Publicado por</th>
              <th>Data</th>
              <th>Tipo de conteúdo</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Vaga associada</th>
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
              mysqli_stmt_bind_result($stmt, $idContent, $content_type, $date_content, $name_user, $vacancie_name);
              while ($row_cont = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_cont['vacancie_name']; ?></td>
                  <td><?= $row_cont['name_user']; ?></td>
                  <td><?= substr($row_cont['date_content'], 0, 10); ?></td>
                  <td><?= $row_cont['content_type']; ?></td>
                  <td>
                    <a href="info_vid_emp.php?info=<?= $row_cont['idContent'] ?>">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#delete_emp<?= $row_cont['idContent'] ?>">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
            <?php
                include('components/delete_modal.php');
              }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
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