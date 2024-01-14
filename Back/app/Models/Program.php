<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'max_semester'];

    /**
     *  many-to-one relationship
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'departments_programs')
            ->withPivot('semester_number')
            ->withTimestamps();
    }
}
