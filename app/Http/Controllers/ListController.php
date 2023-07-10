<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct list page
    public function index() {
        $userDatas = User::select('id', 'name', 'phone', 'email', 'address', 'gender')->get();
        return view('admin.list.index', compact('userDatas'));
    }

    //delete admin list
    public function delete($id) {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Account deleted successfully']);
    }

    //search admin list
    public function search(Request $request) {
        $userDatas = User::orWhere('name','LIKE', '%'.$request->adminSearchKey.'%')
                     ->orWhere('email','LIKE', '%'.$request->adminSearchKey.'%')
                     ->orWhere('phone','LIKE', '%'.$request->adminSearchKey.'%')
                     ->orWhere('address','LIKE', '%'.$request->adminSearchKey.'%')
                     ->orWhere('gender','LIKE', '%'.$request->adminSearchKey.'%')
                     ->get();
        return view('admin.list.index', compact('userDatas'));;
    }
}
