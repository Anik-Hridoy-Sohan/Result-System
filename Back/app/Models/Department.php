<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'department_code',
        'status',
        'chairman_id',
    ];

    /**
     *  many-to-one relationship
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
