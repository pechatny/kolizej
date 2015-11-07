<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use File;

class CategoriesController extends Controller
{
    public $key = 'categories';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::orderBy('sort', 'asc')->get();;
        $data = [
            'route' => 'categories',
            'title' => Category::$tableName,
            'items' => $items,
//            'pagesFields' => Category::$fields,
        ];

        return view("admin.categories.list", $data);
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
            'key'  => 'required|unique:categories|max:255',
            'name'  => 'required|max:255',
            'description'  => 'required|max:255',
            'keywords'  => 'required|max:255',
            'image' => "required|mimes:jpeg,bmp,png",
        ]);

        if ($validator->fails()) {
            return redirect("admin/$this->key/create")
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $item = new Category();
        $item->key = $request->key;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->keywords = $request->keywords;

        $image = $request->image;
        $filename  = time() . '.' . $image->getClientOriginalExtension();
        $path = 'img/category/' . $filename;
        Image::make($image->getRealPath())->widen(370, function ($constraint) {
                $constraint->upsize();
            })->save($path);
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
        $item = Category::find($id);
        $data = [
            'title' => Category::$tableName,
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
            'key'  => 'required|max:255',
            'name'  => 'required|max:255',
            'description'  => 'required|max:255',
            'keywords'  => 'required|max:255',
            'image' => "mimes:jpeg,bmp,png",
        ]);

        if ($validator->fails()) {
            return redirect("admin/$this->key/edit/$id")
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $item = Category::find($id);

        $item->key = $request->key;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->keywords = $request->keywords;

        if($request->image){
            File::delete($item->image);
            $image = $request->image;
            $filename  = time() . '.' . $image->getClientOriginalExtension();//Имя файла
            $path = 'img/category/' . $filename;//Путь файла
            Image::make($image->getRealPath())->widen(370, function ($constraint) {
                $constraint->upsize();
            })->save($path);
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
        $item = Category::find($id);
        File::delete($item->image);
        $item->delete();

        return redirect("admin/$this->key");
    }
}
