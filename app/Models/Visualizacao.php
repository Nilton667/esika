<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visualizacao extends Model
{
    use HasFactory;
    protected $table = 'visualizacaos';
    protected $fillable = ['user_id', 'documento_id'];

}
