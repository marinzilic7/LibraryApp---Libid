<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    protected $fillable = ['ime', 'prezime', 'email', 'password', 'uloga'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    use HasFactory;
}
