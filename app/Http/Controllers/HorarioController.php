<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Aulas;
use Illuminate\Http\Request;
use DB;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::orderBy("nombre", "desc")->get();
        $docentes = Docente::orderBy("nombres", "desc")->get();
        $aulas = Aulas::orderBy("codigo", "desc")->get();

        return view('admin.horarios', compact('cursos', 'docentes', 'aulas'));
    }

    public function get_horarios()
    {
        $horarios = DB::table('horarios as h')
            ->join('aulas as a', 'a.aula_id', '=', 'h.aula_id')
            ->join('docentes as d', 'd.docente_id', '=', 'h.docente_id')
            ->join('cursos as c', 'c.curso_id', '=', 'h.curso_id')
            ->select(
                'h.horario_id',
                'h.fecha_inicio',
                'h.fecha_fin',
                'a.codigo',
                'a.aula_id',
                'd.docente_id',
                'd.nombres',
                'd.apellidos',
                'c.curso_id',
                'c.nombre'
            )
            ->get();

        return $horarios;
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
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'aula_id' => 'required',
            'curso_id' => 'required',
            'docente_id' => 'required',
        ]);

        $horario = new Horario();

        $horario->fecha_inicio = $request->fecha_inicio;
        $horario->fecha_fin = $request->fecha_fin;
        $horario->aula_id = $request->aula_id;
        $horario->curso_id = $request->curso_id;
        $horario->docente_id = $request->docente_id;
        $horario->tipo = $request->tipo ?? 'teoria';
        $horario->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'aula_id' => 'required',
            'curso_id' => 'required',
            'docente_id' => 'required',
        ]);

        DB::table('horarios')->where('horario_id', $id)->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'aula_id' => $request->aula_id,
            'curso_id' => $request->curso_id,
            'docente_id' => $request->docente_id,
            'tipo' => $request->tipo ?? 'teoria',
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        //
    }
}
