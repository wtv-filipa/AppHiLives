<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  // Create a new DB connection
  $link = new_db_connection();
  /* create a prepared statement */
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idDone_CU, CU_name, University_name, date_CU, name_user
          FROM done_cu 
          INNER JOIN users on done_cu.User_idUser = users.idUser
          ORDER BY User_idUser DESC";

  $array_val = mysqli_query($link, $query);

?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Unidades Curriculares adicionadas por jovens</h1>
  <p class="mb-4">Aqui é possível visualizar e gerir todas as UC's adicionadas pelos jovens na aplicação até ao momento.</p>
  <?php
  if (isset($_SESSION["uc"])) {
    $msg_show = true;
    switch ($_SESSION["uc"]) {
      case 1:
        $message = "Unidade Curricular eliminada com sucesso!";
        $class = "alert-success";
        $_SESSION["uc"] = 0;
        break;
      case 2:
        $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
        $class = "alert-warning";
        $_SESSION["uc"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["uc"] = 0;
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
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nome da UC</th>
              <th>Universidade</th>
              <th>Terminada em</th>
              <th>Adicionada por</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nome da UC</th>
              <th>Universidade</th>
              <th>Terminada em</th>
              <th>Adicionada por</th>
              <th>Ações</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idDone_CU, $CU_name, $University_name, $date_CU, $name_user);
              while ($row_uc = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_uc['CU_name']; ?></td>
                  <td><?= $row_uc['University_name']; ?></td>
                  <td><?= $row_uc['date_CU']; ?></td>
                  <td><?= $row_uc['name_user']; ?></td>
                  <td>
                  <a href="#" data-toggle="modal" data-target="#deleteUC<?= $row_uc['idDone_CU'] ?>">
                    <i class="fas fa-trash"></i>
                  </a>
                  </td>
                </tr>
            <?php
                //Modal de eliminar a UC
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