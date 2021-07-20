<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'username';
    protected $fillable = [
        'username',
        'nama',
        'password',
    ];
}
