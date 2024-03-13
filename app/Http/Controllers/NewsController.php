<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::where('is_url_valid', true)
                    ->orderByRaw('ifnull(news.published_date, news.edit_date) desc')
                    ->get();
        return responder()->success($news)->respond();
    }

    public function store(Request $request)
    {
        $request->validate([
            'posts' => 'required|array',
            'posts.*.title' => 'string',
            'posts.*.link' => 'required|string',
            'posts.*.img_link' => 'string',
            'posts.*.published_date' => 'string|nullable',
            'posts.*.edit_date' => 'string|nullable',
            'posts.*.is_url_valid' => 'boolean',
        ]);

        $news_list = $request->input('posts');

        foreach ($news_list as $index => $news){
            if (!array_key_exists('published_date', $news)){
                $news_list[$index]['published_date'] = null;
            }

            if (!array_key_exists('edit_date', $news)){
                $news_list[$index]['edit_date'] = null;
            }

            if (!$news_list[$index]['published_date'] && !$news_list[$index]['edit_date']){
                $news_list[$index]['is_url_valid'] = false;
            }
        }

        News::upsert(
            $news_list,
            ['link'],
            ['title', 'img_link', 'published_date', 'edit_date', 'is_url_valid']
        );

        return responder()->success()->respond();
    }

    public function update_url_validity(Request $request)
    {
        $request->validate([
            'links' => 'required|array',
            'links.*.link' => 'required|string',
            'links.*.is_url_valid' => 'required|boolean',
        ]);

        $news_links = $request->input('links');

        News::upsert(
            $news_links,
            ['link'],
            ['is_url_valid']
        );

        return responder()->success()->respond();
    }
}
