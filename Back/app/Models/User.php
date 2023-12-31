<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Stage;
use App\Models\Program;
use App\Models\Department;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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
    ];

    // relationships
    /**
     * one-to-many relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        return $this->role->slug == $role;
    }

    /**
     * one-to-many relationship
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function hasStage($stage)
    {
        return $this->stage->slug == $stage;
    }

    /**
     * one-to-many relationship
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * one-to-many relationship
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * many-to-many relationship
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')
            ->withPivot('is_paid', 'course_type_id')
            ->withTimestamps();
    }
}
