<div class="events w-75 mx-auto">
    <?php
    if (isset($_SESSION["doneCU"])) {
        $msg_show = true;
        switch ($_SESSION["doneCU"]) {
            case 1:
                $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                $class = "alert-warning";
                $_SESSION["doneCU"] = 0;
                break;
            case 2:
                $message = "É necessário preencher todos os campos obrigatórios.";
                $class = "alert-warning";
                $_SESSION["doneCU"] = 0;
                break;
            case 0:
                $msg_show = false;
                break;
            default:
                $msg_show = false;
                $_SESSION["doneCU"] = 0;
        }

        if ($msg_show == true) {
            echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span title=\"Fechar\" aria-hidden=\"true\">&times;</span>
                </button>
                </div>";
            echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
        }
    }
    ?>
  
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Carregar nova Unidade Curricular feita</h3>
        </div>
        
        <form class="md-form inserir_dados" class="mb-3" action="scripts/insert_done_uc.php" enctype="multipart/form-data" method="post">

            <div class="form-group text-left">
                <label class="label-margin" for="nomeuc">Nome da Unidade Curricular: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                <input type="text" id="nomeuc" name="nomeuc" class="form-control" aria-required="required" required="required"><span class=sr-only>(Insere o nome da unidade curricular que complestaste)</span>
            </div>
            
            <div class="form-group text-left">
                <label class="label-margin" for="uniuc">Universidade onde foi feita: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                <input type="text" id="uniuc" name="uniuc" class="form-control" aria-required="required" required="required"><span class=sr-only>(Insere o nome da universidade onde complestaste a unidade curricular)</span>
            </div>
          
            <div class="form-group text-left">
                <label class="label-margin" for="data">Data de conclusão: <span style="color: #00A5CF; font-weight: bold; font-size: 20px">*</span></label>
                <input type="date" id="data" name="data" class="form-control" aria-required="required" required="required"><span class=sr-only>(Insere a data da conclusão da unidade curricular)</span>
            </div>
            <div>
                <button type="submit" class="btn btn-success publicar_btn">Publicar</button>
            </div>

        </form>
    </div>
</div>