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
        $this->Validate($request,[
        'title' => 'required|min:5',
        'link' => 'required',
        'category_id' => 'required',
        'year' => 'required',
        'image' => 'required',
        ]);
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
            return redirect('admin/vod')->with('success', trans('Vod Successfully Created'));
        } else {
            return Redirect::route('admin/vod/create')->withInput()->with('error', trans('general.error.wrong'));
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
    public function show(Vod $vod)
    {
       return view('admin.vods.show', compact('vod'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vod $vod)
    {
        $categories = VodCategory::pluck('title', 'id');
       return view('admin.vods.edit', compact('vod', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vod $vod)
    {
         $this->Validate($request,[
        'title' => 'required|min:5',
        'link' => 'required',
        'category_id' => 'required',
        'year' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/vods/';
            $file->move($destinationPath, $picture);
            if(file_exists(public_path() . '/uploads/vods/'.$vod->image)) {
                unlink(public_path('/uploads/vods/'.$vod->image));
            }
            $vod->image = $picture;
        }
        if ($vod->update($request->except('image'))) {
            return redirect('admin/vod')->with('success', 'Vod Successfully Updatd');
        } else {
            return Redirect::route('admin/vod')->withInput()->with('error', trans('general.error.wrong'));
        }
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
        $this->validate($request, [
            'title' => 'required|unique:vod_categories',
        ]);
         $category = new VodCategory([
            'title' => $request->get('name')
        ]);
         if ($category->save()) {
            return Redirect::route('admin.catIndex')->with('success', trans('Vod Category Successfully Created'));
        }

        // Redirect to the group create page
        return Redirect::route('admin/vodc/create')->withInput()->with('error', trans('general.error.wrong'));
    }
    public function catEdit(VodCategory $category) {
        return view('admin.vods.cat_edit', compact('category'));
        
    }
    public function catUpdate(Request $request,VodCategory $category) {
        $this->validate($request, [
            'title' => 'required|unique:vod_categories',
        ]);
        $category->title = $request->get('title');
         if ($category->save()) {
            // Redirect to the group page
            return Redirect::route('admin.catIndex')->with('success', trans('vod Category was successfully updated.'));
        } else {
            // Redirect to the group page
            return Redirect::route('admin.catIndexadmin.catIndex', $group)->with('error', trans('general.error.wrong'));
        }
        
    }
    public function catDelete(VodCategory $category) {
        try {
            $category->delete();
            return Redirect::route('admin.catIndex')->with('success', trans('Channel Category was successfully deleted.'));
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            return Redirect::route('admin.catIndex')->with('error', trans('general.error.wrong'));
        }
        
    }
}
