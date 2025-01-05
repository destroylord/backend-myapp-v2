<?php

namespace App\Models;

use App\ArchivementCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'link',
        'category'
    ];

    protected $casts = [
        'category' => ArchivementCategory::class,
    ];

}
