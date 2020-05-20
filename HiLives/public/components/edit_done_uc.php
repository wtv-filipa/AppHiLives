<?php

if ($_SESSION["idUser"] && isset($_GET["uc"])) {
    $idUser = $_SESSION["idUser"];
    $iduc = $_GET["uc"];

// We need the function!
    require_once("connections/connection.php");

// Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

//ir buscar os dados
    $query = "SELECT Cu_name, University_name, date_CU
    FROM done_cu 
    WHERE User_idUser LIKE ? AND idDone_CU LIKE ?";

   if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $iduc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$Cu_name, $University_name, $date_CU);

       if (mysqli_stmt_fetch($stmt)) {
            ?>
           <div class="events w-75 mx-auto">

               <!--Card-->
               <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

                   <!--título-->
                   <div class=" no-gutters">
                       <h3 class="mx-auto letter">
                           Editar a unidade curricular </h3>
                       <h3 class="mx-auto letter2"><?= $Cu_name?></h3>
                   </div>
                   <!----------->
                   <form class="md-form inserir_dados" class="mb-3" action="scripts/update_done_uc.php?uc=<?=$iduc?>"
                         enctype="multipart/form-data" method="post">
                       <!--primeiro campo-->
                       <div class="form-group text-left">
                           <label class="label-margin" for="nomeuc">Nome da Unidade Curricular:</label>
                           <input type="text" id="nomeuc" name="nomeuc" class="form-control" value="<?= $Cu_name ?>">
                       </div>
                       <!-------------------------------------------->
                       <!--segundo campo-->
                       <div class="form-group text-left">
                           <label class="label-margin" for="uniuc">Universidade onde foi feita:</label>
                           <input type="text" id="uniuc" name="uniuc" class="form-control" value="<?= $University_name ?>">
                       </div>
                       <!-------------------------------------------->
                       <!--terceiro campo-->
                       <div class="form-group text-left">
                           <label class="label-margin" for="data">Data de conclusão:</label>
                           <input type="date" id="data" name="data" class="form-control" value="<?= $date_CU ?>">
                       </div>
                       <!-------------------------------------------->
                       <div>
                           <button type="submit" class="btn btn-success publicar_btn col-6" style="color: #2F2F2F">Guardar alterações</button>
                           <a href="profile.php?user=<?=$idUser?>" class="btn btn-success publicar_btn col-6">Voltar</a>
                       </div>

                   </form>
               </div>
           </div>
            <?php
        }


    }
}

?>