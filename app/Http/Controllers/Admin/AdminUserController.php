<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(12);
        $viewData = [
            'users'   =>  $users
        ];
        return view('admin.user.index',$viewData);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) $user->delete();
        return redirect()->back();
    }
}
