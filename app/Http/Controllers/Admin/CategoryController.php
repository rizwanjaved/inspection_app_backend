<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\GroupRequest;
use Redirect;
use Sentinel;
use View;
use Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('admin.categories.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);
        $category = new Category([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name'))
        ]);
         if ($category->save()) {
            return Redirect::route('admin.category.index')->with('success', trans('Channel Category was successfully created.'));
        }

        // Redirect to the group create page
        return Redirect::route('admin.category.create')->withInput()->with('error', trans('general.error.wrong'));
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        //  $this->validate($request, [
        //     'name' => 'required|unique:categories',
        // ]);
        $category->name = $request->get('name');
        if ($category->save()) {
            // Redirect to the group page
            return Redirect::route('admin.category.index')->with('success', trans('Channel Category was successfully updated.'));
        } else {
            // Redirect to the group page
            return Redirect::route('admin.category.edit', $group)->with('error', trans('general.error.wrong'));
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
        try {
            $category = Category::find($id);
            $category->delete();
            return Redirect::route('admin.category.index')->with('success', trans('Channel Category was successfully deleted.'));
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            return Redirect::route('admin.category.index')->with('error', trans('general.error.wrong'));
        }
    }
}
