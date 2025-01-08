<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(15);

        // $response = [
        //     'message' => 'success',
        //     'categories' => $categories
        // ];

        return NewsResource::collection($news);
    }

    public function show(News $news)
    {
        // $response = [
        //     'message' => 'success',
        //     'News' => $news
        // ];

        // return response()->json($response);
        return new NewsResource($news);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|integer',
            'title_uz' => 'required',
            'title_ru' => 'required',
            'title_en' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
        ]);

        $news = News::create([
            'category_id' => $data['category_id'],
            'title' => [
                'uz' => $data['title_uz'],
                'ru' => $data['title_ru'],
                'en' => $data['title_en'],
            ],
            'description' => [
                'uz' => $data['description_uz'],
                'ru' => $data['description_ru'],
                'en' => $data['description_en'],
            ],
        ]);

        // $response = [
        //     'message' => 'success',
        //     'News' => $news
        // ];

        // return response()->json($response);
        return new NewsResource($news);
    }

    public function update(Request $request, News $news)
    {
        // dd($request->all(), $News);
        $data = $request->validate([
            'category_id' => 'required|integer',
            'title_uz' => 'required',
            'title_ru' => 'required',
            'title_en' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'required',
        ]);

        $news->update([
            'category_id' => $data['category_id'],
            'title' => [
                'uz' => $data['title_uz'],
                'ru' => $data['title_ru'],
                'en' => $data['title_en'],
            ],
            'description' => [
                'uz' => $data['description_uz'],
                'ru' => $data['description_ru'],
                'en' => $data['description_en'],
            ],
        ]);
        // dd($News);
        // return response()->json($response);
        return new NewsResource($news);
    }

    public function destroy(News $news)
    {
        $news->delete();

        return response()->json([
            'message' => 'News successfully deleted!'
        ]);
    }
}
