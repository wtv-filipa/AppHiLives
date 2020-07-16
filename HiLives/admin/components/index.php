<?php
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type != 4";

$query2 = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type = 7";

$query3 = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type = 10";

$query4 = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type = 13";

if (isset($_SESSION["erro"])) {
    $msg_show = true;
    switch ($_SESSION["erro"]) {
        case 1:
            $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
            $class = "alert-warning";
            $_SESSION["erro"] = 0;
            break;
        case 2:
            $message = "Perfil editado com sucesso com sucesso!";
            $class = "alert-success";
            $_SESSION["cont_emp"] = 0;
            break;
        case 0:
            $msg_show = false;
            break;
        default:
            $msg_show = false;
            $_SESSION["erro"] = 0;
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
<div class="row">
    <?php
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
    ?>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Utilizadores
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    if (mysqli_stmt_prepare($stmt, $query2)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
        ?>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Empresas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    if (mysqli_stmt_prepare($stmt, $query3)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
        ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Jovens
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    if (mysqli_stmt_prepare($stmt, $query4)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
        ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Universidades
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    ?>
</div>