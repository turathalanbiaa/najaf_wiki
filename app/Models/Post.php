<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Post extends Model
{
    use Searchable;

    protected $fillable = ['title','description','subcategory'];

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory');
    }

}
