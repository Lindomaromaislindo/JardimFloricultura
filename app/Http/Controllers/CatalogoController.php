<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Flor;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Flor $flor)
    {
        $dados = $flor->catalogos;

        return view('catalogo.list', [
            'dados' => $dados,
            'flor' => $flor
        ]);
    }

    public function create(Flor $flor)
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('catalogo.form', [
            'flor' => $flor,
            'categorias' => $categorias
        ]);
    }

    public function edit(Flor $flor, string $id)
{
    $catalogo = Catalogo::findOrFail($id);
    $categorias = Categoria::orderBy('nome')->get();
    $catalogo->data_inicio = date('Y-m-d', strtotime($catalogo->data_inicio));
    $catalogo->data_fim = date('Y-m-d', strtotime($catalogo->data_fim));

    return view('catalogo.form', [
        'catalogo' => $catalogo,
        'categorias' => $categorias,
        'flor' => $flor
    ]);
}

    private function validateRequest(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);
    }

    public function store(Request $request, $flor_id)
    {
        $this->validateRequest($request);

        $codigoNumerico = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $codigo = 'FLOR - ' . $codigoNumerico;

        $data = $request->all();
        $data['flor_id'] = $flor_id;
        $data['codigo'] = $codigo;

        Catalogo::create($data);

        return redirect()->route('flores.catalogos.index', $flor_id);
    }

    public function update(Request $request, $flor_id, string $id)
    {
        $this->validateRequest($request);

        $catalogo = Catalogo::findOrFail($id);

        $data = $request->all();

        $catalogo->update($data);

        return redirect()->route('flores.catalogos.index', $flor_id);
    }

    public function destroy(Flor $flor, string $id)
    {
        $catalogo = Catalogo::findOrFail($id);
        $catalogo->delete();

        return redirect()->route('flores.catalogos.index', $flor->id);
    }

    public function search(Request $request, Flor $flor)
{
    $tipo = $request->input('tipo');
    $valor = $request->input('valor');

    $query = Catalogo::where('flor_id', $flor->id);

    if ($tipo === 'categoria') {
        $query->whereHas('categoria', function ($q) use ($valor) {
            $q->where('nome', 'like', "%{$valor}%");
        });
    } elseif (in_array($tipo, ['data_inicio', 'data_fim'])) {
        $query->where($tipo, 'like', "%{$valor}%");
    } elseif ($tipo === 'codigo') {
        $query->where('codigo', 'like', "%{$valor}%");
    }

    $dados = $query->get();

    return view('catalogo.list', [
        'dados' => $dados,
        'flor' => $flor
    ]);
}
}
