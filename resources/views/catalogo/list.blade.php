@extends('base')
@section('titulo', 'Listagem de Catálogo - Flor ' . $flor->nome)
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">Listagem de Catálogo - Flor {{ $flor->nome }}</h3>

    <form action="{{ route('flores.catalogos.search', $flor->id) }}" method="post" class="row g-3 mb-4">
        @csrf

        <div class="col-md-4">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select border-success">
                <option value="categoria">Categoria</option>
                <option value="data_inicio">Data Início</option>
                <option value="data_fim">Data Fim</option>
                <option value="codigo">Código</option>
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
            <a href="{{ route('flores.catalogos.create', $flor->id) }}" class="btn btn-outline-success me-2">Novo</a>
            <a href="{{ route('flores.index') }}" class="btn btn-outline-secondary">Voltar</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Código</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dados as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->categoria->nome }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_inicio)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_fim)) }}</td>
                        <td>{{ $item->codigo }}</td>
                        <td class="text-center">
                            <a href="{{ route('flores.catalogos.edit', [$flor->id, $item->id]) }}" class="btn btn-sm btn-outline-success">Editar</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('flores.catalogos.destroy', [$flor->id, $item->id]) }}" method="post" onsubmit="return confirm('Deseja remover o registro?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Nenhum catálogo encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
