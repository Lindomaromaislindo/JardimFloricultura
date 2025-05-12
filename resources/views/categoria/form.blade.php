@extends('base')
@section('titulo', 'Formulário Categoria')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">Formulário de Categoria</h3>

    @php
        if (!empty($dado->id)) {
            $action = route('categorias.update', $dado->id);
        } else {
            $action = route('categorias.store');
        }
    @endphp

    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
                type="text"
                name="nome"
                id="nome"
                class="form-control border-success"
                value="{{ old('nome', $dado->nome ?? '') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea
                name="descricao"
                id="descricao"
                class="form-control border-success"
                rows="4"
            >{{ old('descricao', $dado->descricao ?? '') }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ url('categorias') }}" class="btn btn-outline-success">Voltar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>

@stop
