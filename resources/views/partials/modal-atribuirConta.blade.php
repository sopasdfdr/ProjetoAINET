<div class="modal fade" id="id_modalAtribuirConta" tabindex="-1" role="dialog" aria-labelledby="modalMessageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalMessageLabel">Atribuir Acesso de Conta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action={{route('conta.atribuir', ['conta' => $conta->id])}} method="POST" id="atribuirConta">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>
                  <div class="form-check">
                    <input name="so_leitura" type="checkbox" class="form-check-input" id="so_leitura">
                    <label class="form-check-label" for="so_leitura">So leitura</label>
                  </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" form="atribuirConta">Accept</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
</div>
