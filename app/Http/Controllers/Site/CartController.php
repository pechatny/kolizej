<?php

namespace App\Http\Controllers\Site;

use App\Classes\Cart;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class CartController extends Controller
{
    public function index(Request $request){
        $page = new \stdClass();
        $page->title = 'Корзина';
        $page->keywords = 'Корзина';
        $page->description = 'Корзина';
        $page->key = 'cart';

//        $title = Menu::where('key', 'cart')->value('name');
        $menuHtml = $this->menuHtml('cart');

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
//        $page = Page::where('key', $page)->first();

        $cart = $request->session()->get('cart');

        if($cart){
            $items = $cart->all();
        }
        else{
            $items = false;
        }

        $categories = Category::orderBy('sort', 'asc')->get();

        $smallCart = $this->smallCart();
        return view('site.cart', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'page' => $page,
            'items' => $items,
            'categories' => $categories,
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum'],
            'deliverySum' => $smallCart['deliverySum'],
            'totalSum' => $smallCart['deliverySum'] + $smallCart['sum'],
        ]);

    }

    public function add(Request $request){
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
            $cart->add($request->id, $request->count, $request->color, $request->config);
            session()->put('cart', $cart);
        }
        else{
            $cart = new Cart();
            $cart->add($request->id, $request->count, $request->color, $request->config);
            session()->put('cart', $cart);
        }

        return $cart->response();
    }

    public function delete(Request $request){
        $cart = session()->pull('cart');
        if($cart){
            $cart->delete($request->id);
            session()->put('cart', $cart);
        }

        return $cart->response();
    }

    public function all(){
        $cart = session()->get('cart');
        if($cart){
            return $cart->all();
        }
        return false;
    }

    public function cartHtml(){
        $smallCart = $this->smallCart();

        $topCart = view('include.cart', [
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum']
        ])->render();

        $bottomCart = view('include.bottomCart', [
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum']
        ])->render();

        return ['top' => $topCart, 'bottom' => $bottomCart];
    }

    public function order(Request $request){
        $formData = explode('&', $request->form);
        $arForm = [];
        foreach($formData as $item){
            $arItem = explode('=', $item);
            $arForm[$arItem[0]] = urldecode($arItem[1]);
        }

        $city = $request->city;
        $lift= $request->lift;
        $stage = $request->stage;
        $distance = $request->distance;

        $cart = $this->cart();

        $text = view('email.mail', compact('city', 'distance', 'lift', 'stage', 'arForm', 'cart'))->render();

        $email = Config::get('mail.from')['address'];

        $order = new Order();
        $order->save();
        $number = $order->id;

        mail($email, "Заказ №$number", $text);
        return ['success' => true, 'number' => $number];
    }
}
