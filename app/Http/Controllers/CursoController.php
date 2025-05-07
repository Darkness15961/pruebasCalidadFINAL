<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use DB;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::simplePaginate(10);
        return view('admin.cursos', compact('cursos'));
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
            'nombre' => 'required|string',
            'horas_t' => 'required|integer',
            'horas_p' => 'required|integer',
            'creditos' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:255',
        ]);        

        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->horas_teoricas = $request->horas_t;
        $curso->horas_practicas = $request->horas_p;
        $curso->creditos = $request->creditos;
        $curso->descripcion = $request->descripcion;
        $curso->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required|string',
            'horas_t' => 'required|integer',
            'horas_p' => 'required|integer',
            'creditos' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $curso->nombre = $request->nombre;
        $curso->horas_teoricas = $request->horas_t;
        $curso->horas_practicas = $request->horas_p;
        $curso->creditos = $request->creditos;
        $curso->descripcion = $request->descripcion;
        $curso->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //borrar
        $curso = DB::table('cursos')->where('curso_id', $id)->first();

        if ($curso) {
            DB::table('cursos')->where('curso_id', $id)->delete();
            return response()->json(['success' => true, 'message' => 'Curso eliminado correctamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Curso no encontrado']);
        }

    }
}
