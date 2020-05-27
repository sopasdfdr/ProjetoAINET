<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conta;
use App\Movimento;
use App\Http\Requests\ContaPost;
use App\Http\Requests\EmailPost;

class ContaController extends Controller
{
    public function index()
    {
        //$contas = Conta::where("user_id",auth()->user()->id)->select('id','user_id','nome','descricao','saldo_atual','data_ultimo_movimento')->paginate(7);
        $contas = auth()->user()->contas()->select('id','user_id','nome','descricao','saldo_atual','data_ultimo_movimento')->paginate(7);
        return view('user.contas')->withContas($contas);
    }

    public function create_conta()
    {
        $newConta = new Conta;
        return view('user.conta_inserir')->withConta($newConta);
    }

    public function update(ContaPost $request, Conta $conta)
    {
        $validated_data = $request->validated();
        $conta->nome = $validated_data['nome'];
        $conta->descricao = $validated_data['descricao'];
        $conta->saldo_atual = $validated_data['saldo_atual'];
        $conta->save();
        return redirect()->route('conta.dados',['conta' => $conta])
            ->with('alert-msg', 'Conta "' . $conta->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function store(ContaPost $request){
        $validated_data = $request->validated();
        $newConta = new Conta;
        $newConta->user_id = auth()->user()->id;
        $newConta->nome = $validated_data['nome'];
        $newConta->descricao = $validated_data['descricao'];
        $newConta->saldo_atual = $validated_data['saldo_atual'];
        $newConta->save();
        return redirect()->route('contas')
            ->with('alert-msg', 'Conta "' . $newConta->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Conta $conta)
    {
        $oldName = $conta->nome;
        try {
            $query = $conta->movimentos()->delete();
            $conta->delete();
            return redirect()->route('contas')
                ->with('alert-msg', 'Conta "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('contas')
                    ->with('alert-msg', 'Não foi possível apagar a Conta "' . $oldName . '", porque esta conta está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('contas')
                    ->with('alert-msg', 'Não foi possível apagar a Conta "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function atribuir(EmailPost $request, Conta $conta){
        $validated_data = $request->validated();
        $user = User::where('email', $validated_data["email"])->first();
        if($user){
            dd($user);
            $user->attach($conta->id, ['so_leitura', $validated_data["so_leitura"]]);
        }
        return redirect()->route('contas');
    }


}
