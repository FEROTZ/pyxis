<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use App\Models\Menu;
use App\Models\Producto;
use App\Models\ProductoImagen;
use App\Models\Sub_categoria;
use Database\Seeders\ClasificacionTableSeeder;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $imagenes = ProductoImagen::where('destacado',true)->get();
        return view('welcome')->with(compact("imagenes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($clasificacion,$productoSlug)
    {
        $productos = Menu::all();
        $servicio = collect();
        $imagenesP = collect();
        foreach ($productos as $elemento){
            if ($elemento->slug==$productoSlug){
                $servicio=$elemento;
            foreach ($elemento->imagenes as $imagen){
                    if ($imagen->destacado == false){
                        $imagenesP->push($imagen);
                    }
                }

            }

        }

        return view("cliente.productos.show")->with(compact("servicio","imagenesP"));
    }

    public function showSubcategoria($clasificacionSlug,$productoSlug,$categoriaSlug,$subcategoriaSlug)
    {

        $subcategorias=Menu::all();
        $subcategoria = collect();
        foreach ($subcategorias as $elemento){
            if ($elemento->slug==$subcategoriaSlug){
                $subcategoria=$elemento;
            }
        }
        return view("cliente.sub_categoria.show")->with(compact("subcategoria"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
