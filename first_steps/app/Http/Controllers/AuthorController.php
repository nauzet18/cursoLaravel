<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\EditAuthorRequest;
use App\Http\Controllers\Controller;
use App\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return view('author.index', compact('authors') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\CreateAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAuthorRequest $request)
    {
        //NOTA: He eliminado esta forma de validar, donde yo lo uso todo y en su lugar he 
        //usado la clase CreateAuthorRequest, que valida directamente a partir del objeto $request
        //Esta clase puede gestionar las reglas de validación y si se esta autorizado o no. 
        //Por lo que deja el codigo mucho mas limpio.

        $author= Author::create($request->all());

        flash('Creado correctamente');
        return redirect('/author');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flash('No se ha encontrado el elemento con id: '.$id, 'danger');
            return redirect('/author');
        }

        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flash('No se ha encontrado el elemento con id: '.$id, 'danger');
            return redirect('/author');
        }

        return view('author.edit', compact('author') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAuthorRequest $request, $id)
    {
/*Ya no uso esta forma de validar, sino que uso los form request validation
        $v = \Validator::make($request->all(), [
            'nombre' => 'required',
            'apellidos' => 'required',
            'dni' => 'required',
            'email' => 'required',
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
*/
        try {
            $author = Author::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flash('No se ha encontrado el elemento con id: '.$id, 'danger');
            return redirect()->back()->withInput();
        }

        //De esta manera relleno un objeto  con todos los campos que se han enviado por el formulario.
        //Npta: solo se rellenaran los atributos indicados en el modelo como fillable
        $author->fill($request->all() );
        $author->save();
        flash('Guardado correctamente');
  
        return redirect('/author/'.$author->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flash('No se ha encontrado el elemento con id: '.$id, 'danger');
            return redirect('/author');
        }

        $author->delete();
        return redirect()->back()->with("deleted" , $id );
    }

    /**
    * restore the specified resource to storage.
    *
    * @param  int  $id
    * @return Response
    */

    public function restore( $id )
    {
       //Indicamos que la busqueda se haga en los registros eliminados con withTrashed
       $author = Author::withTrashed()->where('id', '=', $id)->first();

       //Restauramos el registro
       $author->restore();

       return redirect('/author/')->with("restored" , $id );
    }

    /**
     * Shearch resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
         $authors = Author::where('dni','like','%'.$request->dni.'%')->get();

         return view('author.index', compact('authors'));
    }
}
