<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autores;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autores::orderBy('titulo')->paginate(5);
        return view('autores.index', compact('autores'));
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $autor = Autores::where('titulo', 'LIKE', "%request->search%")
            ->orWhere('idioma', 'LIKE', "%request->search%")
            ->paginate(5);
        return view('autores.index', compact('autor', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autores.create');
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
            $image = $request->capa->storeAs('autores', $nameFile);
            $data['capa'] = $image;
            Autores::create('$data');
            return redirect()->route('autores.index');
        } else {
            return redirect()->route('autores.index')->with('message', 'Arquivo de imagem invalido');
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
        $autor = Autores::find($id);
        if (!$autor) {
            return redirect()
                ->route('autores.index')
                ->with('message', 'Autor não foi encontrado');
        }
        return view('autores.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $autor = Autores::find($id);
        if (!$autor) {
            return redirect()
                ->route('autores.index')
                ->with('message', 'Autor não foi encontrado');
        }
        return view('autores.edit', compact('autor'));
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
        $autor = Autores::find($id);
        if (!$autor) {
            return redirect()->route('autores.index')->with('message', 'Autor não foi encontrado');
        }
        $data = $request->all();
        if (isset($request->capa) && $request->capa->isValid()) {
            if (Storage::exists($autor->capa)) {
                Storage::delete($autor->capa);
            }

            $nameFile = Str::of($request->isbn)->slug('-') . '.' . $request->capa->getClientOriginalExtension();
            $image = $request->capa->storeAs('autores', $nameFile);
            $data['capa'] = $image;
            $autor->update($data);
            return redirect()->route('autores.index')->with('message', 'Autor editado!');
        }else {
            return redirect()->route('autores.index')->with('message', 'Arquivo de imagem invalido');
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
        $autor = Autores::find($id);
        if (!$autor) {
            return redirect()
                ->route('autores.index')
                ->with('message', 'Autor não foi encontrado');
        }
        $autor->delete();
        return redirect()
            ->route('autores.index')
            ->with('message', 'Autor deletado');
    }
}
