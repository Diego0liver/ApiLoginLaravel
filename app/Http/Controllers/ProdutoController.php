<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtosGetAll = Produto::all();
        return $produtosGetAll;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $produtosCreat = Produto::create($request->all());
       return $produtosCreat;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produtosGetId = Produto::findOrFail($id);
        return $produtosGetId;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produtoUpdate = Produto::findOrFail($id);
        $produtoUpdate->update($request->all());
        return $produtoUpdate;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $produtoDelet = Produto::destroy($id);
       return $produtoDelet;
    }

    public function showNome($nome)
    {
     $produtosGetNome = Produto::where('nome', 'like', '%'.$nome.'%')->get();
     return $produtosGetNome;
    }
}
