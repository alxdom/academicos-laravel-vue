<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curso extends Model
{
    use HasFactory;

    public $table = "cursos";
    protected $fillable = array("*");
    public $timestamp = true;

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, "curso_estudiantes");
    }
}
