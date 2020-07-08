<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  // Create a new DB connection
  $link = new_db_connection();
  /* create a prepared statement */
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idVacancies, vacancie_name, number_free_vanc, name_user, Workday_name
          FROM vacancies 
          INNER JOIN users on vacancies.User_publicou = users.idUser
          INNER JOIN workday on vacancies.Workday_idWorkday = workday.idWorkday
          ORDER BY User_publicou DESC";

  $array_val = mysqli_query($link, $query);

?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Vagas publicadas por empresas</h1>
  <p class="mb-4">Aqui é possível visualizar e gerir todas as vagas publicadas por empresas na aplicação até ao momento.</p>
  <?php
  if (isset($_SESSION["vac"])) {
    $msg_show = true;
    switch ($_SESSION["vac"]) {
      case 1:
        $message = "Vaga eliminada com sucesso!";
        $class = "alert-success";
        $_SESSION["vac"] = 0;
        break;
      case 2:
        $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
        $class = "alert-warning";
        $_SESSION["vac"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["vac"] = 0;
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
              <th>Empresa</th>
              <th>Vaga</th>
              <th>Jornada de trabalho</th>
              <th>Número de vagas disponíveis</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Empresa</th>
              <th>Vaga</th>
              <th>Jornada de trabalho</th>
              <th>Número de vagas disponíveis</th>
              <th>Ações</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $number_free_vanc, $name_user, $Workday_name);
              while ($row_vac = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_vac['name_user']; ?></td>
                  <td><?= $row_vac['vacancie_name']; ?></td>
                  <td><?= $row_vac['Workday_name']; ?></td>
                  <td><?= $row_vac['number_free_vanc']; ?></td>
                  <td>
                    <a href="info_vac.php?info=<?= $row_vac['idVacancies'] ?>">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#deletevac<?= $row_vac['idVacancies'] ?>">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
            <?php
                //Modal de eliminar a vaga
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