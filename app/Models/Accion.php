<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblacciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cve_accion','descripcion','activo'];

    /**
     * Get all of the bitacoras for the Accion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bitacoras(): HasMany
    {
        return $this->hasMany(Bitacora::class, 'cve_accion', 'cve_accion');
    }
}
