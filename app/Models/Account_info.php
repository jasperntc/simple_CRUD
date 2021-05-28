<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account_info extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'name', 'gender', 'birthdate', 'email', 'notes'];
}
