<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use App\Http\Models\Product;
use Validator, Str, Config;


class ProductController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getHome(){
        return view('admin.products.home');
    }

    public function getProductAdd(){
        // El metodo pluck es para convertir el json en un array
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }

    // Este metodo es para guardar un producto nuevo en la base de datos, y claramente,
    //  debe llevar una validacion para ver que todo este bien.
    public function postProductAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];

        $message = [
            'name.required' => 'El nombre del producto es requerido',
            'img.required' => 'Seleccione una imagen',
            // 'img.image' => 'El archivo no es una imagen',
            'price.required' => 'El precio del producto es requerido',
            'content.required' => 'Se necesita descripcion del producto'
        ];

        // Hace la validacion.
        $validator = Validator::make($request->all(), $rules, $message);
        // Comprueba si la validacion es aprobada o no.
        // El metodo withInput() es para que guarde los valores en los imput al volver atras.
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error!!')->with(
                'typealert', 'danger')->withInput(); 
        else:
            // Sistema de archivos de Laravel
            // Aqui se guardaran las imagenes
            $path = '/'.date('Y-m-d'); //2020-02-14
            // trim() elimina espacios en blanco al inicio y final de la cadena
            // getClientOriginalExtension() extrae la extension del archivo
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            // Configuracion en config/filesystems.php
            $upload_path = Config::get('filesystems.disk.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            

            // Nota: los nombres status, name, slug, category_id, img, price y content los sacamos de
            //  los input del formulario.
            $product = new Product;
            $product->status = '0'; 
            // La funcion e() es para que no puedan enviar scripts maliciosos por el formulario.
            $product->name = e($request->input('name'));
            // El campo slug no es necesario pasarlo por la funcion e().
            $product->slug = Str::slug($request->input('slug'));
            $product->category_id = $request->input('category');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            // Llamamos al metodo save(),
            // Si se guarda sin error, redirecciona a /admin/products con el mensaje de éxito.
            // Si da algun error
            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                endif;
                return redirect ('/admin/products')->with('message', 'Guardado con éxito!!')->with('typealert', 'success');
            endif;
        endif;

        

    }

}

    