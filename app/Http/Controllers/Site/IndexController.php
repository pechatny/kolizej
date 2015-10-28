<?php

namespace App\Http\Controllers\Site;


use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index($page = '')
    {
        $title = Menu::where('key', $page)->value('name');
        $categories = Category::all();
        $menuHtml = $this->menuHtml($page);

        if(session()->has('cart')){
            $cartItems = session()->get('cart');
            $sum = $cartItems->sum();
            $count = count($cartItems->all());
        }
        else{
            $sum = 0;
            $count = 0;
        }

        $menuItems = Menu::all();
        $products = Product::with('category')->orderBy('views', 'desc')->take(8)->get();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        return view('index', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'categories' => $categories,
            'count' => $count,
            'sum' => $sum,
            'products' => $products
        ]);
    }
}
