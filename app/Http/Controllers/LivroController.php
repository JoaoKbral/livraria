<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::orderBy('titulo')->paginate(5);
        return view('livros.index', compact('livros'));
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $livros = Livro::where('titulo', 'LIKE', "%request->search%")
            ->orWhere('idioma', 'LIKE', "%request->search%")
            ->paginate(5);
        return view('livros.index', compact('livros', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->capa->isValid()) {
            $nameFile = Str::of($request->isbn)->slug('-') . '.' . $request->capa->getClientOriginalExtension();
            $image = $request->capa->storeAs('livro', $nameFile);
            $data['capa'] = $image;
            Livro::create('$data');
            return redirect()->route('livro.index');
        } else {
            return redirect()->route('livro.index')->with('message', 'Arquivo de imagem invalido');
        }
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
        $livro = Livro::find($id);
        if (!$livro) {
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
        $livro = Livro::find($id);
        if (!$livro) {
            return redirect()->route('livros.index')->with('message', 'Livro não foi encontrado');
        }
        $data = $request->all();
        if (isset($request->capa) && $request->capa->isValid()) {
            if (Storage::exists($livro->capa)) {
                Storage::delete($livro->capa);
            }

            $nameFile = Str::of($request->isbn)->slug('-') . '.' . $request->capa->getClientOriginalExtension();
            $image = $request->capa->storeAs('livro', $nameFile);
            $data['capa'] = $image;
            $livro->update($data);
            return redirect()->route('livros.index')->with('message', 'Livro editado!');
        }else {
            return redirect()->route('livros.index')->with('message', 'Arquivo de imagem invalido');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
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
