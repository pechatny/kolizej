<?php

namespace App\Http\Controllers\Site;


use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = '')
    {
        $menuHtml = $this->menuHtml($page);

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();
        $page = Page::where('key', $page)->first();

        $categories = Category::orderBy('sort', 'asc')->get();

        $smallCart = $this->smallCart();
        return view('page', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'page' => $page,
            'categories' => $categories,
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum']
        ]);
    }

    public function feedback(Request $request){
        $text = view('email.feedback', $request->all())->render();
        $email = Config::get('mail.from')['address'];

        mail($email, 'Обратная связь', $text);
        return ['success' => true];
    }

    public function search(Request $request){

        $page = new \stdClass();
        $page->title = 'Поиск';
        $page->keywords = 'Поиск';
        $page->description = 'Поиск';
        $page->key = 'search';

        $menuHtml = $this->menuHtml('cart');

        $menuItems = Menu::all();
        $bottomMenuHtml = view('bottom', ['menuItems' => $menuItems])->render();

        $categories = Category::orderBy('sort', 'asc')->get();

        $smallCart = $this->smallCart();


        if($request->has('val')){
            $products = Product::where('name', 'like', "%$request->val%")->orWhere('text', 'like', "%$request->val%")->get();
            $val = $request->get('val');
        }
        else{
            $val = '';
            $products = [];
        }
        return view('site.search', [
            'menuHtml' => $menuHtml,
            'menuBottomHtml' => $bottomMenuHtml,
            'page' => $page,
            'categories' => $categories,
            'products' => $products,
            'count' => $smallCart['count'],
            'sum' => $smallCart['sum'],
            'indexFlag' => true,
            'search' => $val
        ]);

    }
}
