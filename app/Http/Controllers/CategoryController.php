<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(15);

        $response = [
            'message' => 'success',
            'categories' => $categories
        ];

        return response()->json($response, 200);
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
            'name' => 'required',
            'order' => 'nullable'
        ]);

        $category = Category::create($data);

        $response = [
            'message' => 'success',
            'category' => $category
        ];

        return response()->json($response);
    }

    
}
