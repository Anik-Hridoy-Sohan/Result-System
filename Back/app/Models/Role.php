<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['slug'];

    /**
     * many-to-one relationship
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
