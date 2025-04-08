<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Class Publicacion
 *
 * @property $id
 * @property $titulo
 * @property $descripcion
 * @property $fechaP
 * @property $contacto
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Publicacion extends Model
{
    protected $connection = 'mongodb';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['titulo', 'descripcion', 'fechaP', 'contacto', 'nombre'];


}
