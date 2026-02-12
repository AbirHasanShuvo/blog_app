<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'thumbnail',
        'status',
        'published_at'
    ];
}
