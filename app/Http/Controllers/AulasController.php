<?php

namespace App\Http\Controllers;

use App\Models\Aulas;
use Illuminate\Http\Request;
use DB;

class AulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aulas = Aulas::simplePaginate(10);
        return view('admin.aulas', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'tipo' => 'required',
            'aforo' => 'required',
        ]);

       //validar con try catch
       try {
            $aula = new Aulas();
            $aula->codigo = $request->codigo;
            $aula->tipo = $request->tipo;
            $aula->aforo = $request->aforo;
            $aula->save();

            return redirect()->route('aulas.index')->with('success', 'Aula creada correctamente');
        } catch (\Exception $e) {

            return redirect()->route('aulas.index')->with('error', 'Error al crear el aula: ' . $e->getMessage());
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aulas  $aulas
     * @return \Illuminate\Http\Response
     */
    public function show(Aulas $aulas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aulas  $aulas
     * @return \Illuminate\Http\Response
     */
    public function edit(Aulas $aulas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aulas  $aulas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aulas $aulas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aulas  $aulas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //borrar
        $aula = DB::table('aulas')->where('aula_id', $id)->first();

        if ($aula) {
            DB::table('aulas')->where('aula_id', $id)->delete();
            return response()->json(['success' => true, 'message' => 'Aula eliminada correctamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Aula no encontrada']);
        }
    }
}
