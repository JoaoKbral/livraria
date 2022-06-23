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
        $autoress = Autores::orderBy('titulo')->paginate(5);
        return view('autoress.index', compact('autoress'));
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $autoress = Autores::where('titulo', 'LIKE', "%request->search%")
            ->orWhere('idioma', 'LIKE', "%request->search%")
            ->paginate(5);
        return view('autoress.index', compact('autoress', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autoress.create');
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
        $autores = Autores::find($id);
        if (!$autores) {
            return redirect()
                ->route('autores.index')
                ->with('message', 'autores não foi encontrado');
        }
        return view('autoress.show', compact('autores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $autores = Autores::find($id);
        if (!$autores) {
            return redirect()
                ->route('autores.index')
                ->with('message', 'autores não foi encontrado');
        }
        return view('autoress.edit', compact('autores'));
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
        $autores = Autores::find($id);
        if (!$autores) {
            return redirect()->route('autoress.index')->with('message', 'autores não foi encontrado');
        }
        $data = $request->all();
        if (isset($request->capa) && $request->capa->isValid()) {
            if (Storage::exists($autores->capa)) {
                Storage::delete($autores->capa);
            }

            $nameFile = Str::of($request->isbn)->slug('-') . '.' . $request->capa->getClientOriginalExtension();
            $image = $request->capa->storeAs('autores', $nameFile);
            $data['capa'] = $image;
            $autores->update($data);
            return redirect()->route('autoress.index')->with('message', 'autores editado!');
        }else {
            return redirect()->route('autoress.index')->with('message', 'Arquivo de imagem invalido');
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
        $autores = Autores::find($id);
        if (!$autores) {
            return redirect()
                ->route('autores.index')
                ->with('message', 'autores não foi encontrado');
        }
        $autores->delete();
        return redirect()
            ->route('autores.index')
            ->with('message', 'autores deletado');
    }
}
