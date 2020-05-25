@csrf
<div class="form-group col">
    <label for="nomeConta">*Nome:</label>
    <input name="nome" id="nome" type="text" class="form-control" placeholder="Nome da Conta" value='{{$contaNome}}'>
    @error('nome')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col">
    <label for="descConta">Descrição:</label>
    <textarea  name="descricao" id="descricao" type="text" class="form-control" placeholder="Descrição Conta" rows="3">{{$contaDescricao}}</textarea>
    @error('descricao')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col-2">
    <label for="saldoConta">*Saldo:</label>
    <div class="input-group">
        <input name="saldo_atual" id="saldo" type="number" step="0.01" class="form-control" placeholder="Saldo Conta" value={{$contaSaldoAtual}}>
        <div class="input-group-append">
            <div class="input-group-text">€</div>
        </div>
    </div>
    @error('saldo_atual')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
