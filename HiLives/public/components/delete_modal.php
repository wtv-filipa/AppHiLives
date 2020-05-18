<!--Modal para eliminar o user na página das DEFINIÇÕES-->

<div class="modal fade" id="deleteModal<?= $id_navegar ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tens a certeza que queres apagar a tua conta no HiLives?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Quando apagada a tua conta não pode voltar a ser reposta. Carrega em "Apagar" para confirmar.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="scripts/delete_user.php?apaga=<?=$id_navegar?>">Apagar</a>
      </div>
    </div>
  </div>
</div>