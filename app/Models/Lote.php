<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $fillable=[
        'lote',
        'frente',
        'fondo',
        'area',
        'm2',
        'total',
        'enganche',
        'saldo',
        'status',
        'coordenadas',
        'ext1',
        'ext2'
    ];
}
