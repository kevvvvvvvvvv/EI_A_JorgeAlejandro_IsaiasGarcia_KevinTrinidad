<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Class Salon
 *
 * @property $id
 * @property $nombre
 * @property $direccion
 * @property $precio
 * @property $capacidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Publicacion[] $publicacions
 * @property Reserva[] $reservas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Salon extends Model
{
    protected $connection = 'mongodb';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'direccion', 'precio', 'capacidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publicacions()
    {
        return $this->hasMany(\App\Models\Publicacion::class, 'id', 'ids');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservas()
    {
        return $this->hasMany(\App\Models\Reserva::class, 'id', 'ids');
    }
    

}
