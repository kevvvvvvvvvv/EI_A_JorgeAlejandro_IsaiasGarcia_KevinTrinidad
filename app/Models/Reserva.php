<?php

namespace App\Models;


use MongoDB\Laravel\Eloquent\Model;

/**
 * Class Reserva
 *
 * @property $id
 * @property $fechaR
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reserva extends Model
{
    protected $connection = 'mongodb';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fechaR', 'estado', 'correo', 'nombre'];


}
