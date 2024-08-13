<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'title', 'thumbnail', 'description', 'tag', 'repository', 'website'
    ];

    protected $casts = [
        'tag' => 'array',
        'thumbnail' => 'array'
    ];
}
