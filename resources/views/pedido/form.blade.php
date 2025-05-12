@extends('base')
@section('titulo', isset($pedido->id) ? 'Editar Pedido' : 'Novo Pedido')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">{{ isset($pedido->id) ? 'Editar Pedido' : 'Novo Pedido' }}</h3>

    @php
        if (!empty($pedido->id)) {
            $action = route('pedidos.update', $pedido->id);
        } else {
            $action = route('pedidos.store');
        }
    @endphp

    <form action="{{ $action }}" method="post" class="row g-3">
        @csrf
        @if(!empty($pedido->id))
            @method('put')
        @endif

        <div class="col-md-6">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-select border-success">
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $pedido->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="flor_id" class="form-label">Flor</label>
            <select name="flor_id" id="flor_id" class="form-select border-success">
                @foreach($flores as $flor)
                    <option value="{{ $flor->id }}" {{ old('flor_id', $pedido->flor_id ?? '') == $flor->id ? 'selected' : '' }}>
                        {{ $flor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <select name="forma_pagamento" id="forma_pagamento" class="form-select border-success">
                <option value="cartao" {{ old('forma_pagamento', $pedido->forma_pagamento ?? '') == 'cartao' ? 'selected' : '' }}>Cartão de Crédito</option>
                <option value="boleto" {{ old('forma_pagamento', $pedido->forma_pagamento ?? '') == 'boleto' ? 'selected' : '' }}>Boleto</option>
                <option value="pix" {{ old('forma_pagamento', $pedido->forma_pagamento ?? '') == 'pix' ? 'selected' : '' }}>PIX</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select border-success">
                <option value="pendente" {{ old('status', $pedido->status ?? '') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="pago" {{ old('status', $pedido->status ?? '') == 'pago' ? 'selected' : '' }}>Pago</option>
                <option value="cancelado" {{ old('status', $pedido->status ?? '') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>

        <div class="col-12">
            <label for="endereco_entrega" class="form-label">Endereço de Entrega</label>
            <input
                type="text"
                name="endereco_entrega"
                id="endereco_entrega"
                value="{{ old('endereco_entrega', $pedido->endereco_entrega ?? '') }}"
                class="form-control border-success"
            >
        </div>

        <div class="col-12 d-flex justify-content-start">
            <button type="submit" class="btn btn-success me-2">Salvar</button>
            <a href="{{ url('pedidos') }}" class="btn btn-outline-success">Voltar</a>
        </div>
    </form>
</div>

@stop
