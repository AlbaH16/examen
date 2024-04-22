<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bitacora extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblbitacoras';

    /**
     * Get the accion that owns the Bitacora
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accion(): BelongsTo
    {
        return $this->belongsTo(Accion::class, 'cve_accion','cve_accion');
    }

    /**
     * Get the usuario that owns the Bitacora
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
