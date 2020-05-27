@csrf
<div class="form-group col-5">
    <label for="nomeUser">Nome:</label>
    <input name="name" id="nomeUser" type="text" class="form-control" placeholder="Nome Utilizador" value='{{$userNome}}'>
    @error('name')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col-5">
    <label for="mailUser">Email:</label>
    <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
        </div>
        <input type="email" name="email" class="form-control" id="mailUser"  placeholder="Email conta" value={{$userEmail}}>
    </div>
    @error('email')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group col-2">
    <label for="nifUser">NIF:</label>
    <div class="input-group">
        <input name="NIF" id="nifUser" step="1" min="0" max="999999999" type="number" class="form-control" placeholder="Nif do utilizador" value={{$userNif}}>
    </div>
    @error('NIF')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col-2">
    <label for="telefoneUser">Telefone:</label>
    <div class="input-group">
        <input name="telefone" id="telefoneUser" type="number" step="1" min="0" max="999999999" class="form-control" placeholder="Telefone utilizador" value={{$userTelefone}}>
    </div>
    @error('telefone')
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group col-2">
    <label for="fotoUser">Foto:</label>
    <div class="input-group">
        <input name="foto" type="file" class="custom-file-input" accept="image/*" value="{{$userFoto}}">
    </div>
    @error('foto')
        <div class="text-danger">{{$message}}</div>
    @enderror
</div>
