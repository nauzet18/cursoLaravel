<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str as Str;
use App\Book;
use App\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('book.index', ['books' => $books ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $book = new Book;
        return view('book.create', compact('book','authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //NOTA; Esta manera de validar usa el alinas \Validator definido en confing/app.php
        //Se pide un objeto validador donde pasamos los datos y las reglas y luego nosotros
        //tenemos que comprobar si ha fallado y como actuar en consecuencia.

//1º forma, parece que es la forma que se usaba en laravel 4
/*
        $v = \Validator::make($request->all(), [
            'title' => 'required|unique:books',
            'isbn' => 'required|unique:books',
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
*/

        //Otra forma de validar es usando el metodo validate del trait ValidatesRequests, que esta usado en la clase Controller.
        //Este metodo ya tiene codigo que comprueba si ha fallado y hace el redirect con el back, con withInput, etc.
        $this->validate($request, [
            'title' => 'required|unique:books',
            'isbn' => 'required|unique:books',
        ]);

        $book= Book::create($request->all());
        $book->slug = Str::slug( $book->title );
        $book->save();

        flash('Creado correctamente');
        return redirect('/book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if(empty($book))
        {
            //Uso el paquete de laracasts/flash https://github.com/laracasts/flash
            //Que permite mostrar mensajes flash muy facilmente solo con llamar al metodo flash,
            //indicar el mensaje y el tipo de mensaje
            flash('No se ha encontrado el elemento con id: '.$id, 'danger');
            return redirect('/book');
        }

        //Con compact, evito tener q crear el array calve-valor para indicar q nombre de variable y que variable pasar a la vista
        //Ya compact crea ese array, buscando una variable que se llama book
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Esto es un ejemplo de como capturar la excepcion de findOrFail y redirigir a una pagina con un mensaje
        //En SHOW, lo hago de la manera tradicional, usando el find y preguntando si es vacio.
        try {
            $book = Book::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flash('No se ha encontrado el elemento con id: '.$id, 'danger');
            return redirect('/book');
        }

        $authors = Author::all();

        return view('book.edit', compact('book','authors'));
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
        //NOTA; Por que en el update tengo que quitar el siguiente filtro? la parte del |unique:books
        //'isbn' => 'required|unique:books',
        //¿Como se comporta el unique en el validador? No me deja guardar actualizar un book.
        //REPUESTA=> Para poder poner en un update la regla de unique debemos añadir al filtro
        //el ID del registro que queremos excluir de la comprobación.
        //Asi reolvemos el tema de los unicos en un edit
        $v = \Validator::make($request->all(), [
            'title' => 'required|unique:books,title,'.$id,
            'isbn' => 'required|unique:books,isbn,'.$id,
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $book = Book::find($id);
        //De esta manera relleno un objeto  con todos los campos que se han enviado por el formulario.
        //Npta: solo se rellenaran los atributos indicados en el modelo como fillable
        $book->fill($request->all() );
        $book->slug = Str::slug( $book->title );
        $book->save();
        flash('Guardado correctamente');
  
        return redirect('/book/'.$book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
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
       $book = Book::withTrashed()->where('id', '=', $id)->first();

       //Restauramos el registro
       $book->restore();

       return redirect('/book/')->with("restored" , $id );
    }

    /**
     * Shearch resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //Un ejemplo de crear y usar un SCOPE con el ORL, para dejar mas limpio el código de las busquedas
        $books = Book::findTitle($request->title)->get();
        //$books = Book::where('title','like','%'.$request->title.'%')->get();
        return view('book.index', ['books' => $books ]);
    }
}
