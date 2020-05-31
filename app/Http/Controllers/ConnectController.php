<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth;
use App\User;



class ConnectController extends Controller
{

    # Esta funcion requiere que el usuario no este logueado, en caso de estar logueado no podremos ejecutar los metodos.
    # El metodo getLogout si podemos ejecutarlo porque tiene el except delante. Es logico, ya que si estamos logueados,
    #   deberiamos poder desloguearnos. Y si no agregamos esta excepcion no podriamos ejecutar getLogout una ves que 
    #   estemos logueados.
    # Este middleware se ejecutara cada ves que se ejecute un metodo de ConnectController.php
    public function __construct(){
        $this->middleware('guest')->except(['getLogout']);
    }

    public function getLogin(){
        return view('connect.login');
    }

    # Una ves ingresados los datos en el formulario de login, llegan el email y la password a postLogin a travez de
    #   la variable $request
    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        $messages = [
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es inválido.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert','danger');
        else:
            # Aca validamos que los datos del usuario ingresados en el form sean correctos.
            # Si no son correctos redireccionamos nuevamente al formulario de login.
            # Se comparan los datos ingresados en el formulario login con los datos de la base de datos.
            # El para metro true es para que la sesion quede conectada por un determinado tiempo.
            if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)):
                return redirect('/');
            else:
                return back()->with('message', 'Error de autenticación. Usuario o contraseña incorrecta!')->with('typealert','danger');

            endif;
        endif;


    }

    public function getRegister(){
        return view('connect.register');
    }


    #Validador para el formulario.
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

        # Validator obtiene valor True o False segun el resultado de la validacion de los campos.
        # Si da False quiere decir que falló, y vuelve atras,
        # Si da True, guarda la info en la base de datos.
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert','danger');
        else:
            $user = new User;
            # La e() es para encodear los datos, y que no entren scripts dañinos por nuestro form.
            # Hash es para encriptar la contraseña.
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

    # Este metodo es para cerrar la sesion del usuario
    public function getLogout(){
        Auth::logout();
        return redirect('/');

    }

}
