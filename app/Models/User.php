<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblusuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'password',
        'nombre',
        'paterno',
        'materno',
        'activo',
        'cve_grupo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Get the grupo_sistema that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grupo_sistema(): BelongsTo
    {
        return $this->belongsTo(GrupoSistema::class, 'cve_grupo');
    }

    /**
     * Get all of the bitacoras for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bitacoras(): HasMany
    {
        return $this->hasMany(Bitacora::class, 'id_usuario', 'id');
    }

    /**
     * Get all of the solicitudes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes(): HasMany
    {
        return $this->hasMany(Solicitud::class, 'id_usuario_asignado', 'id');
    }

    /**
     * Get all of the control_carga for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function control_carga(): HasMany
    {
        return $this->hasMany(ControlCarga::class, 'id_usuario', 'id');
    }
}
