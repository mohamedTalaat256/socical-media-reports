<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'link',
        'source',
        'type',
        'creator_name',
        'creator_image',
        'creator_link',
        'short_desc',
        'long_desc',
        'images',
        'screenshots',
        'keyword',
        'related_to',
        'user',
        'status',
        'complain_status',
     ];


}
