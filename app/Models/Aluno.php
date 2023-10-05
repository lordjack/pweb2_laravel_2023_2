<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = "aluno";

    protected $fillable = ['nome',
        'data_nascimento',
        'cpf',
        'email',
        'telefone',
        'categoria_aluno_id',
        'imagem',
    ];

    protected $casts = [
        'data_nascimento'=>'datetime:Y-m-d',
        'categoria_aluno_id'=> "integer"
    ];

    public function matricula(){
        //relacionamento 1 - n (um para n)
        return $this->hasMany(Matricula::class,'aluno_id');
    }

    public function categoria(){
        //relacionamento 1 - 1 (um para um)
        return $this->belongsTo(CategoriaAluno::class,
            'categoria_aluno_id','id');
    }

    //listar todas as turmas que o aluno esta matriculado
    public function turmas(){
        //relacionamento n - n (muito para muito)
        return $this->belongsToMany(Turma::class,
            'matricula','aluno_id','turma_id');
    }

}
