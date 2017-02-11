<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Book as Book;

class BookComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //En este metodo genero la infirmación que le quiero pasar a la vista.
        //En este caso simplemente es pasar cuantos elementos hay en el modelo Book
        //Y lo tengo disponible en la variables count
        $view->with('count', Book::count());
    }

}