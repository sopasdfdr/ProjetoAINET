@extends('layout_admin')
@section('title', 'Editar Movimento')

@section('content')

<form action={{route('movement.update', ['movimento' => $movimento])}} method="POST" enctype="multipart/form-data">
    @method('PUT')
    <input type="hidden" name="id" value={{$movimento->id}}>
    @include('user.partials.movimento_dados',['dataMov' => $movimento->data, 'descricaoMov' => $movimento->descricao, 'tipoMov' => $movimento->tipo,
        'categoriaMov' => $movimento->categoriaMov, 'valorMov' => $movimento->valor])
    @if($movimento->imagem_doc != null)
        <div><img src="{{route('movement.image', ['movimento' => $movimento])}}" style="max-width: 550px" alt="Imagem do Movimento"></div>
    @endif
    <a class="btn btn-secondary mt-4" href="{{route('conta.dados', ['conta' => $conta]) }}">Cancelar</a>
    <button type="submit" class="btn btn-primary mr-2 mt-4" id="btn-accept">Guardar</button>
</form>

@endsection
