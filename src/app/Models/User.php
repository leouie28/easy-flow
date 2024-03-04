<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'password',
        'pin',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'pin',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'pin' => 'hashed'
    ];

    protected $appends = [
        'active_workspace'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class)->withTimestamps()->withPivot(['role', 'active', 'disabled']);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function budgetTransactions()
    {
        return $this->hasMany(BudgetTransaction::class);
    }

    public function transactionTypes()
    {
        return $this->hasMany(TransactionType::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function getActiveWorkspaceAttribute()
    {
        $user = auth()->user();
        return $user->workspaces()->where('active', true)->first();
    }
}
