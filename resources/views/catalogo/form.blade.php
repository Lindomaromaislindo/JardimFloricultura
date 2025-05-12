@extends('base')
@section('titulo', isset($catalogo->id) ? 'Editar Catálogo' : 'Novo Catálogo')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">
        {{ isset($catalogo->id) ? 'Editar' : 'Novo' }} Catálogo -
        {{ isset($catalogo->id) ? $catalogo->flor->nome : $flor->nome }}
    </h3>

    @php
        if (!empty($catalogo->id)) {
            $action = route('flores.catalogos.update', [$catalogo->flor_id, $catalogo->id]);
            $data_inicio = date('d/m/Y', strtotime($catalogo->data_inicio));
            $data_fim    = date('d/m/Y', strtotime($catalogo->data_fim));
        } else {
            $action = route('flores.catalogos.store', $flor->id);
        }
    @endphp

    <form action="{{ $action }}" method="post" class="row g-3">
        @csrf
        @if (!empty($catalogo->id))
            @method('PUT')
        @endif

        <input type="hidden" name="flor_id" value="{{ old('flor_id', $catalogo->flor_id ?? $flor->id) }}">

        <div class="col-md-6">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-select border-success">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria_id', $catalogo->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="data_inicio" class="form-label">Data Início</label>
            <input
                type="date"
                name="data_inicio"
                id="data_inicio"
                value="{{ old('data_inicio', $catalogo->data_inicio ?? '') }}"
                class="form-control border-success"
            >
        </div>

        <div class="col-md-6">
            <label for="data_fim" class="form-label">Data Fim</label>
            <input
                type="date"
                name="data_fim"
                id="data_fim"
                value="{{ old('data_fim', $catalogo->data_fim ?? '') }}"
                class="form-control border-success"
            >
        </div>

        <div class="col-md-6">
            <label for="codigo" class="form-label">Código</label>
            <input
                type="text"
                name="codigo"
                id="codigo"
                value="{{ old('codigo', $catalogo->codigo ?? '') }}"
                class="form-control border-success"
                readonly
            >
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-success me-2">Salvar</button>
            <a href="{{ route('flores.catalogos.index', isset($catalogo) ? $catalogo->flor_id : $flor->id) }}" class="btn btn-outline-success">Voltar</a>
        </div>
    </form>
</div>

@stop
