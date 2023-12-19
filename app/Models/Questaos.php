<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questaos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'assunto',
        'enunciado',
        'imagem',
        'dificuldade',
        'materia_questao',
    ];
}
