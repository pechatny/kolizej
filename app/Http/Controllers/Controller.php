<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function menuHtml($current){
        $menu = new Menu();
        $menuHtml = $menu->getMenuHtml($current);

        return $menuHtml;
    }

    public function smallCart(){
        if(session()->has('cart')){
            $cartItems = session()->get('cart');
            $sum = $cartItems->sum();
            $count = count($cartItems->all());
        }
        else{
            $sum = 0;
            $count = 0;
        }

        return ['sum' => $sum, 'count' => $count];
    }

    public function cartItem($id){
        if(session()->has('cart')){
            $cart = session()->get('cart');
            $item = $cart->find($id);
            if($item){
                return ['configuration' => $item['configuration'], 'color' => $item['color']];
            }
        }
        else{
            $item = false;
        }

        return $item;
    }

}
