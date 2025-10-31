<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupJualBeliCard extends Model
{
    use HasFactory;

    protected $table = 'grup_jual_beli_cards';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'link',
        'order',
    ];
}
