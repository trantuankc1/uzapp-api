<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;


    protected $table = 'users';

    protected $fillable = [
        'open_id',
        'first_name',
        'first_kana_name',
        'last_name',
        'last_kana_name',
        'person_name',
        'zipcode',
        'state',
        'city',
        'town',
        'address',
        'phone',
        'email',
        'mail_flag',
        'password',
        'birthday',
        'gender',
        'hobby',
        'status',
        'email_verified_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [
            "guard" => "api"
        ];
    }


    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'open_id', 'open_id');
    }

    /**
     * @return BelongsTo
     */
    public function transactionProduct(): BelongsTo
    {
        return $this->belongsTo(TransactionProduct::class, 'open_id', 'id');
    }

}
