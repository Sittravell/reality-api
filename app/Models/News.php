<?php

namespace App\Models;

use App\Transformers\NewsTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Model;

class News extends Model implements Transformable
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'link',
        'img_link',
        'time',
        'is_url_valid',
    ];


    public function transformer()
    {
        return NewsTransformer::class;
    }
}
