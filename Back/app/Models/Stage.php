<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name'];

    /**
     *  many-to-one relationship
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
