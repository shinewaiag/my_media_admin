<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get categories
    public function categories() {
        $Category = Category::select('category_id', 'title', 'description')->get();
        return response()->json([
           'categories' => $Category
        ]);
    }

    //serach categories
    public function search(Request $request) {
        $category = Category::select('posts.*')
                            ->join('posts', 'categories.category_id', 'posts.category_id')
                            ->where('categories.title', 'LIKE', '%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $category,
        ]);
    }


}
