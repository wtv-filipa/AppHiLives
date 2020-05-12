<!--Modal para desativar o user nas tabelas-->
<div class="modal fade" id="activeModal<?= $row_users['idUser'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer bloquear este utilizador?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Pode desbloquear o utilizador a qualquer momento a partir do mesmo local onde o bloqueou. Carregue em "Bloquear" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?= $row_users['idUser'] ?>&a=<?= $row_users['active'] ?>">Bloquear</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para ativar o user nas tabelas-->
<div class="modal fade" id="inactiveModal<?= $row_users['idUser'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer desbloquear este utilizador?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Pode bloquear o utilizador a qualquer momento a partir do mesmo local onde o desbloqueou. Carregue em "Desbloquear" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?= $row_users['idUser'] ?>&a=<?= $row_users['active'] ?>">Desbloquear</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para desativar o user na página de informações-->
<div class="modal fade" id="activeModal<?=$idUser?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer bloquear este utilizador?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Pode desbloquear o utilizador a qualquer momento a partir do mesmo local onde o bloqueou. Carregue em "Bloquear" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?= $idUser?>&a=<?=$active?>">Bloquear</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para ativar o user na página de informações-->
<div class="modal fade" id="inactiveModal<?=$idUser?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que quer desbloquear este utilizador?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Pode bloquear o utilizador a qualquer momento a partir do mesmo local onde o desbloqueou. Carregue em "Desbloquear" para confirmar.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?=$idUser?>&a=<?=$active?>">Desbloquear</a>
      </div>
    </div>
  </div>
</div>
<!---------------------->