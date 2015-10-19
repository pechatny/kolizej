<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductsController extends Controller
{
    public $key = 'products';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::all();
        $data = [
            'route' => $this->key,
            'title' => Product::$tableName,
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
        $categories = Category::all();
        $formCategories = [];
        foreach($categories as $category){
            $formCategories[$category->id] = $category->name;
        }
        return view("admin.$this->key.create", ['categories' => $formCategories]);
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
            'keywords ' => 'max:255',
            'description ' => 'max:255',
//            'article ' => 'max:255',
            'price ' => 'integer',
            'width ' => 'integer',
            'height ' => 'integer',
            'warranty ' => 'integer',
            'weight ' => 'integer',
            'stock ' => 'integer',
//            'params ' =>
//            'image' => "required|mimes:jpeg,bmp,png",
        ]);

        if ($validator->fails()) {
            return redirect("admin/$this->key/create")
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $item = new Product();
        $item->name = $request->name;
        $item->keywords = $request->keywords;
        $item->description = $request->description;
        $item->text = $request->text;
        $item->article = $request->article;
        $item->price = $request->price;
        $item->width = $request->width;
        $item->height = $request->height;
        $item->warranty = $request->warranty;
        $item->weight = $request->weight;
        $item->stock = $request->stock ? $request->stock : 0;
        $item->params = $request->params;

        $images = $request->images;

        $arPath = [];
        foreach($images as $image){
            if(empty($image)) continue;
            $filename  = time() . '.' . $image->getClientOriginalExtension();//Имя файла
            $path = 'img/product/original/' . $filename;//Путь файла
            Image::make($image->getRealPath())->save($path);
            $arPath[] = $filename;

            $path = 'img/product/big/' . $filename;//Путь файла
            Image::make($image->getRealPath())->resize(570, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $path = 'img/product/medium/' . $filename;//Путь файла
            Image::make($image->getRealPath())->resize(216, 156)->save($path);

            $path = 'img/product/small/' . $filename;//Путь файла
            Image::make($image->getRealPath())->resize(108, 78)->save($path);

        }
        $item->images = serialize($arPath);

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
        $item = Product::find($id);
        $images = unserialize($item->images);
//dd($images);
        $categories = Category::all();
        $formCategories = [];
        foreach($categories as $category){
            $formCategories[$category->id] = $category->name;
        }

        $data = [
            'title' => Product::$tableName,
            'item' => $item,
            'images' => $images,
            'categories' => $formCategories
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
            'keywords ' => 'max:255',
            'description ' => 'max:255',
//            'article ' => 'max:255',
            'price ' => 'integer',
            'width ' => 'integer',
            'height ' => 'integer',
            'warranty ' => 'integer',
            'weight ' => 'integer',
            'stock ' => 'integer',
//            'params ' =>
//            'image' => "required|mimes:jpeg,bmp,png",
        ]);

        if ($validator->fails()) {
            return redirect("admin/$this->key/create")
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $item = Product::find($id);
        $item->name = $request->name;
        $item->keywords = $request->keywords;
        $item->description = $request->description;
        $item->text = $request->text;
        $item->article = $request->article;
        $item->price = $request->price;
        $item->width = $request->width;
        $item->height = $request->height;
        $item->warranty = $request->warranty;
        $item->weight = $request->weight;
        $item->stock = $request->stock ? $request->stock : 0;
        $item->params = $request->params;

        $images = $request->images;
        $loadedImages = $request->loadedImages;

        $arPath = [];
//        dd($images);
        if(is_array($images)){
            foreach($images as $image){

                if($image instanceof UploadedFile){
                    $arPath[] = $this->saveImages($image);
                }
            }
        }

        if(!empty($loadedImages)){
            foreach($loadedImages as $loadedImage){
                $arPath[] = $loadedImage;
            }
        }

        //Удаление удалённых картинок
        foreach(unserialize($item->images) as $dbImage){

            if(!in_array($dbImage, $arPath)){
                $this->deleteImages($dbImage);
            }
        }

        $item->images = serialize($arPath);

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
        $item = Product::find($id);
        foreach(unserialize($item->images) as $image){
            $this->deleteImages($image);
        }
        $item->delete();

        return redirect("admin/$this->key");
    }

    public function deleteImages($imageName){
        File::delete('img/product/original/'.$imageName);
        File::delete('img/product/medium/'.$imageName);
        File::delete('img/product/small/'.$imageName);
        File::delete('img/product/big/'.$imageName);
    }

    public function saveImages($image){
        $filename  = time() + rand(1,1000) . '.' . $image->getClientOriginalExtension();//Имя файла
        $path = 'img/product/original/' . $filename;//Путь файла
        Image::make($image->getRealPath())->save($path);

        $path = 'img/product/big/' . $filename;//Путь файла
        Image::make($image->getRealPath())->resize(570, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);

        $path = 'img/product/medium/' . $filename;//Путь файла
        Image::make($image->getRealPath())->resize(216, 156)->save($path);

        $path = 'img/product/small/' . $filename;//Путь файла
        Image::make($image->getRealPath())->resize(108, 78)->save($path);

        return $filename;
    }
}
