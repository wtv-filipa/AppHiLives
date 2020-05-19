<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["data_nasc"]) && isset($_POST["def"]) && isset($_POST["password"])) {

    $type = 10;

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, info_young, work_xp, password, User_type_idUser_type, Educ_lvl_idEduc_lvl) VALUES (?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssii', $name, $email, $contact_user, $birth_date, $info_young, $work_xp, $password_hash, $User_type_idUser_type, $Educ_lvl_idEduc_lvl);

        $name = $_POST['nome'];
        $email = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_nasc'];
        $info_young = $_POST['def'];
        $work_xp = $_POST["work"];
        $Educ_lvl_idEduc_lvl = $_POST["esc"];
        $User_type_idUser_type = $type;
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);
            echo "ID depois de inserir o user: " . "$last_id";
            //mysqli_stmt_close($stmt);
            //mysqli_close($link);
            // SUCCESS ACTION
            //echo "ESTÁ NA BD <br>";
        }
        //JÁ INSERIU OS USERS
        //AGORA VAI INSERIR REGIÕES
        if (isset($_POST["regiao"])) {
            $query2 = "INSERT INTO user_has_region (User_idUser, Region_idRegion)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query2)) {
                echo "id do user nas regiões: $last_id <br>";

                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idRegion);

                echo "id da região: $idRegion<br>";
                // PARA TODOS OS JOGADORES QUE FORAM ESCOLHIDOS
                foreach ($_POST["regiao"] as $idRegion) {
                    echo "id da região: $idRegion<br>";
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
            }
        } else {
            echo "nada inserido no fb";
        }
        //JÁ INSERIU AS REGIÕES
        //INSERIR AS ÁREAS
        if (isset($_POST["area"])) {
            $query3 = "INSERT INTO user_has_areas (User_idUser, Areas_idAreas)
            VALUES (?, ?)";
            if (mysqli_stmt_prepare($stmt, $query3)) {
                echo "id do user nas areas: $last_id <br>";

                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idAreas);
                echo "id das áreas: $idAreas<br>";
                // PARA TODAS AS ÁREAS QUE FORAM ESCOLHIDAS
                foreach ($_POST["area"] as $idAreas) {
                    echo "id das áreas: $idAreas<br>";
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                }
            }
        } else {
            echo "não inseriu àreas";
        }
        //JÁ INSERIU AS ÁREAS
        //TESTE DE PERSONALIDADE
        if (isset($_POST["pergunta1"]) && isset($_POST["pergunta2"]) && isset($_POST["pergunta3"]) && isset($_POST["pergunta4"])) {
            $link2 = new_db_connection();
            $stmt2 = mysqli_stmt_init($link2);
            echo "<h1>Teste de personalidade:</h1>";
            echo "id do user no teste de personalidade: $last_id <br>";

            /*Variáveis que recebem as respostas por POST. O que está a ser passado é o NAME do SELECT do HTML*/
            $answer1 = $_POST['pergunta1'];
            $answer2 = $_POST['pergunta2'];
            $answer3 = $_POST['pergunta3'];
            $answer4 = $_POST['pergunta4'];
            /*Array que guarda todas as respostas e o seu valor aka se é comunicativo, organizado ou qualquer outro*/
            $arrayRespostas = array(
                1 => $answer1,
                2 => $answer2,
                3 => $answer3,
                4 => $answer4
            );

            /*Deteta as vezes que uma resposta foi selecionada*/
            $respostas_iguais = array_count_values($arrayRespostas);
            //var_dump($respostas_iguais);
            /*Query que vai selecionar o nome da personalidade e o seu id consoante o que vier no array*/
            $query3 = "SELECT idPersonality, name_perso FROM personality WHERE name_perso IN (";
            $first = true;
            foreach ($respostas_iguais as $key => $value) {
                echo "$key <br>";
                if (!$first) {
                    $query3 .= ", ";
                }
                $query3 .= "'" . $key . "'";
                $first = false;
            }
            $query3 .= ")";

            echo "$query3 <br>";
            //Ao fazer o prepare da query 3, quando for fazer o insert vai fazer o insert o número de vezes que retornarem valores da query3
            if (mysqli_stmt_prepare($stmt, $query3)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idPersonality, $name_perso);
                while (mysqli_stmt_fetch($stmt)) {
                    echo "$name_perso <br>"; //verificar que nome da personalidade está a retornar
                    //Query para inserir os dados na tabela de relação com a personalidade
                    $query7 = "INSERT INTO user_has_personality (User_idUser, Personality_idPersonality) VALUES (?, ?)";
                    //Faz o prepare da query7 que é a que vai inserir os dados
                    if (mysqli_stmt_prepare($stmt2, $query7)) {
                        mysqli_stmt_bind_param($stmt2, 'ii', $last_id, $idPersonality);

                        // VALIDAÇÃO DO RESULTADO DO EXECUTE
                        if (!mysqli_stmt_execute($stmt2)) {
                            echo "Error: " . mysqli_stmt_error($stmt2);
                        } else {
                            echo "personalidade inserida <br>";
                            // SUCCESS ACTION
                            //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");
                        }
                    } else {
                        // ERROR ACTION
                        //header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
                        //mysqli_close($link);
                    }
                }
            }
        } else {
            echo "não respondeu Às perguntas";
        }
        //FIM DA INSERÇÃO DA PERSONALIDADE
        //INSERIR O MATCH
        include "match_uni.php";
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }
}
