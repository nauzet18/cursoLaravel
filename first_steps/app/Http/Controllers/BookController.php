<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str as Str;
use App\Book;

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
        return view('book.create', ['book' => new Book ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'title' => 'required|unique:books',
            'isbn' => 'required|unique:books',
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

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

        return view('book.edit', compact('book') );
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
        $v = \Validator::make($request->all(), [
            'title' => 'required',
            'isbn' => 'required',
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
        return redirect()->back();
    }

    /**
     * Shearch resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
         $books = Book::where('title','like','%'.$request->title.'%')->get();

         return view('book.index', ['books' => $books ]);
    }
}
