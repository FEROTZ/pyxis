<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public function padre()
    {
        return $this->belongsTo(Menu::class);
    }
    public function menus()
    {
        return $this->hasMany(Menu::class, 'padre_id');
    }
    public function getImagenProducto1Attribute(){
        $imagen1 = $this->imagen;
        if ($imagen1){
            return '/img/productos/'.$imagen1;
        }
    }
    public function getImagenProducto2Attribute(){
        $imagen2 = $this->imagen2;
        if ($imagen2){
            return '/img/productos/'.$imagen2;
        }
    }
    public function imagenes(){
        return $this->hasMany(ProductoImagen::class);
    }

    public function getStatusStringAttribute() {
        if($this->status){
            return 'Activo';
        }else{
            return 'Inactivo';
        }
    }
}
