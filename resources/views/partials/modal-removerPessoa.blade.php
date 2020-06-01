<div class="modal fade" id="id_modalRemoverPessoa" tabindex="-1" role="dialog" aria-labelledby="modalMessageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalMessageLabel">Remover Acesso de Conta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action={{route('conta.revogar', ['conta' => $conta])}} method="POST" id="removerConta">
                @csrf
                @method('delete')
                <div class="form-group">
                    <label for="email">Email da pessoa a remover</label>
                    <select class="custom-select" name="userRevogar">
                        <option value="" selected>Selecione um mail para remover</option>
                        @foreach ($autorizados as $autorizado)
                            <option value="{{$autorizado->id}}">{{$autorizado->email}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" form="removerConta">Accept</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
</div>
