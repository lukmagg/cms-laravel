<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // SoftDeletes sirve para que los registros eliminados de la base de datos no se borren completamente.
    //  Sino, que se les asigna un atributo deleted_at para que no haya problemas despues, entonces, en la web
    //  aparece como si estuviera borrado pero en la base de datos sigue estando.
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    // Esta es la tabla (products) que le corresponde a este modelo.
    protected $table = 'products';
    protected $hidden = ['created-at', 'updated_at'];
}
