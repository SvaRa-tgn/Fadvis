<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\MessengerType;
use App\Enum\Status;
use App\Enum\UserRoles;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property ?string $patronymic
 * @property string $slug
 * @property string $role
 * @property string $email
 * @property string $phone
 * @property ?string $site
 * @property string $messenger
 * @property string $organization
 * @property string $address
 * @property ?string $inn
 * @property ?string $ogrn
 * @property string $status
 * @property string $password
 * @property Collection $patients
 * @property Collection $orders
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** @var array<int, string> */
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'slug',
        'email',
        'phone',
        'site',
        'messenger',
        'organization',
        'address',
        'inn',
        'ogrn',
        'role',
        'password',
    ];

    /** @var array<int, string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role'              => UserRoles::class,
        'status'            => Status::class,
        'messenger'         => MessengerType::class
    ];

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

