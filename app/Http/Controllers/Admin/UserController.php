<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    # El constructor se ejecuta cada ves que se llama a un metodo de este controlador.
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getUsers(){
        # User es el modelo User para la tabla users.
        # Agrega en $users todos los registros de forma descendente.
        $users = User::orderBy('id', 'Desc')->get();
        $data = ['users' => $users];
        return view('admin.users.home', $data);
    }
}
