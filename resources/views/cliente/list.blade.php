@extends('base')
@section('titulo', 'Listagem de Clientes')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">Listagem de Clientes</h3>

    <form action="{{ route('clientes.search') }}" method="post" class="row g-3 mb-4">
        @csrf
        <div class="col-md-4">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select border-success">
                <option value="nome">Nome</option>
                <option value="email">Email</option>
                <option value="telefone">Telefone</option>
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
            <a href="{{ url('clientes/create') }}" class="btn btn-outline-success">Novo</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dados as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->telefone }}</td>
                        <td class="text-center">
                            <a href="{{ route('clientes.edit', $item->id) }}" class="btn btn-sm btn-outline-success">Editar</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('clientes.destroy', $item->id) }}" method="post" onsubmit="return confirm('Deseja remover o registro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Nenhum cliente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
