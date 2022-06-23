<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    protected $fillableLivro = ['titulo','idioma','ano','isbn', 'capa'];

    public function midia(){
        return $this->hasOne(Midia::class);
    }
}
