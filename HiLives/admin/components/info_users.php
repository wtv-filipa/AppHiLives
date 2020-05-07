<?php
if (isset($_GET["info"])) {
    $idUser = $_GET["info"];
    // We need the function!
    require_once("connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    //create a prepared statement
    $stmt = mysqli_stmt_init($link);
    //ir buscar os dados
    $query = "SELECT idUser, name_user, email_user, contact_user, birth_date, disability_name, work_xp, profile_img, Educ_lvl_idEduc_lvl, Study_work_idStudy_work
     FROM users
     WHERE idUser LIKE ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $disability_name, $work_xp, $profile_img, $Educ_lvl_idEduc_lvl, $Study_work_idStudy_work);
        while (mysqli_stmt_fetch($stmt)) {
            $dob = $birth_date;
            $age = (date('Y') - date('Y', strtotime($dob)));
?>
            <h1 class="h3 mb-2">Informações do utilizador</h1>
            <p class="mb-4">Aqui é possível visualizar outras informações acerca do utilizador selecionado previamente.</p>
            <div class="card text-center">
                <!-- edit form column -->
                <form class="mt-3 form-horizontal row" role="form">

                    <!-- left column -->
                    <div class="col-md-4">
                        <div class="text-center">
                            <?php
                            if (isset($profile_img)) {
                            ?>
                                <img class="image_profile" src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="<?= $profile_img ?>" />
                            <?php
                            } else {
                            ?>
                                <img class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" />
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <!--primeiro input-NOME-->
                        <div class="text-left">
                            <h5 for="nome">Nome: <span style="font-size: 16px;"><?= $name_user ?></span></h5>
                        </div>
                        <hr>
                        <!----------------------->
                        <!--segundo input-EMAIL-->
                        <div class="text-left">
                            <h5 for="nome">Email: <span style="font-size: 16px;"><?= $email_user ?></span></h5>
                        </div>
                        <hr>

                        <!----------------------->
                        <!--terceiro input-DATA DE NASCIMENTO-->
                        <div class="text-left">
                            <h5 for="nome">Idade: <span style="font-size: 16px;"><?= $age ?> anos</span></h5>
                        </div>
                        <hr>
                        <!----------------------->
                        <!--quarto input- TELEMÓVEL-->
                        <div class="text-left">
                            <h5 for="nome">Contacto telefónico: <span style="font-size: 16px;"><?= $contact_user ?></span></h5>
                        </div>
                        <hr>
                        <!----------------------->

                        <!--quinto input-DID-->
                        <div class="text-left">
                            <h5 for="nome">Detalhes sobre a DID: <span style="font-size: 16px;"><?= $disability_name ?></span></h5>
                        </div>
                        <hr>
                        <!----------------------->
                        <!--sexto input- ESCOLARIDADE-->
                        <?php
                        $query3 = "SELECT name_education FROM educ_lvl INNER JOIN users ON educ_lvl.idEduc_lvl=users.Educ_lvl_idEduc_lvl WHERE idUser=?";

                        if (mysqli_stmt_prepare($stmt, $query3)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $name_education);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo " <div class='text-left'>
                                           <h5 for='nome'>Escolaridade: <span style='font-size: 16px;'>$name_education</span></h5>
                                       </div>
                                       <hr>";
                                }
                            } else {
                                echo "Error: " . mysqli_stmt_error($stmt);
                            }

                            /* close statement */
                            //mysqli_stmt_close($stmt);
                        } else {
                            echo "Error: " . mysqli_error($link);
                        }
                        ?>

                        <!----------------------->
                        <!--sétimo input-ESTUDO OU TRABALHO-->
                        <?php
                        $query2 = "SELECT name_type FROM study_work INNER JOIN users ON study_work.idStudy_work=users.Study_work_idStudy_work WHERE idUser=?";

                        if (mysqli_stmt_prepare($stmt, $query2)) {

                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $name_type);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo " <div class='text-left'>
                                                <h5 for='nome'>O que procura: <span style='font-size: 16px;'>$name_type</span></h5>
                                            </div>
                                            <hr>";
                                }
                            } else {
                                echo "Error: " . mysqli_stmt_error($stmt);
                            }

                            /* close statement */
                            //mysqli_stmt_close($stmt);
                        } else {
                            echo "Error: " . mysqli_error($link);
                        }
                        ?>

                        <!----------------------->
                        <!--oitavo input-AREAS-->
                        <div class='text-left'>
                            <h5 for='nome'>Áreas de interesse:
                                <?php
                                $query2 = "SELECT name_interested_area FROM areas INNER JOIN user_has_areas ON  areas.idAreas= user_has_areas.Areas_idAreas INNER JOIN users ON user_has_areas.User_idUser=users.idUser WHERE idUser=?";

                                if (mysqli_stmt_prepare($stmt, $query2)) {
                                    // Bind variables by type to each parameter
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    /* execute the prepared statement */
                                    if (mysqli_stmt_execute($stmt)) {
                                        /* bind result variables */
                                        mysqli_stmt_bind_result($stmt, $name_interested_area);

                                        /* fetch values */
                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<span style='font-size: 16px;'>$name_interested_area, </span>";
                                        }
                                    } else {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                    /* close statement */
                                    //mysqli_stmt_close($stmt);
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                                ?>
                            </h5>
                        </div>
                        <hr>
                        <!----------------------->
                        <!--nono input-REGIÃO PT-->
                        <div class='text-left'>
                            <h5 for='nome'>Regiões de interesse:
                                <?php

                                $query3 = "SELECT name_region FROM region INNER JOIN user_has_region ON region.idRegion= user_has_region.Region_idRegion INNER JOIN users ON user_has_region.User_idUser=users.idUser WHERE idUser=?";

                                if (mysqli_stmt_prepare($stmt, $query3)) {
                                    // Bind variables by type to each parameter
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    /* execute the prepared statement */
                                    if (mysqli_stmt_execute($stmt)) {
                                        /* bind result variables */
                                        mysqli_stmt_bind_result($stmt, $name_region);

                                        /* fetch values */
                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<span style='font-size: 16px;'>$name_region, </span>";
                                        }
                                    } else {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                    /* close statement */
                                    //mysqli_stmt_close($stmt);
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                                ?>
                            </h5>
                        <hr>
                        <!------------EXPERIÊNCIA DE TRABALHO------------>
                        <div class="text-left">
                            <h5 for="nome">Experiência de trabalho: <span style="font-size: 16px;"><?= $work_xp ?></span></h5>
                        </div>
                        <hr>
                        <!----------------------->
                    </div>
                </form>
            </div>

<?php
        }
    }
} else {
    include("404.php");
} //fim do else se não existir o GET
?>