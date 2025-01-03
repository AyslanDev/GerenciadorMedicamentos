<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamentos extends Model
{
    use HasFactory;

    // Defina o nome da tabela explicitamente, caso não siga a convenção do Laravel
    protected $table = 'medicamentos';

    // Caso o nome da tabela tenha campos como 'created_at' ou 'updated_at' e você tenha removido esses campos,
    // defina o valor como falso para desabilitar o gerenciamento automático dessas colunas
    public $timestamps = true;

    // Defina os campos que podem ser preenchidos em massa
    protected $guarded;

    public function movimentacoes()
    {
        return $this->hasMany(Medicamentos_Mov::class, 'id', 'medicamento_id');
    }

  
}
