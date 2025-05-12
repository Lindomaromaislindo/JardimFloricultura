<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('cliente.list', ['dados' => $clientes]);
    }

    public function create()
    {
        return view('cliente.form');
    }

    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('cliente.form', ['dado' => $cliente]);
    }

    private function validateRequest(Request $request, $id = null)
    {
        $uniqueEmail = 'unique:clientes,email';
        if ($id) {
            $uniqueEmail .= ',' . $id;
        }

        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => ['required', 'email', $uniqueEmail],
            'telefone' => 'required|string|max:20',
        ], [
            'nome.required'     => 'O campo nome é obrigatório',
            'email.required'    => 'O campo email é obrigatório',
            'email.email'       => 'Informe um email válido',
            'email.unique'      => 'Esse email já está em uso',
            'telefone.required' => 'O telefone é obrigatório',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        Cliente::create($request->all());

        return redirect('clientes')->with('success', 'Cliente criado com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request, $id);

        Cliente::updateOrCreate(['id' => $id], $request->all());

        return redirect('clientes')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect('clientes')->with('success', 'Cliente removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $clientes = Cliente::where($request->tipo, 'like', "%{$request->valor}%")->get();
        } else {
            $clientes = Cliente::all();
        }

        return view('cliente.list', ['dados' => $clientes]);
    }
}
