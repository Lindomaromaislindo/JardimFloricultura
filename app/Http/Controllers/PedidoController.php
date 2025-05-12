<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Flor;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $dados = Pedido::with(['cliente', 'flor'])->get();
        return view('pedido.list', ['dados' => $dados]);
    }

    public function create()
    {
        $clientes = Cliente::all();
        $flores = Flor::all();
        return view('pedido.form', compact('clientes', 'flores'));
    }

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id); 
        $clientes = Cliente::all();
        $flores = Flor::all();
        return view('pedido.form', compact('pedido', 'clientes', 'flores')); 
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'cliente_id'       => 'required|exists:clientes,id',
            'flor_id'          => 'required|exists:flores,id',
            'forma_pagamento'  => 'required|string|max:255',
            'endereco_entrega' => 'required|string|max:255',
            'status'           => 'required|string|max:255',
        ], [
            'cliente_id.required'       => 'Selecione um cliente.',
            'flor_id.required'          => 'Selecione uma flor.',
            'forma_pagamento.required'  => 'Informe a forma de pagamento.',
            'endereco_entrega.required' => 'Informe o endereço de entrega.',
            'status.required'           => 'Informe o status do pedido.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        Pedido::create($request->all());

        return redirect('pedidos')
            ->with('success', 'Pedido criado com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());

        return redirect('pedidos')
            ->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $dado = Pedido::findOrFail($id);
        $dado->delete();

        return redirect('pedidos')
            ->with('success', 'Pedido removido com sucesso!');
    }

    public function search(Request $request)
    {
        $query = Pedido::with(['cliente', 'flor']);

        if (!empty($request->valor)) {
            if ($request->tipo === 'cliente') {
                $query->whereHas('cliente', function ($q) use ($request) {
                    $q->where('nome', 'like', '%' . $request->valor . '%');
                });
            } elseif ($request->tipo === 'flor') {
                $query->whereHas('flor', function ($q) use ($request) {
                    $q->where('nome', 'like', '%' . $request->valor . '%');
                });
            } else {
                $query->where($request->tipo, 'like', '%' . $request->valor . '%');
            }
        }

        $dados = $query->get();

        return view('pedido.list', ['dados' => $dados]);
    }
}
