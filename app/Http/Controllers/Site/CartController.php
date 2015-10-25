<?php

namespace App\Http\Controllers\Site;

use App\Classes\Cart;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index(Request $request){
        $page = 'cart';
        $title = Menu::where('key', $page)->value('name');
        $menuHtml = $this->menuHtml($page);

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        $page = Page::where('key', $page)->first();

        $cart = $request->session()->get('cart');

        if($cart){
            $items = $cart->all();
        }
        else{
            $items = false;
        }

        $smallCart = $this->smallCart();
        return view('site.cart', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
            'items' => $items,
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum']
        ]);

    }

    public function add(Request $request){
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
            $cart->add($request->id, $request->count, $request->color);
            session()->put('cart', $cart);
        }
        else{
            $cart = new Cart();
            $cart->add($request->id, $request->count, $request->color);
            session()->put('cart', $cart);
        }
    }

    public function delete(Request $request){
        $cart = session()->pull('cart');
        if($cart){
            $cart->delete($request->id);
            session()->put('cart', $cart);
        }
    }

    public function all(){
        $cart = session()->get('cart');
        if($cart){
            return $cart->all();
        }
        return false;
    }
}
