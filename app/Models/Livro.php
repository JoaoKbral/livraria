<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    protected $fillableLivro = ['titulo','idioma','ano','isbn', 'capa','editora_id'];

    public function midia(){
        return $this->hasOne(Midia::class);
    }

    public function editora()
    {
        return $this->belongsTo(Editoras::class);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function autores(){
        return $this->hasMany(Autores::class);
    }
}
