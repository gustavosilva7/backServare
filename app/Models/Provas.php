<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'questoes_id',
        'questoes_quantidade',
    ];
}
