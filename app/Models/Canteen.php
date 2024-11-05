<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Canteen extends Model
{
    use HasFactory;

    protected $table = 'canteen_transaction';

    protected $fillable = [
        'badgenumber',
        'type',
        'time'
    ];

    public $timestamps = true;
}
