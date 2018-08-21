<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Vod;
use App\VodCategory;
use Redirect;
use Sentinel;
use View;

class VodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vods = Vod::all();
        // Show the page
        return view('admin.vods.index', compact('vods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = VodCategory::pluck('title', 'id');
        return view('admin.vods.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vod = new Vod($request->except('image'));
        $picture = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/vods/';
            $file->move($destinationPath, $picture);
            $vod->image = $picture;
        }
        if ($vod->save()) {
            return redirect('admin/vod')->with('success', trans('blog/message.success.create'));
        } else {
            return Redirect::route('admin/vod/create')->withInput()->with('error', trans('blog/message.error.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * 

     
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // vod categories
    public function catIndex(Request $request) {
        $cats = VodCategory::all();
        return view('admin.vods.cat_index', compact('cats')); 
    }
    public function catCreate(Request $request) {
        return view('admin.vods.cat_create');
        
    }
    public function catStore(Request $request) {
         $category = new VodCategory([
            'title' => $request->get('name')
        ]);
         if ($category->save()) {
            return Redirect::route('admin.catIndex')->with('success', trans('groups/message.success.create'));
        }

        // Redirect to the group create page
        return Redirect::route('admin/vodc/create')->withInput()->with('error', trans('groups/message.error.create'));
    }
}
