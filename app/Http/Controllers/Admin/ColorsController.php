<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use File;

class ColorsController extends Controller
{
    public $key = 'colors';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Color::all();
        $data = [
            'route' => $this->key,
            'title' => Color::$tableName,
            'items' => $items,
//            'pagesFields' => Category::$fields,
        ];

        return view("admin.$this->key.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
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
            'name'  => 'required|max:255',
            'image' => "required|mimes:jpeg,bmp,png",
        ]);

        if ($validator->fails()) {
            return redirect("admin/$this->key/create")
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $item = new Color();
        $item->name = $request->name;

        $image = $request->image;
        $filename  = time() . '.' . $image->getClientOriginalExtension();//Имя файла
        $path = 'img/color/' . $filename;//Путь файла
        Image::make($image->getRealPath())->save($path);
        $item->image = $path;

        $item->save();

        return redirect("admin/$this->key");
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
        $item = Color::find($id);
        $data = [
            'title' => Color::$tableName,
            'item' => $item,
//            'pagesFields' => Category::$fields,
        ];

        return view("admin.$this->key.edit", $data);
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
            'name'  => 'required|max:255',
            'image' => "mimes:jpeg,bmp,png",
        ]);

        if ($validator->fails()) {
            return redirect("admin/$this->key/edit/$id")
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $item = Color::find($id);

        $item->name = $request->name;

        if($request->image){
            File::delete($item->image);
            $image = $request->image;
            $filename  = time() . '.' . $image->getClientOriginalExtension();//Имя файла
            $path = 'img/color/' . $filename;//Путь файла
            Image::make($image->getRealPath())->save($path);
            $item->image = $path;
        }


        $item->save();

        return redirect("admin/$this->key")->with('message', 'Обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Color::find($id);
        File::delete($item->image);
        $item->delete();

        return redirect("admin/$this->key");
    }
}
