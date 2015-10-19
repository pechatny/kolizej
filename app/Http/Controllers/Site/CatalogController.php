<?php

namespace App\Http\Controllers\Site;


use App\Models\Menu;
use App\Models\Page;
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
        return view('site.catalog', ['menuHtml' => $menuHtml, 'menuBottomHtml' => $bottomMenuHtml, 'title' => $title, 'page' => $page]);
    }


}
