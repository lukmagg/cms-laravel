<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use App\Http\Models\Product;
use Validator, Str, Config, Image;


class ProductController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getHome(){
        // Llamada a base de datos
        $products = Product::orderBy('id', 'desc')->paginate(25);
        $data = ['products' => $products];
        return view('admin.products.home', $data);
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
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            // Ruta absoluta al archivo guardado
            $final_file = $upload_path.'/'.$path.'/'.$filename;
            

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
            $product->file_path = date('Y-m-d');
            // Llamamos al metodo save(),
            // Si se guarda sin error, redirecciona a /admin/products con el mensaje de éxito.
            // Si da algun error
            if($product->save()):
                // Consulto si hay un archivo con el nombre 'img' en la peticion
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    // fit() permite crear una miniatura con ciertos parametros
                    $img->fit(64, 64, function($constraint){
                        $constraint->upsize();
                    });
                    // '/t_' es solo un prefijo al nombre de la imagen
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                return redirect ('/admin/products')->with('message', 'Guardado con éxito!!')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getProductEdit($id){
        $p = Product::find($id);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'p' => $p];
        return view('admin.products.edit', $data);
    }

}

    