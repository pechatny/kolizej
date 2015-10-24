<?php

namespace App\Http\Controllers\Site;


use App\Models\Category;
use App\Models\Menu;
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
        return view('index', ['menuHtml' => $menuHtml, 'title' => $title, 'categories' => $categories]);
    }
}
