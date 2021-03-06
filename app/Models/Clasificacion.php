<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    use HasFactory;
    protected $table = "clasificaciones";
    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
