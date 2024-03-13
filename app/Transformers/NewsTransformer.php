<?php

namespace App\Transformers;

use App\Models\News;
use Flugg\Responder\Transformers\Transformer;

class NewsTransformer extends Transformer
{
    public function transform(News $news): array
    {
        return [
            'title' => $news->title,
            'link' => $news->link,
            'img_link' => $news->img_link,
            'published_date' => $news->published_date,
            'edit_date' => $news->edit_date,
        ];
    }
}
