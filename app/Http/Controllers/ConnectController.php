<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash;
use App\User;



class ConnectController extends Controller
{
    public function getLogin(){
        return view('connect.login');
    }

    public function getRegister(){
        return view('connect.register');
    }

    public function postRegister(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:App\User,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password'
        ];

        #Modifica los mensajes de error por defecto de laravel, por los mensajes que nosotros le ponemos.
        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es inválido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'cpassword.required' => 'Es necesario confirmar la contraseña.',
            'cpassword.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden.'
        ];

        #Validator obtiene valor True o False segun el resultado de la validacion de los campos
        #Si da False quiere decir que falló, y vuelve atras
        #Si da True, guarda la info en la base de datos
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert','danger');
        else:
            $user = new User;
            #La e() es para encodear los datos, y que no entren scripts dañinos por nuestro form.
            #Hash es para encriptar la contraseña.
            $user -> name = e($request -> input('name'));
            $user -> lastname = e($request -> input('lastname'));
            $user -> email = e($request -> input('email'));
            $user -> lastname = e($request -> input('lastname'));
            $user -> password = Hash::make($request -> input('password'));

            if($user -> save()):
                return redirect('/login') -> with('message', 'Su usuario se creo con exito') -> with('typealert', 'success');
            endif;
        endif;

    }


}
