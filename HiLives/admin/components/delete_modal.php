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
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="scripts/delete_user.php?apaga=<?= $row_users['idUser'] ?>">Apagar</a>
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
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="scripts/delete_user.php?apaga=<?=$idUser?>">Apagar</a>
      </div>
    </div>
  </div>
</div>
