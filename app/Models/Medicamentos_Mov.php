<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamentos_Mov extends Model
{
    
    protected $table = 'medicamentos_mov';

    public $timestamps = false;

    protected $guarded;

    public function medicamento()
    {
        return $this->belongsTo(Medicamentos::class, 'medicamento_id', 'id');
    }

}
