<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;
use App\Http\Requests\GroupRequest;
use Redirect;
use Sentinel;
use View;
use Validator;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.regions.create');        
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
            'name' => 'required|unique:regions',
        ]);
        $region = new Region([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name'))
        ]);
         if ($region->save()) {
            return Redirect::route('admin.region.index')->with('success', trans('Channel Region was successfully created.'));
        }
        // Redirect to the group create page
        return Redirect::route('admin.region.create')->withInput()->with('error', trans('general.error.wrong'));
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
    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Region $region)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);
        $region->name = $request->get('name');
        if ($region->save()) {
            // Redirect to the group page
            return Redirect::route('admin.region.index')->with('success', trans('Channel Region was successfully updated.'));
        } else {
            // Redirect to the group page
            return Redirect::route('admin.region.edit', $group)->with('error', trans('general.error.wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        try {
            $region->delete();
            return Redirect::route('admin.region.index')->with('success', trans('Channel Region was successfully deleted.'));
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            return Redirect::route('admin.region.index')->with('error', trans('general.error.wrong'));
        }
    }
}
