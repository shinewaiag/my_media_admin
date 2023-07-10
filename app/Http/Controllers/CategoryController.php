<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page
    public function index() {
        $category = Category::get();
        return view('admin.category.index', compact('category'));
    }

    //create category page
    public function createCategory(Request $request){
        $this->categoryValidationCheck($request);
        $categoryData = $this->getCategoryData($request);
        Category::create($categoryData);
        return back()->with(['createSuccess' => 'Category created successfully']);

    }

    //delete category data
    public function deleteCategory($id){
       Category::where('category_id', $id)->delete();
       return back()->with(['deleteSuccess' => 'Category deleted successfully']);
    }

    //search category data
    public function searchCategory(Request $request){
        $category = Category::orWhere('title', 'LIKE', '%'.$request->categoryKey.'%')
                    ->orWhere('description', 'LIKE', '%'.$request->categoryKey.'%')
                    ->get();
        return view('admin.category.index', compact('category'));
    }

    //direct category edit page
    public function categoryEditPage($id) {
        $category = Category::get();
        $updateCategory = Category::where('category_id', $id)->first();
        return view('admin.category.edit', compact('category', 'updateCategory'));
    }

    //update category data
    public function updateCategory(Request $request, $id){
        $this->categoryValidationCheck($request);
        $category = $this->getCategoryData($request);
        Category::where('category_id',$id)->update($category);
        return redirect()->route('admin#category');
    }

    //get category data
    private function getCategoryData($request) {
        return [
            'title' => $request->categoryName,
            'description' => $request->desc,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //category validation check
    private function categoryValidationCheck($request) {
        Validator::make($request->all(),[
            'categoryName' => 'required|min:5',
            'desc' => 'required|min:5',
        ])->validate();
    }

}
