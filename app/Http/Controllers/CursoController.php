<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all cursos from the database
        $cursos = Curso::all();

        // Pass the cursos to the view
        return view('registro/curso/show', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        //Get Cursos
        $cursos = Curso::all();

        //return view for create form
        return view ('registro/curso/create')->with(['cursos'=>$cursos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->post());

        // validate fields
        $data = request()->validate([
            'codigo'=>'required',
            'nombre'=>'required'
        ]);

        // Insert information
        Curso::create($data);

        // Redirect information(when not using view we have to use redirct for saving data)
        return redirect('registro/curso/show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //Get Cursos
        $cursos = Curso::all();

        // show views
        return view ('registro/curso/update')->with(['course' => $curso]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        // validate fields
        $data = request()->validate([
            'codigo'=>'required',
            'nombre'=>'required'
        ]);

        // remplazar old data for new data
        $curso->codigo = $data['codigo'];
        $curso->nombre = $data['nombre'];
        $curso->updated_at = now();

        //Save update
        $curso->save();

        // Redirect data
        return redirect('registro/curso/show')->with('success', 'El curso se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //deleting product with ID 
        Curso::destroy($id);

        // return a json answer
        return response()->json(array('res'=> true));
    }
}
