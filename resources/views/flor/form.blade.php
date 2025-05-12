@extends('base')
@section('titulo', 'Formulário Flor')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">Formulário Flor</h3>

    @php
        if (!empty($dado->id)) {
            $action = route('flores.update', $dado->id);
        } else {
            $action = route('flores.store');
        }
    @endphp

    <form action="{{ $action }}" method="post" class="row g-3">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ old('nome', $dado->nome ?? '') }}"
                class="form-control border-success"
            >
        </div>

        <div class="col-md-6">
            <label for="preco" class="form-label">Preço</label>
            <input
                type="number"
                name="preco"
                id="preco"
                step="0.01"
                min="0"
                value="{{ old('preco', $dado->preco ?? '') }}"
                class="form-control border-success"
            >
        </div>

        <div class="col-12">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea
                name="descricao"
                id="descricao"
                rows="3"
                class="form-control border-success"
            >{{ old('descricao', $dado->descricao ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-select border-success">
                <option value="">-- Selecione uma categoria --</option>
                @foreach ($categorias as $categoria)
                    <option
                        value="{{ $categoria->id }}"
                        {{ old('categoria_id', $dado->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}
                    >
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 d-flex justify-content-start">
            <button type="submit" class="btn btn-success me-2">Salvar</button>
            <a href="{{ url('flores') }}" class="btn btn-outline-success">Voltar</a>
        </div>
    </form>
</div>

@stop
