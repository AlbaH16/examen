<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ControlCarga extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblcontrolcarga';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_control_carga';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario',
        'anio',
        'total',
        'activo'];

    /**
     * Get the user that owns the ControlCarga
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
