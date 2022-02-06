<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xml extends Model
{
    use HasFactory;

    protected $table = "xmlfile";

    protected $fillable =
        [
            'id',
            'name'
        ];
}
