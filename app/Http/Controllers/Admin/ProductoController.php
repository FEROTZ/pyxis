<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Clasificacion;
use App\Models\Menu;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageIntervention;
use File;

class ProductoController extends Controller
{

    public function index()
    {
        //Laravel Eloquent es un motor "orm" permite manejar base de datos en objeto, entidades, etc.
        $productos = Menu::all();
        return view("admin.productos.show")->with(compact("productos"));
    }
    public function create()
    {
        $clasificaciones = Menu::all();
        return view("admin.productos.create")->with(compact("clasificaciones"));
    }

    //Guardar el producto en la base de datos
    public function store(Request $request)
    {
        $validated=$request->validate([
           'nombre' => 'nullable|unique:menus|max:40',
            'introduccion' => 'nullable|max:1000',
            'descripcion' => 'nullable|max:1000',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jfif|max:2048',
            'contenido' => 'nullable|max:1000',
            'diferenciadores' => 'nullable|max:1000',
            'imagen2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jfif|max:2048',
            'status' => 'nullable',
            'carac_adi' => 'nullable|max:1000',
            'info_adi' => 'nullable|max:1000',
        ]);


        $producto = new Menu();
        $producto->nombre = $request->nombre;
        $producto->introduccion = $request->introduccion;
        $producto->descripcion = $request->descripcion;
        $producto->contenido = $request->contenido;
        $producto->diferenciadores = $request->diferenciadores;
        $producto->status = $request->status;
        $producto->carac_adi = $request->carac_adi;
        $producto->info_adi = $request->info_adi;
        $producto->padre_id = $request->clasificacion;
        $producto->slug = Str::slug($request->nombre);
        if ($request->imagen) {
            $image = $request->imagen;
            $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
            $imageResize = ImageIntervention::make($image)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $simplePath = 'img/productos';
            $path = 'img/productos/' . $imageName;
            if ($imageResize->save($path, 100, 'webp')) {
                $producto->imagen = $imageName;
            }
        }
        if ($request->imagen2) {
            $image = $request->imagen2;
            $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
            $imageResize = ImageIntervention::make($image)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $simplePath = 'img/productos';
            $path = 'img/productos/' . $imageName;
            if ($imageResize->save($path, 100, 'webp')) {
                $producto->imagen2 = $imageName;
            }
        }


        $producto->save();



        if ($request->file('imagenes')) {
            foreach ($request->file('imagenes') as $image){
            $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
            $imageResize = ImageIntervention::make($image)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $simplePath = 'img/productos';
            $path = 'img/productos/' . $imageName;
            if ($imageResize->save($path, 100, 'webp')) {
                $productoImagen = new ProductoImagen();
                $productoImagen->imagen = $imageName;
                $productoImagen->menu_id = $producto->id;
                $productoImagen->save();
            }
        }
        }

        if ($request->file('bienvenida')) {
            $image = $request->bienvenida;
            $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
            $imageResize = ImageIntervention::make($image)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $simplePath = 'img/productos';
            $path = 'img/productos/' . $imageName;
            if ($imageResize->save($path, 100, 'webp')) {
                $productoImagen = new ProductoImagen();
                $productoImagen->imagen = $imageName;
                $productoImagen->menu_id = $producto->id;
                $productoImagen->destacado = true;
                $productoImagen->carrusel = true;
                $productoImagen->save();
            }
        }
        $guardado = "El producto a sido guardado correctamente";
        return (redirect('admin/productos')->with(compact('guardado')));
    }
    //Mostrar cada uno de los productos
    public function show($id)
    {

    }


    //Mostrar el formulario para editar los productos
    public function edit($id)
    {
        $producto = Menu::find($id);
        $clasificaciones = Menu::all();
        $imagenDestacada = ProductoImagen::where('destacado', true)->where('menu_id', $id)->get();
        $imagenDestacada = $imagenDestacada->count() > 0;
        return view("admin.productos.edit")->with(compact("producto","clasificaciones", "imagenDestacada"));
    }


    //Actualizar los productos
    public function update(Request $request, $id)
    {
        $producto = Menu::find($id);
        $producto->nombre = $request->nombre;
        $producto->introduccion = $request->introduccion;
        $producto->descripcion = $request->descripcion;
        $producto->contenido = $request->contenido;
        $producto->diferenciadores = $request->diferenciadores;
        $producto->status = $request->status;
        $producto->carac_adi = $request->carac_adi;
        $producto->info_adi = $request->info_adi;
        $producto->padre_id = $request->clasificacion;
        $producto->slug = Str::slug($request->nombre);


        $simplePath = 'img/productos';
        if ($request->imagen) {
            if ($producto->imagen){
                File::delete($simplePath.$producto->imagen);
            }
            $image = $request->imagen;
            $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
            $imageResize = ImageIntervention::make($image)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $path = 'img/productos/' . $imageName;
            if ($imageResize->save($path, 100, 'webp')) {
                $producto->imagen = $imageName;
            }
        }
        if ($request->imagen2) {
            if ($producto->imagen2){
                File::delete($simplePath.$producto->imagen2);
            }
            $image = $request->imagen2;
            $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
            $imageResize = ImageIntervention::make($image)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $path = 'img/productos/' . $imageName;
            if ($imageResize->save($path, 100, 'webp')) {
                $producto->imagen2 = $imageName;
            }
        }


        $producto->save();

        if ($request->destacado != true){
            $imagenDestacada = ProductoImagen::where('carrusel', true)->where('menu_id', $producto->id)->first();
            if($imagenDestacada){
                $imagenDestacada->destacado = false;
                $imagenDestacada->save();
            }

        } else{
            $imagenDestacada = ProductoImagen::where('carrusel', true)->where('menu_id', $producto->id)->first();
            $imagenDestacada->destacado = true;
            $imagenDestacada->save();
        }

        if ($request->file('imagenes')) {
            $simplePath = 'img/productos';
            foreach ($producto->imagenes as $imagen){
                File::delete($simplePath.$imagen);
            }
            $producto->imagenes()->delete();
            foreach ($request->file('imagenes') as $image){
                $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
                $imageResize = ImageIntervention::make($image)
                    ->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                $path = 'img/productos/' . $imageName;
                if ($imageResize->save($path, 100, 'webp')) {
                    $productoImagen = new ProductoImagen();
                    $productoImagen->imagen = $imageName;
                    $productoImagen->menu_id = $producto->id;
                    $productoImagen->save();
                }

            }
        }

        if ($request->bienvenida) {
            $bienvenida = ProductoImagen::where('destacado', true)->where('menu_id', $producto->id)->first();
            if ($bienvenida){
                File::delete($simplePath.$bienvenida->imagen);
                $bienvenida->delete();
            }
            $image = $request->bienvenida;
            $imageName = uniqid() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '.webp';

//Intervention Image
            $imageResize = ImageIntervention::make($image)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $path = 'img/productos/' . $imageName;
            if ($imageResize->save($path, 100, 'webp')) {
                $bienvenida = new ProductoImagen();
                $bienvenida->imagen = $imageName;
                $bienvenida->destacado = true;
                $bienvenida->menu_id = $producto->id;
                $bienvenida->save();
            }
        }


        $guardado = "El producto a sido modificado correctamente";
        return (redirect('admin/productos')->with(compact('guardado')));
    }





    //Eliminar el producto
    public function destroy($id)
    {
        $producto = Menu::find($id);
        $producto->imagenes()->delete();
        $producto->delete();
    }
}
