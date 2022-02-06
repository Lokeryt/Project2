<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vac extends Model
{
    use HasFactory;

    protected $table = "vacs";

    protected $fillable =
        [
            'id',
            'post',
            'type',
            'salary',
            'amount',
            'external_id'
        ];
}
