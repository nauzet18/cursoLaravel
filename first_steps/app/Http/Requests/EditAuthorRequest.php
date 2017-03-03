<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditAuthorRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Para resolver el problema de hacer unico un campo, pero si estamos en una accion
        //de update, queremos excluir el propio registro.
        //Esto se hace  sacando el ID de elemento de la ruta URL y añadiendolo como 3º parametro
        //a la regla de unique. El formato de la regla queda como:
        // unique:TABLA,CAMPO,ID_A_EXCLUIR
        $authorId = $this->route('author');

        return [ 'nombre' => 'required',
                 'apellidos' => 'required',
                 'dni' => 'required|unique:authors,dni,'.$authorId,
                 'email' => 'required|unique:authors,email,'.$authorId,
        ];
    }
}
