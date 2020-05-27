@csrf
<div class="form-group col-2">
    <label for="dataMovimento">*Data:</label>
    <input name="data" id="dataMovimento" type="date" max=<?php echo date('Y-m-d');?> class="form-control" placeholder="Data do Movimento" required value={{$dataMov}}>
    @error('data')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col">
    <label for="descMovimento">Descricao:</label>
    <textarea name="descricao" id="descMovimento" type="text" class="form-control" placeholder="Descrição Movimento" rows="3">{{$descricaoMov}}</textarea>
    @error('descricao')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col-2 ml-1">
    <label for="tipoMovimento">*Tipo:</label>
    <div class="input-group ml-2">
        <label><input name="tipo" type="radio" id="tipoMovimentoD" value='D' {{$tipoMov == 'D' ? 'checked' : ''}} required>Despesa<label>
    </div>
    <div class="input-group ml-2">
        <label><input name="tipo" type="radio" id="tipoMovimentoR" value='R' {{$tipoMov == 'R' ? 'checked' : ''}}>Receita<label>
    </div>
    @error('tipo')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col-2">
    <label for="categoriaMovimento">Categoria:</label>
    <div class="input-group">
        <select name="categoria" id="categoriaMovimento" class="form-control">
            <option value="">----</option>
            @foreach ($categorias as $categoria)
                <option class="{{$categoria->tipo}}" value="{{$categoria->id}}"
                    {{$categoriaMov == $categoria->id ? 'selected' : ''}}>{{$categoria->nome}} </option>

            @endforeach
        </select>
    </div>
    @error('categoria')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col-2">
    <label for="valorMovimento">*Valor:</label>
    <div class="input-group">
        <input name="valor" id="valorMovimento" type="number" required class="form-control" min="0.01" step="0.01" placeholder="Valor Movimento" value={{$valorMov}}>
        <div class="input-group-append">
            <div class="input-group-text">€</div>
        </div>
    </div>
    @error('valor')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
