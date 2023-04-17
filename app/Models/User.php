<?php

namespace App\Models;


use Illuminate\Auth\Authenticatable as IlluminateAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class User extends Model implements Authenticatable
{
    use SoftDeletes;
    use IlluminateAuthenticatable;

    protected $dates = ['last_login_at'];

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nom',
        'prenom',
        'genre',
        'email',
        'telephone',
        'password',
        'active',
        'last_login_at',
        'last_login_ip',
        'count_login',
        'prestataire_id',
        'compagnie_id'
    ];
    //protected $guarded = ['id'];

    public function soins(){
        return $this->hasMany(Soin::class);
    }

    public function getRememberTokenName()
    {
        return '';
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->id = (string) Str::uuid();
        });
    }
}
