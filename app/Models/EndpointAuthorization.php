<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndpointAuthorization extends Model
{
    /**
     * Relacionamento com frontend (join)
     */
    public function frontend()
    {
        return $this->belongsTo(Frontend::class, 'id_frontend');
    }
}
