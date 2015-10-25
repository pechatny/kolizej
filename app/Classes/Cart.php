<?php

namespace App\Classes;

use App\Models\Product;

class Cart
{
    private $items;

    public function __construct(){
        $this->items = [];
    }

    public function add($id, $quantity, $color ){
        $product = Product::with(['color', 'category'])->find($id);
        $this->items[$id]['product'] = $product;
        $this->items[$id]['quantity'] = $quantity;
        $this->items[$id]['color'] = $color;
    }

    public function delete($id){
        unset($this->items[$id]);
    }

    public function all(){
        return $this->items;
    }

    public function sum(){
        $sum = 0;
        if($this->items){
            foreach($this->items as $item){
                $sum += $item['product']->price * $item['quantity'];
            }

        }

        return $sum;
    }
}

