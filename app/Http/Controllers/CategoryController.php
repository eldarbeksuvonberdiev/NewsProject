<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(15);

        // $response = [
        //     'message' => 'success',
        //     'categories' => $categories
        // ];

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        $response = [
            'message' => 'success',
            'category' => $category
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_en' => 'required',
            'order' => 'nullable|integer'
        ]);

        $category = Category::create([
            'name' => [
                'uz' => $data['name_uz'],
                'ru' => $data['name_ru'],
                'en' => $data['name_en'],
            ],
            'order' => $data['order']
        ]);

        // $response = [
        //     'message' => 'success',
        //     'category' => $category
        // ];

        // return response()->json($response);
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        // dd($request->all(), $category);
        $data = $request->validate([
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_en' => 'required',
            'order' => 'nullable|integer'
        ]);

        $category->update([
            'name' => [
                'uz' => $data['name_uz'],
                'ru' => $data['name_ru'],
                'en' => $data['name_en'],
            ],
            'order' => $data['order']
        ]);
        // dd($category);
        // return response()->json($response);
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category successfully deleted!'
        ]);
    }
}
