<?php

namespace App\Classes;

use App\Models\Product;

class Cart
{
    private $items;

    public function __construct(){
        $this->items = [];
    }

    public function add($id, $quantity, $color = false, $config = false ){
        $product = Product::with(['color', 'category'])->find($id);
        $this->items[$id]['product'] = $product;
        $this->items[$id]['quantity'] = $quantity;
        $this->items[$id]['color'] = $color;
        $this->items[$id]['configuration'] = $config;
    }

    public function delete($id){
        unset($this->items[$id]);
    }

    public function all(){
        $this->filterEmpty();
        return $this->items;
    }

    public function sum(){
        $this->filterEmpty();
        $sum = 0;
        if($this->items){
            foreach($this->items as $item){
                $sum += $item['product']->price * $item['quantity'];
            }
        }

        return $sum;
    }

    private function filterEmpty(){
        foreach ($this->items as $key => $item){
            if(!$key){
                unset($this->items[$key]);
            }
        }
    }

    public function response(){
        return ['sum' => $this->sum(), 'count' => count($this->all())];
    }

    public function find($id){
        if(isset($this->items[$id])){
            return $this->items[$id];
        }
        else{
            return false;
        }
    }
}

