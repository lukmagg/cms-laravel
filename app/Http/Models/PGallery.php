<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PGallery extends Model
{
    
    // SoftDeletes sirve para que los registros eliminados de la base de datos no se borren completamente.
    //  Sino, que se les asigna un atributo deleted_at para que no haya problemas despues, entonces, en la web
    //  aparece como si estuviera borrado pero en la base de datos sigue estando.
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'product_gallery';
    protected $hidden = ['created_at','updated_at'];
}
