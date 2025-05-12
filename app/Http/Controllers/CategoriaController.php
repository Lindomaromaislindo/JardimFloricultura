<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $dados = Categoria::with('flores')->withCount('flores')->get();

        return view('categoria.list', ['dados' => $dados]);
    }

    public function create()
    {
        return view('categoria.form');
    }

    public function edit(string $id)
    {
        $dado = Categoria::findOrFail($id);

        return view('categoria.form', ['dado' => $dado]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        Categoria::create($request->all());

        return redirect('categorias')->with('success', 'Categoria criada com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        Categoria::updateOrCreate(['id' => $id], $request->all());

        return redirect('categorias')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $dado = Categoria::findOrFail($id);
        $dado->delete();

        return redirect('categorias')->with('success', 'Categoria removida com sucesso!');
    }

    public function search(Request $request)
    {
        $query = Categoria::with('flores')->withCount('flores');

        if (!empty($request->valor)) {
            if ($request->tipo === 'flor') {
                $query->whereHas('flores', function ($q) use ($request) {
                    $q->where('nome', 'like', '%' . $request->valor . '%');
                });
            } else {
                $query->where($request->tipo, 'like', '%' . $request->valor . '%');
            }
        }

        $dados = $query->get();

        return view('categoria.list', ['dados' => $dados]);
    }
}
