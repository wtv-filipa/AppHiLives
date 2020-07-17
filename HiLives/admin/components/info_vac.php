<?php
if (isset($_GET["info"])) {
    $idVacancies = $_GET["info"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idVacancies, vacancie_name, description_vac, number_free_vanc, requirements, date_vacancies, name_region, name_user, Content_idContent, Workday_name, name_education, name_interested_area FROM vacancies INNER JOIN region on vacancies.Region_idRegion = region.idRegion INNER JOIN users on vacancies.User_publicou = users.idUser INNER JOIN workday on vacancies.Workday_idWorkday = workday.idWorkday INNER JOIN educ_lvl on vacancies.Educ_lvl_idEduc_lvl = educ_lvl.idEduc_lvl INNER JOIN areas on vacancies.Areas_idAreas = areas.idAreas WHERE idVacancies = ?";

    $query2 = "SELECT content_name FROM content INNER JOIN vacancies ON content.idContent = vacancies.Content_idContent WHERE idVacancies = ?";

    $query3 = "SELECT capacity_comp, vacancies_idVacancies FROM capacities INNER JOIN vacancies_has_capacities ON capacities.idcapacities= vacancies_has_capacities.capacities_idcapacities WHERE vacancies_idVacancies = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $description_vac, $number_free_vanc, $requirements, $date_vacancies, $name_region, $name_user, $Content_idContent, $Workday_name, $name_education, $name_interested_area);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Informações da vaga <?= $vacancie_name ?></h1>
            <p class="mb-4">Aqui é possível visualizar outras informações acerca da vaga selcionada anteriormente.</p>
            <div class="card text-center">
                <div class="col-12">

                    <?php
                    if (mysqli_stmt_prepare($stmt, $query2)) {

                        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $content_name);
                        while (mysqli_stmt_fetch($stmt)) {
                    ?>
                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 mt-5">
                                <video class="embed-responsive-item" src="../admin/uploads/vid_vac/<?= $content_name ?>" controls="controls"></video>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="text-left">
                        <h5 for="nome">Cargo da vaga: <span style="font-size: 16px;"><?= $vacancie_name ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Descrição: <span style="font-size: 16px;"><?= $description_vac ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Número de vagas disponíveis: <span style="font-size: 16px;"><?= $number_free_vanc ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Requisitos: <span style="font-size: 16px;"><?= $requirements ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Data de publicação: <span style="font-size: 16px;"><?= $date_vacancies ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Região: <span style="font-size: 16px;"><?= $name_region ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Jornada de trabalho: <span style="font-size: 16px;"><?= $Workday_name ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Nível de estudos: <span style="font-size: 16px;"><?= $name_education ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Área(s) da vaga: <span style="font-size: 16px;">

                                <?php
                                if (!$primeiro) {
                                    echo ",";
                                }
                                $primeiro = false;
                                echo " $name_interested_area";
                                ?>
                            </span></h5>
                    </div>
                    <hr>

                    <div class='text-left'>
                        <h5 for='nome'>Capacidades necessárias: </h5>
                        <?php
                        if (mysqli_stmt_prepare($stmt, $query3)) {

                            mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $capacity_comp, $vacancies_idVacancies);
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<ul>
                            <li  style='font-size: 16px; font-family: 'Quicksand', 'Montserrat', sans-serif !important; list-style-type:circle;'>$capacity_comp</li>
                            </ul>";
                            }
                        }
                        ?>
                    </div>
                    <hr>

                    <div class="form-group mt-5">
                        <a class="col-xs-12 col-md-12" href="#" data-toggle="modal" data-target="#deletevac<?= $idVacancies ?>"> <button class="btn cancel_btn"><i class="fas fa-trash"></i> Apagar vaga</button></a>
                        <span></span>
                    </div>

                </div>
            </div>

<?php
            include('components/delete_modal.php');
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
}
?>