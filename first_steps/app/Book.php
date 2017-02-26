<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'price', 'isbn', 'stock', 'description', 'user_id', 'author_id' ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function author()
    {
      return $this->belongsTo('App\Author');
    }

}
