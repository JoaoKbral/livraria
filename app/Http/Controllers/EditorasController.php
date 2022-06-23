<?php

namespace App\Http\Controllers;
use App\Models\Editoras;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class EditorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editora = Editoras::orderBy('titulo')->paginate(5);
        return view('editoras.index', compact('editora'));
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $editora = Editoras::where('titulo', 'LIKE', "%request->search%")
            ->orWhere('idioma', 'LIKE', "%request->search%")
            ->paginate(5);
        return view('editoras.index', compact('editora', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editoras.create');
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
            $image = $request->capa->storeAs('editora', $nameFile);
            $data['capa'] = $image;
            Editoras::create('$data');
            return redirect()->route('editoras.index');
        } else {
            return redirect()->route('editoras.index')->with('message', 'Arquivo de imagem invalido');
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
        $editora = Editoras::find($id);
        if (!$editora) {
            return redirect()
                ->route('editoras.index')
                ->with('message', 'editora não foi encontrado');
        }
        return view('editoras.show', compact('editoras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editora = Editoras::find($id);
        if (!$editora) {
            return redirect()
                ->route('editoras.index')
                ->with('message', 'editora não foi encontrado');
        }
        return view('editoras.edit', compact('editoras'));
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
        $editora = Editoras::find($id);
        if (!$editora) {
            return redirect()->route('editoras.index')->with('message', 'editora não foi encontrado');
        }
        $data = $request->all();
        if (isset($request->capa) && $request->capa->isValid()) {
            if (Storage::exists($editora->capa)) {
                Storage::delete($editora->capa);
            }

            $nameFile = Str::of($request->isbn)->slug('-') . '.' . $request->capa->getClientOriginalExtension();
            $image = $request->capa->storeAs('editora', $nameFile);
            $data['capa'] = $image;
            $editora->update($data);
            return redirect()->route('editoras.index')->with('message', 'editora editado!');
        }else {
            return redirect()->route('editoras.index')->with('message', 'Arquivo de imagem invalido');
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
        $editora = Editoras::find($id);
        if (!$editora) {
            return redirect()
                ->route('editoras.index')
                ->with('message', 'editora não foi encontrado');
        }
        $editora->delete();
        return redirect()
            ->route('editors.index')
            ->with('message', 'editora deletado');
    }
}
