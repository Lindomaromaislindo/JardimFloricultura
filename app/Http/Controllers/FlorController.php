<?php

namespace App\Http\Controllers;

use App\Models\Flor;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FlorController extends Controller
{
    public function index()
    {
        $dados = Flor::with('categoria')->get();

        return view('flor.list', ['dados' => $dados]);
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('flor.form', [
            'categorias' => $categorias
        ]);
    }

    public function edit(string $id)
    {
        $dado = Flor::findOrFail($id);
        $categorias = Categoria::orderBy('nome')->get();

        return view('flor.form', [
            'dado' => $dado,
            'categorias' => $categorias
        ]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome'         => 'required|string|max:255',
            'descricao'    => 'nullable|string',
            'preco'        => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'nome.required'         => 'O campo nome é obrigatório',
            'preco.required'        => 'O campo preço é obrigatório',
            'preco.numeric'         => 'O preço deve ser um número',
            'categoria_id.required' => 'A categoria é obrigatória',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        Flor::create($request->all());

        return redirect('flores')->with('success', 'Flor cadastrada com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        Flor::updateOrCreate(['id' => $id], $request->all());

        return redirect('flores')->with('success', 'Flor atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $dado = Flor::findOrFail($id);
        $dado->delete();

        return redirect('flores')->with('success', 'Flor deletada com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Flor::where($request->tipo, 'like', "%{$request->valor}%")->get();
        } else {
            $dados = Flor::with('categoria')->get();
        }

        return view('flor.list', ['dados' => $dados]);
    }

    public function report()
    {
    $dados = Flor::with('categoria')->get();

    $pdf = Pdf::loadView('flor.report', ['dados' => $dados])
              ->setPaper('a4', 'portrait');

    return $pdf->download('relatorio_flores.pdf');
    }
}
