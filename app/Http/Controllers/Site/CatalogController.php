<?php

namespace App\Http\Controllers\Site;


use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        $smallCart = $this->smallCart();

        return view('site.catalog', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
            'products' => $products,
            'categories' => $categories,
            'params' => $this->params(),
            'sum' => $smallCart['sum'],
            'count' => $smallCart['count']
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

        $smallCart = $this->smallCart();

        return view('site.catalog', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
            'products' => $products,
            'categories' => $categories,
            'params' => $this->params(),
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum']
        ]);
    }


    public function detail($id)
    {
        $page = 'catalog';
        $title = Menu::where('key', $page)->value('name');
        $menuHtml = $this->menuHtml($page);

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        $pageInfo = Page::where('key', $page)->first();
        $categories = Category::all();

        $product = Product::with(['category', 'color'])->find($id);
        $product->increment('views');

        $recommended = Product::with('category')->take(5)->get();

        $smallCart = $this->smallCart();

        $cartItem = $this->cartItem($product->id);
        
        $page = $product;
        $page->title = $product->name;
        return view('site.product', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
            'product' => $product,
            'categories' => $categories,
            'recommended' => $recommended,
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum'],
            'currentItem' => $cartItem
        ]);
    }

    public function ajaxUpdate(Request $request){
        $depth = explode(' ', $request->params['depth']);
        $height = explode(' ', $request->params['height']);
        $width = explode(' ', $request->params['width']);
        $price = explode(' ', $request->params['price']);
        $category = $request->category;

        $products = new Product();
        if($category != 'all'){
            $products = $products->with(['category' => function($query) use($category){
                $query->where('id', '=', $category);
            }]);
        }

        $products = $products->whereBetween('depth', [$depth[0], $depth[1]])
            ->whereBetween('height', [$height[0], $height[1]])
            ->whereBetween('width', [$width[0], $width[1]])
            ->whereBetween('price', [$price[0], $price[1]])
            ->get();

        return view('include.productsList', [
            'products' => $products,
        ])->render();
    }

    public function params(){
        $maxParams = DB::table('products')
            ->select([
                DB::raw('max(width) as width'),
                DB::raw('max(height) as height'),
                DB::raw('max(depth) depth'),
                DB::raw('max(price) as price'),
            ])
            ->first();

        $minParams = DB::table('products')
            ->select([
                DB::raw('min(width) as width'),
                DB::raw('min(height) as height'),
                DB::raw('min(depth) depth'),
                DB::raw('min(price) as price'),
            ])
            ->first();
        return ['min' => $minParams, 'max' => $maxParams];
    }


}
