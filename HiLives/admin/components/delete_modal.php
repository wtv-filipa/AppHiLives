<!--Modal para eliminar o user nas tabelas-->
<div class="modal fade" id="deleteModal<?= $row_users['idUser'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar este utilizador?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Quando apagado o utilizador não pode voltar a ser reposto. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_user.php?apaga=<?= $row_users['idUser'] ?>">Apagar</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para apagar o user na página das informções-->
<div class="modal fade" id="deleteModal<?= $idUser ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar este utilizador?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Quando apagado o utilizador não pode voltar a ser reposto. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_user.php?apaga=<?=$idUser?>">Apagar</a>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------->

<!--Modal para apagar a vaga na página das informções-->
<div class="modal fade" id="deletevac<?= $idVacancies ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar esta vaga?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Quando apagada a vaga não pode voltar a ser reposta. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_vac.php?apaga=<?=$idVacancies?>">Apagar</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para eliminar a vaga nas tabelas-->
<div class="modal fade" id="deletevac<?= $row_vac['idVacancies'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar esta vaga?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">  Quando apagada a vaga não pode voltar a ser reposta. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_vac.php?apaga=<?= $row_vac['idVacancies'] ?>">Apagar</a>
      </div>
    </div>
  </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------------------->

<!--Modal para apagar a experiência na página das informções-->
<div class="modal fade" id="deletexp<?= $idContent ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar esta experiência?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Quando apagada a experiência não pode voltar a ser reposta. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_xp.php?apaga=<?=$idContent?>">Apagar</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para eliminar a experiência nas tabelas-->
<div class="modal fade" id="deletexp<?= $row_vid['idContent'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar esta experiência?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">  Quando apagada a experiência não pode voltar a ser reposta. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_xp.php?apaga=<?= $row_vid['idContent'] ?>">Apagar</a>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------->

<!--Modal para apagar o vídeo da empresa na página das informções-->
<div class="modal fade" id="delete_emp<?= $idContent ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar esta vaga?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Quando apagada a vaga não pode voltar a ser reposta. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_vid_emp.php?apaga=<?=$idContent?>">Apagar</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para eliminar o video da empresa nas tabelas-->
<div class="modal fade" id="delete_emp<?= $row_cont['idContent'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar esta vaga?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Quando apagada a vaga não pode voltar a ser reposta. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_vid_emp.php?apaga=<?=$row_cont['idContent']?>">Apagar</a>
      </div>
    </div>
  </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------------------->

<!--Modal para eliminar a UC nas tabelas-->

<div class="modal fade" id="deleteUC<?= $row_uc['idDone_CU'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer apagar esta Unidade Curricular?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Quando apagado a UC não pode voltar a ser reposta. Carregue em "Apagar" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_uc.php?apaga=<?= $row_uc['idDone_CU'] ?>">Apagar</a>
      </div>
    </div>
  </div>
</div>