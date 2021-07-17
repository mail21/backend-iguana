<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;
    public $table = "gejala";
    protected $primaryKey = 'id_gejala';
    protected $fillable = [
        'id_penyakit'.
        'desc_gejala'.
        'desc_kuesioner'.
    ];
}
