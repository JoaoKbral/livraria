<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateLivro;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::all();
        return view ('livros.index', compact ('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('livros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Livro::create($request->all());
        return redirect()->route('livro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return redirect()
                    ->route('livro.index')
                    ->with('message', 'Livro não foi encontrado');
        }
        return view('livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro= Livro::find($id);
        if(!$livro){
            return redirect()
                    ->route('livro.index')
                    ->with('message', 'Livro não foi encontrado');
        }
        return view('livros.edit', compact('livro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livro= Livro::find($id);
        if (!$livro) {
            return redirect()
                    ->route('livros.index')
                    ->with('message','Livro não foi encontrado');
        }
        $livro->update($request->all());
        return redirect()
                ->route('livros.index')
                ->with('message','Livro editado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livro= Livro::find($id);
        if(!$livro){
            return redirect()
                    ->route('livro.index')
                    ->with('message', 'Livro não foi encontrado');
        }
        $livro->delete();
        return redirect()
                    ->route('livro.index')
                    ->with('message', 'Livro deletado');
    }
}
