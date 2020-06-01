<?php

namespace App\Http\Controllers;

use App\Conta;
use App\Categoria;
use App\Movimento;
use Illuminate\Http\Request;
use App\Http\Requests\MovimentoPost;
use Illuminate\Support\Facades\Storage;

class MovementController extends Controller
{
    public function index(Request $request, Conta $conta)
    {
        $categorias = Categoria::orderBy('nome')->get();

        $data = $request->data ?? NULL;
        $cat = $request->cat ?? NULL;
        $tipo = $request->tipo ?? 3;

        $query = Movimento::select('id', 'data', 'valor', 'saldo_inicial', 'saldo_final', 'categoria_id', 'tipo')
                            ->where('conta_id', $conta->id);

        if($data != null)
            $query->where('data',$data);
        if($cat != null)
            $query->where('categoria_id', $cat);
        if($tipo != 3)
            $query->where('tipo',$tipo);


        $movimentos = $query->orderBy('data', 'desc')->orderBy('id', 'desc')->paginate(7);
        $users_autorizados = $conta->autorizacoes_contas;
       //dd('');
        return view('user.dados_conta')->withMovimentos($movimentos)->withConta($conta)->withData($data)->withCat($cat)
        ->withTipo($tipo)->withAutorizados($users_autorizados)->withCategorias($categorias);
    }

    public function create(Conta $conta)
    {
        $newMovement = new Movimento;
        $categorias = Categoria::orderBy('nome')->get();
        return view('user.movimento_inserir')->withMovimento($newMovement)->withConta($conta)->withCategorias($categorias);
    }

    public function edit(Movimento $movimento)
    {
        $conta = Conta::find($movimento->conta_id);
        $categorias = Categoria::orderBy('nome')->get();
        return view('user.movimento_edit')->withMovimento($movimento)->withConta($conta)->withCategorias($categorias);
    }

    public function update(Movimento $movimento, MovimentoPost $request)
    {
        $conta = Conta::find($movimento->conta_id);
        $validated_data = $request->validated();
        $movimento->data = $validated_data['data'];
        $movimento->descricao = $validated_data['descricao'];
        if($movimento->tipo != $validated_data['tipo'] && ($movimento->valor != $validated_data['valor'] || $movimento->valor == $validated_data['valor'])){
            if($validated_data['tipo'] == 'D')
            {
                $movimento->saldo_final -= $movimento->valor;
                $movimento->saldo_final -= $validated_data['valor'];
            }
            else
            {
                $movimento->saldo_final += $movimento->valor;
                $movimento->saldo_final += $validated_data['valor'];
            }
        }
        elseif($movimento->tipo == $validated_data['tipo'] && $movimento->valor != $validated_data['valor'])
        {
            if($validated_data['tipo'] == 'D' && $movimento->valor < $validated_data['valor'])
            {
                $movimento->saldo_final -= abs($movimento->valor-$validated_data['valor']);
            }
            elseif($validated_data['tipo'] == 'D' && $movimento->valor > $validated_data['valor'])
            {
                $movimento->saldo_final += abs($movimento->valor-$validated_data['valor']);
            }
            elseif($validated_data['tipo'] == 'R' && $movimento->valor < $validated_data['valor'])
            {
                $movimento->saldo_final += abs($movimento->valor-$validated_data['valor']);
            }
            else{
                $movimento->saldo_final -= abs($movimento->valor-$validated_data['valor']);
            }
        }

        $movements = $conta->movimentos()->where('id','>',$movimento->id)->orderBy('id', 'asc')->get();
        $saldo_anterior = $movimento->saldo_final;
        foreach ($movements as $movementToUpdate) {
            $movementToUpdate->saldo_inicial = $saldo_anterior;
            if ( $movementToUpdate->tipo == 'D')
            {
                $movementToUpdate->saldo_final = $movementToUpdate->saldo_inicial - $movementToUpdate->valor;
            }
            else
            {
                $movementToUpdate->saldo_final = $movementToUpdate->saldo_inicial + $movementToUpdate->valor;
            }
            $saldo_anterior = $movementToUpdate->saldo_final;
            $movementToUpdate->save();
        }

        $conta->saldo_atual = $saldo_anterior;
        $movimento->valor = $validated_data['valor'];
        $movimento->tipo = $validated_data['tipo'];

        if ($request->categoria != null)
            $movimento->categoria = $validated_data['categoria'];

        if ($request->hasFile('imagem_doc')){
            Storage::delete('docs/'.$movimento->imagem_doc);
            $path = $request->imagem_doc->store('docs');
            $movimento->imagem_doc = basename($path);
        }

        $conta->save();
        $movimento->save();
        return redirect()
            ->route('conta.dados', $conta)
            ->with('success', 'Movimento editado com sucesso');
    }

    public function store(MovimentoPost $request ,Conta $conta)
    {
        $validated_data = $request->validated();
        $movement = new Movimento;
        $movement['tipo'] = $validated_data['tipo'];
        $movement['data'] = $validated_data['data'];
        $movement['conta_id'] = $conta->id;
        $movement['valor'] = $validated_data['valor'];

        if ($request->categoria != null)
        {
            $movement['categoria_id'] = $validated_data['categoria'];
        }

        if ($request->has('descricao')){ //has nao da nos outros????
            $movement['descricao'] = $validated_data['descricao'];
        }

        $movement['saldo_inicial']= $conta->saldo_atual;

        if ($movement['tipo'] == 'D'){
            $movement['saldo_final'] = $movement['saldo_inicial'] - $movement['valor'];
            $conta->saldo_atual -= $movement['valor'];
        } elseif ($movement['tipo'] == 'R'){
            $movement['saldo_final'] = $movement['saldo_inicial'] + $movement['valor'];
            $conta->saldo_atual += $movement['valor'];
        }

        if ($request->hasFile('imagem_doc')){
            $path = $request->imagem_doc->store('docs');
            $movimento->imagem_doc = basename($path);
        }

        $conta->data_ultimo_movimento = $validated_data['data'];

        $movement->save();
        $conta->save();
        return redirect()
            ->route('conta.dados', $conta)
            ->with('success', 'Movimento criado com sucesso');
    }

    public function destroy(Movimento $movimento)
    {
        try {
            $conta = Conta::find($movimento->conta_id);
            $movements = $conta->movimentos()->where('id','>',$movimento->id)->orderBy('id', 'asc')->get();
            $saldo_anterior = $movimento->saldo_inicial;

            foreach ($movements as $movementToUpdate) {
                $movementToUpdate->saldo_inicial = $saldo_anterior;
                if ( $movementToUpdate->tipo == 'D')
                {
                    $movementToUpdate->saldo_final = $movementToUpdate->saldo_inicial - $movementToUpdate->valor;
                }
                else
                {
                    $movementToUpdate->saldo_final = $movementToUpdate->saldo_inicial + $movementToUpdate->valor;
                }
                $saldo_anterior = $movementToUpdate->saldo_final;
                $movementToUpdate->save();
            }

            if($movimento->imagem_doc != null)
                Storage::delete('docs/'.$movimento->imagem_doc);
            $movimento->forceDelete();
            return redirect()->route('conta.dados',['conta' => $conta])
                ->with('alert-msg', 'Movimento apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('conta.dados',['conta' => $conta])
                    ->with('alert-msg', 'Não foi possível apagar o movimento')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('conta.dados',['conta' => $conta])
                    ->with('alert-msg', 'Não foi possível apagar o movimento. Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function getFoto(Movimento $movimento)
    {
        return response()->file(storage_path().'/app/docs/'.$movimento->imagem_doc);
    }
}
