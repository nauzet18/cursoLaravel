<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
            'title' => 'required',
            'isbn' => 'required|unique:books',
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        Book::create($request->all());
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

        return view('book.show', ['book' => $book ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('book.edit', ['book' => Book::find($id) ]);
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
        $v = \Validator::make($request->all(), [
            'title' => 'required',
            'isbn' => 'required|unique:books',
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $book = Book::find($id);
        //De esta manera relleno un objeto  con todos los campos que se han enviado por el formulario.
        //Npta: solo se rellenaran los atributos indicados en el modelo como fillable
        $book->fill($request->all() );
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
        //
    }
}
