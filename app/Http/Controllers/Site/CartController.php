<?php

namespace App\Http\Controllers\Site;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index(){
        $page = 'cart';
        $title = Menu::where('key', $page)->value('name');
        $menuHtml = $this->menuHtml($page);

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        $page = Page::where('key', $page)->first();

        return view('site.cart', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'title' => $title,
            'page' => $page,
        ]);

    }

    public function add(Request $request){
        dd($request->all());
    }
}
