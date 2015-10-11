<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuItems = Menu::all();
        $data = [
            'title' => Menu::$tableName,
            'menuItems' => $menuItems,
            'menuNames' => Menu::$fields,
        ];

        return view('admin.menu.menuList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.menuCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key'  => 'required|unique:menu|max:255',
            'name' => 'required',
            'sort' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect('admin/menu/create')
                ->withErrors($validator)
                ->withInput();
        }

        $menu = new Menu;

        $menu->key = $request->key;
        $menu->name = $request->name;
        $menu->sort = $request->sort;

        $menu->save();

        return redirect('admin/menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $menuItem = Menu::find($id);
//        dd($menuItem);
        $data = [
            'title' => Menu::$tableName,
            'menuItem' => $menuItem,
            'menuNames' => Menu::$fields,
        ];

        return view('admin.menu.menuEdit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'key'  => 'required|max:255',
            'name' => 'required',
            'sort' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect("admin/menu/edit/$id")
                ->withErrors($validator)
                ->withInput();
        }

        $menuItem = Menu::find($id);

        $menuItem->key  = $request->get('key');
        $menuItem->name = $request->get('name');
        $menuItem->sort = $request->get('sort');

        $menuItem->save();

        return redirect('admin/menu')->with('message', 'Обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        return redirect('admin/menu');
    }
}
