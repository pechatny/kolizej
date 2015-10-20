<?php

namespace App\Http\Controllers\Site;


use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'catalog';
        $title = Menu::where('key', $page)->value('name');
        $menuHtml = $this->menuHtml($page);

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        $page = Page::where('key', $page)->first();
        $categories = Category::all();

        $products = Product::with('category')->get();
//dd($products->toArray());
        return view('site.catalog', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function detail($id)
    {
        $page = 'catalog';
        $title = Menu::where('key', $page)->value('name');
        $menuHtml = $this->menuHtml($page);

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        $page = Page::where('key', $page)->first();
        $categories = Category::all();

        $product = Product::with(['category', 'color'])->find($id);

        $recommended = Product::with('category')->take(5)->get();
        return view('site.product', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
            'product' => $product,
            'categories' => $categories,
            'recommended' => $recommended
        ]);
    }

    public function ajaxUpdate(Request $request){

        $products = Product::with('category')->get();

        return view('site.productsList', [
            'products' => $products,
        ])->render();
    }


}
