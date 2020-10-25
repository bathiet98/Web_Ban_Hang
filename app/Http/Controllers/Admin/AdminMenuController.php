<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestMenu;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::paginate(12);
        return view('admin.menu.index',compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(AdminRequestMenu $request)
    {
        $data = $request->except('_token');
        $data['mn_slug'] = Str::slug($request->mn_name);
        $data['created_at'] = Carbon::now();
        $id = Menu::insertGetId($data);

        return redirect()->route('admin.menu.index');
    }


    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('admin.menu.update',compact('menu'));
    }

    public function update(AdminRequestMenu $request, $id)
    {
        $menu = Menu::find($id);
        $data = $request->except('_token');
        $data['mn_slug'] = Str::slug($request->mn_name);
        $data['updated_at'] = Carbon::now();
        $menu -> update($data);

        return redirect()->route('admin.menu.index');
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        if ($menu) $menu->delete();
        return redirect()->back();
    }

    public function active($id)
    {
        $menu = Menu::find($id);
        $menu->mn_status =! $menu->mn_status;
        $menu->save();
        return redirect()->back();
    }

    public function hot($id)
    {
        $menu = Menu::find($id);
        $menu->mn_hot =! $menu->mn_hot;
        $menu->save();
        return redirect()->back();
    }
}
