@extends('base')
@section('titulo', 'Formulário Cliente')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">Formulário Cliente</h3>

    @php
        if (!empty($dado->id)) {
            $action = route('clientes.update', $dado->id);
        } else {
            $action = route('clientes.store');
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
                placeholder="Digite o nome"
                required
            >
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email', $dado->email ?? '') }}"
                class="form-control border-success"
                placeholder="Digite o email"
            >
        </div>

        <div class="col-md-6">
            <label for="telefone" class="form-label">Telefone</label>
            <input
                type="text"
                name="telefone"
                id="telefone"
                value="{{ old('telefone', $dado->telefone ?? '') }}"
                class="form-control border-success"
                placeholder="Digite o telefone"
            >
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-success me-2">Salvar</button>
            <a href="{{ url('clientes') }}" class="btn btn-outline-success">Voltar</a>
        </div>
    </form>
</div>

@stop
