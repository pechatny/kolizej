<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Log;

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
        $categories = Category::orderBy('sort', 'asc')->get();
        $formCategories = [];
        foreach($categories as $category){
            $formCategories[$category->id] = $category->name;
        }

        $colors = Color::all();
        $formColors = [];
        foreach($colors as $color){
            $formColors[$color->id] = $color->name;
        }
        return view("admin.$this->key.create", ['categories' => $formCategories, 'colors' => $formColors]);
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
        $item->category_id = $request->category_id;

        $item->text = $request->text;
        $item->configuration = $request->configuration;
        $item->article = $request->article;
        $item->price = $request->price;
        $item->width = $request->width;
        $item->height = $request->height;
        $item->warranty = $request->warranty;
        $item->weight = $request->weight;
        $item->depth = $request->depth;
        $item->stock = $request->has('stock') ? 1 : 0;
        $item->params = $request->params;
        $item->lift = $request->lift;
        $item->lift_hand = $request->lift_hand;
        $item->assembly = $request->assembly;

        $images = $request->images;
        
        $arPath = [];
        foreach($images as $image){
            if(empty($image)) continue;
            $filename  = time() + rand(1,1000) . '.' . $image->getClientOriginalExtension();
            $path = 'img/product/original/' . $filename;
            Image::make($image->getRealPath())->save($path);
            $arPath[] = $filename;

            $path = 'img/product/detail-w570/' . $filename;
            $h = Image::make($image->getRealPath())->widen(570)->height();
            if($h < 500) {
                Image::make($image->getRealPath())->widen(570, function ($constraint) {
                    $constraint->upsize();
                })->save($path);
            }
            else {
                Image::make($image->getRealPath())->heighten(500, function ($constraint) {
                    $constraint->upsize();
                })->save($path);
            }

            $path = 'img/product/product_card-w268/' . $filename;
            if(Image::make($image->getRealPath())->width() > Image::make($image->getRealPath())->height()) {
                Image::make($image->getRealPath())->widen(268, function ($constraint) {
                    $constraint->upsize();
                })->save($path);
            }
            else {
                Image::make($image->getRealPath())->heighten(230, function ($constraint) {
                    $constraint->upsize();
                })->save($path);
            }

            $path = 'img/product/cart-w216/' . $filename;
            Image::make($image->getRealPath())->heighten(156, function ($constraint) {
                $constraint->upsize();
            })->save($path);

            $path = 'img/product/gallery_preview-w108/' . $filename;
            Image::make($image->getRealPath())->widen(108, function ($constraint) {
                $constraint->upsize();
            })->save($path);

        }
        $item->images = serialize($arPath);

        $item->save();

        //Цвета мебели
        if(is_array($request->colors)){
            foreach($request->colors as $color){
                $productColor = new ProductColor();
                $productColor->product_id = $item->id;
                $productColor->color_id = $color;
                $productColor->save();
            }
        }

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
        $item = Product::with(['color', 'category'])->find($id);
        $images = $item->images;
        $categories = Category::orderBy('sort', 'asc')->get();
        $formCategories = [];
        foreach($categories as $category){
            $formCategories[$category->id] = $category->name;
        }

        $colors = Color::all();
        $formColors = [];
        foreach($colors as $color){
            $formColors[$color->id] = $color->name;
        }

        $data = [
            'title' => Product::$tableName,
            'item' => $item,
            'images' => $images,
            'categories' => $formCategories,
            'colors' => $formColors
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
        $item->configuration = $request->configuration;
        $item->category_id = $request->category_id;
        $item->article = $request->article;
        $item->price = $request->price;
        $item->width = $request->width;
        $item->height = $request->height;
        $item->depth = $request->depth;
        $item->warranty = $request->warranty;
        $item->weight = $request->weight;
        $item->stock = $request->has('stock') ? 1 : 0;
        $item->params = $request->params;
        $item->lift = $request->lift;
        $item->lift_hand = $request->lift_hand;
        $item->assembly = $request->assembly;

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
        foreach($item->images as $dbImage){

            if(!in_array($dbImage, $arPath)){
                $this->deleteImages($dbImage);
            }
        }

        $item->images = serialize($arPath);

        $item->save();

        $colorsToDelete = ProductColor::where('product_id', $item->id)->get();
        foreach($colorsToDelete as $colorDelete){
            $colorDelete->delete();
        }

        //Цвета мебели
        if(is_array($request->colors)){
            foreach($request->colors as $color){
                $productColor = new ProductColor();
                $productColor->product_id = $item->id;
                $productColor->color_id = $color;
                $productColor->save();
            }
        }

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
        foreach($item->images as $image){
            $this->deleteImages($image);
        }

        $colorsToDelete = ProductColor::where('product_id', $item->id)->get();
        foreach($colorsToDelete as $colorDelete){
            $colorDelete->delete();
        }

        $item->delete();

        return redirect("admin/$this->key");
    }

    public function deleteImages($imageName){
        File::delete('img/product/original/'.$imageName);
        File::delete('img/product/detail-w570/'.$imageName);
        File::delete('img/product/product_card-w268/'.$imageName);
        File::delete('img/product/cart-w216/'.$imageName);
        File::delete('img/product/gallery_preview-w108/'.$imageName);
    }

    public function saveImages($image) {
        $filename  = time() + rand(1,1000) . '.' . $image->getClientOriginalExtension();
        $path = 'img/product/original/' . $filename;
        Image::make($image->getRealPath())->save($path);

        $path = 'img/product/detail-w570/' . $filename;
        $h = Image::make($image->getRealPath())->widen(570)->height();
        if($h < 500) {
            Image::make($image->getRealPath())->widen(570, function ($constraint) {
                $constraint->upsize();
            })->save($path);
        }
        else {
            Image::make($image->getRealPath())->heighten(500, function ($constraint) {
                $constraint->upsize();
            })->save($path);
        }

        $path = 'img/product/product_card-w268/' . $filename;
        if(Image::make($image->getRealPath())->width() > Image::make($image->getRealPath())->height()) {
            Image::make($image->getRealPath())->widen(268, function ($constraint) {
                $constraint->upsize();
            })->save($path);
        }
        else {
            Image::make($image->getRealPath())->heighten(230, function ($constraint) {
                $constraint->upsize();
            })->save($path);
        }

        $path = 'img/product/cart-w216/' . $filename;
        Image::make($image->getRealPath())->heighten(156, function ($constraint) {
            $constraint->upsize();
        })->save($path);

        $path = 'img/product/gallery_preview-w108/' . $filename;
        Image::make($image->getRealPath())->widen(108, function ($constraint) {
            $constraint->upsize();
        })->save($path);

        return $filename;
    }
}
