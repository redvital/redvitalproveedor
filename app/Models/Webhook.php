<?php

namespace App\Models;

use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use HasFactory, ApiResponse;
    
    const APROBADO = 1;

    protected $fillable = ['id','body','procesado'];

}
