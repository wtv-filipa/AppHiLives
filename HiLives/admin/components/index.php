<?php
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

/*CONTA TODOS*/
$query = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type != 4";

/*CONTA EMPRESAS*/
$query2 = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type = 7";

/*CONTA JOVENS*/
$query3 = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type = 10";

/*CONTA UNIVERSIDADES*/
$query4 = "SELECT COUNT(idUser)
          FROM users 
          WHERE User_type_idUser_type = 13";
?>
<div class="row">
<?php
//Todos os utilizadores(menos admin)        
if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idUser);

    while (mysqli_stmt_fetch($stmt)) {
        ?>

        <!-- Earnings (Monthly) Card Example -->
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
//Todos os users que são empresas        
if (mysqli_stmt_prepare($stmt, $query2)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idUser);

    while (mysqli_stmt_fetch($stmt)) {
        ?>

        <!-- Earnings (Monthly) Card Example -->
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
//Todos os users que são jovens     
if (mysqli_stmt_prepare($stmt, $query3)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idUser);

    while (mysqli_stmt_fetch($stmt)) {
        ?>

        <!-- Earnings (Monthly) Card Example -->
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
//Todos os users que são universidades     
if (mysqli_stmt_prepare($stmt, $query4)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idUser);

    while (mysqli_stmt_fetch($stmt)) {
        ?>

        <!-- Earnings (Monthly) Card Example -->
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
?>
</div>