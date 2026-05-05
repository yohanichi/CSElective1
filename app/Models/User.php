<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'account_type',
        'created_on',
        'created_by',
        'updated_on',
        'updated_by',
    ];

    public function isAdminStaff(): bool
    {
        return $this->account_type === 'staff';
    }


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Disable remember token behavior for this model.
     */
    public function getRememberTokenName()
    {
        return null;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_on' => 'datetime',
        'updated_on' => 'datetime',
    ];

    /**
     * Determine if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->account_type === 'admin';
    }

    /**
     * Determine if user can manage programs and subjects.
     */
    public function canManageSubjectsPrograms(): bool
    {
        return in_array($this->account_type, ['admin', 'staff'], true);
    }

    /**
     * Relationship to the user who created this user.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship to the user who last updated this user.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
