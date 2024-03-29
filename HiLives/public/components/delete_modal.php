<!--Modal para eliminar o user na página das DEFINIÇÕES-->
<div class="modal fade" id="deleteModal<?= $id_navegar ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tens a certeza que queres apagar a tua conta no HiLives?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span title="Fechar" aria-hidden="true" title="Fechar">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Quando apagada a tua conta não pode voltar a ser reposta. Carrega em "Apagar" para confirmar.
      </div>
      <div class="modal-footer">
        <button type="button" title="Cancelar" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" title="Apagar conta" href="scripts/delete_user.php?apaga=<?=$id_navegar?>">Apagar</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para eliminar UC-->
<div class="modal fade modal_problem" id="deleteuc<?= $idDone_CU ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Tens a certeza que queres apagar a unidade curricular <?= $Cu_name ?>?</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span title="Fechar" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"style="font-size: 16px !important;">Quando apagares, não podes voltar atrás. Carrega em "Apagar" para confirmar.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_uc.php?apaga=<?= $idDone_CU ?>">Apagar</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para eliminar VAGA-->
<div class="modal fade modal_problem" id="deletevac<?= $idVacancies ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Tem a certeza que quer apagar a vaga <?= $vacancie_name ?>?</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span title="Fechar" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="font-size: 16px !important;">Quando apagar, não poderá voltar atrás. Carrega em "Apagar" para confirmar.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn_apagar" href="scripts/delete_vac.php?apaga=<?= $idVacancies ?>">Apagar</a>
            </div>
        </div>
    </div>
</div>
<!--Modal para eliminar VIDEO JOVEM-->
<div class="modal fade modal_problem" id="deleteuc<?= $idExperiences ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Tem a certeza que quer apagar a vaga <?= $vacancie_name ?>?</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span title="Fechar" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"style="font-size: 16px !important;">Quando apagar, não poderá voltar atrás. Carrega em "Apagar" para confirmar.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn_apagar" href="scripts/delete_vac.php?apaga=<?= $idExperiences ?>&user=<?= $idUser?>">Apagar</a>
            </div>
        </div>
    </div>
</div>