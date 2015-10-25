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
        return view('site.catalog', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function category($category)
    {
        $page = 'catalog';
        $title = Menu::where('key', $page)->value('name');
        $menuHtml = $this->menuHtml($page);

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        $page = Page::where('key', $page)->first();
        $categories = Category::all();

        $products = Product::with(['category' => function($query) use($category){
                $query->where('key', '=', $category);
            }])
            ->get();
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
        $depth = explode(' ', $request->params['depth']);
        $height = explode(' ', $request->params['height']);
        $width = explode(' ', $request->params['width']);
        $price = explode(' ', $request->params['price']);
        $category = $request->category;
        $products = Product::with(['category' => function($query) use($category){
                $query->where('key', '=', $category);
            }])
            ->whereBetween('depth', [$depth[0], $depth[1]])
            ->whereBetween('height', [$height[0], $height[1]])
            ->whereBetween('width', [$width[0], $width[1]])
            ->whereBetween('price', [$price[0], $price[1]])
            ->get();
        return view('site.productsList', [
            'products' => $products,
        ])->render();
    }


}
