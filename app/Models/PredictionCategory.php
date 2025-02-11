<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class PredictionCategory extends Model
{
    use HasSEO;

    protected $fillable = [
        'name',
        'type'
    ];
}
