<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editoras extends Model
{
    use HasFactory;
    protected $filableEditora = ['nome','local','email','capa'];
}
