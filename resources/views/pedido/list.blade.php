@extends('base')
@section('titulo', 'Listagem de Pedidos')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">Listagem de Pedidos</h3>

    <form action="{{ route('pedidos.search') }}" method="post" class="row g-3 mb-4">
        @csrf
        <div class="col-md-4">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select border-success">
                <option value="cliente">Cliente</option>
                <option value="flor">Flor</option>
                <option value="forma_pagamento">Forma de Pagamento</option>
                <option value="endereco_entrega">Endereço</option>
                <option value="status">Status</option>
            </select>
        </div>

        <div class="col-md-5">
            <label for="valor" class="form-label">Valor</label>
            <input
                type="text"
                name="valor"
                id="valor"
                placeholder="Digite o valor"
                value="{{ old('valor') }}"
                class="form-control border-success"
            >
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-success me-2">Buscar</button>
            <a href="{{ url('pedidos/create') }}" class="btn btn-outline-success">Novo</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Flor</th>
                    <th>Forma Pagamento</th>
                    <th>Endereço</th>
                    <th>Status</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dados as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->cliente->nome ?? $item->cliente_id }}</td>
                        <td>{{ $item->flor->nome ?? $item->flor_id }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $item->forma_pagamento)) }}</td>
                        <td>{{ $item->endereco_entrega }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                        <td class="text-center">
                            <a href="{{ route('pedidos.edit', $item->id) }}" class="btn btn-sm btn-outline-success">Editar</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('pedidos.destroy', $item->id) }}" method="post" onsubmit="return confirm('Deseja remover o pedido?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Nenhum pedido encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
