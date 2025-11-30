<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
 * @property string $patronymic
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
 * @property string status
 * @property string $password
 * @property Collection $patients
 * @property Collection $orders
 * @method static User find(int $id)
 * @method static where(string $value, int|string $criteria)
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

    public function patients(): HasMany
    {
        return $this->HasMany(Patient::class);
    }

    public function orders(): HasMany
    {
        return $this->HasMany(Order::class);
    }

    public function isMaster(): bool
    {
        return $this->role === UserRoles::MASTER->value;
    }

    public function getRole(): UserRoles
    {
        return UserRoles::tryFrom($this->role);
    }

    public function getStatus(): Status
    {
        return Status::tryFrom($this->status);
    }
}

