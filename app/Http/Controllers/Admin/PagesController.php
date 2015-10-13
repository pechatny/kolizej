<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        $data = [
            'route' => 'pages',
            'title' => Page::$tableName,
            'pages' => $pages,
            'pagesFields' => Page::$fields,
        ];

        return view('admin.pages.pageList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.pageCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key'  => 'required|unique:pages|max:255',
            'description'  => 'required|max:255',
            'keywords'  => 'required|max:255',
            'title'  => 'required|max:255',
            'page_title'  => 'required|max:255',
            'text'  => 'required',
            'elements'  => '',
        ]);

        if ($validator->fails()) {
            return redirect('admin/pages/create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $page = new Page;

        $page->key         = $request->key;
        $page->description = $request->description;
        $page->keywords    = $request->keywords;
        $page->title       = $request->title;
        $page->page_title  = $request->page_title;
        $page->text        = $request->text;
        $page->elements    = $request->elements;

        $page->save();

        return redirect('admin/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = Page::find($id);;
        $data = [
            'title' => Page::$tableName,
            'page' => $pages,
            'pagesFields' => Page::$fields,
        ];

        return view('admin.pages.pageEdit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'key'  => 'required|max:255',
            'description'  => 'required|max:255',
            'keywords'  => 'required|max:255',
            'title'  => 'required|max:255',
            'page_title'  => 'required|max:255',
            'text'  => 'required',
            'elements'  => '',
        ]);

        if ($validator->fails()) {
            return redirect("admin/pages/edit/$id")
                ->withErrors($validator)
                ->withInput();
        }

        $page = Page::find($id);

        $page->key         = $request->key;
        $page->description = $request->description;
        $page->keywords    = $request->keywords;
        $page->title       = $request->title;
        $page->page_title  = $request->page_title;
        $page->text        = $request->text;
        $page->elements    = $request->elements;

        $page->save();

        return redirect('admin/pages')->with('message', 'Обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Page::find($id);
        $menu->delete();

        return redirect('admin/pages');
    }
}
